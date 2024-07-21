<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Artwork;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Like;
use App\Form\CommentType;
use App\Form\SearchType;
use App\Form\ManageType;
use DateTime;
use DateTimeZone;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class GalleryController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        // Accessing the session in the constructor is *NOT* recommended, since
        // it might not be accessible yet or lead to unwanted side-effects
        // $this->session = $requestStack->getSession();
    }

    // public function someMethod()
    // {
    //     $session = $this->requestStack->getSession(); 
    //     $session->set('attribute-name', 'attribute-value'); 
    //     $foo = $session->get('foo'); 
    //     $filters = $session->get('filters', []); 
    // }

    private function __isLogined()
    {
        $user = $this->getUser();
        if ($user === null) {
            return false;
        }
        return true;
    }

    private function __isGranted()
    {
        $user = $this->getUser();
        if ($this->__isLogined() && (in_array('ROLE_ADMIN', $user->getRoles()) || in_array('ROLE_MOD', $user->getRoles()))) {
            return true;
        }
        return false;
    }

    private function artwork_ORM(ManagerRegistry $doctrine, int $id)
    {
        $artwork = $doctrine->getRepository(Artwork::class)->find($id);
        return $artwork;
    }

    private function allArtworks_ORM(ManagerRegistry $doctrine)
    {
        $all_artworks = $doctrine->getRepository(Artwork::class)->findBy(['Approved' => true], ['TotalViews' => 'DESC']);
        return $all_artworks;
    }

    private function allCategories_ORM(ManagerRegistry $doctrine)
    {
        $all_categories = $doctrine->getRepository(Category::class)->findAll();
        return $all_categories;
    }

    private function userCategories_ORM(ManagerRegistry $doctrine)
    {
        $userArtworks = $this->userArtworks_ORM($doctrine);
        $user_categories = array();
        foreach ($userArtworks as $artwork) {
            foreach ($artwork->getCategory() as $category) {
                array_push($user_categories, $category);
            }
        }
        $user_categories = array_unique($user_categories);
        return $user_categories;
    }

    private function userArtworks_ORM(ManagerRegistry $doctrine)
    {
        $user = $this->getUser();
        $user_artworks = $doctrine->getRepository(Artwork::class)->findBy(['Artist' => $user],['TotalViews' => 'DESC']);
        return $user_artworks;
    }

    /**
     * @Route("/gallery/{id<\d+>?0}", name="homepage")
     */
    public function showAllArtworks(ManagerRegistry $doctrine, String $id): Response
    {
        $allArtworks = $this->allArtworks_ORM($doctrine);
        $allCategories = $this->allCategories_ORM($doctrine);
        $isGranted = $this->__isGranted();
        $isLogined = $this->__isLogined(); 
        if ($allArtworks) {
            return $this->render('gallery.html.twig', [
                'artworks' => $allArtworks,
                'categories' => $allCategories,
                'id' => $id,
                'isGranted' => $isGranted,
                'isLogined' => $isLogined,
                'current' => 'homepage'
            ]);
        }
        return $this->render('notfound.html.twig', [
            'error' => "PAGE NOT FOUND",
            'detail' => "Sorry. Perhaps somethings have gone wrong with the page. Please try again later.",
            'isGranted' => $isGranted,
            'isLogined' => $isLogined,
            'current' => 'homepage'
        ]);
    }

    /**
     * @Route("/my_gallery/{id<\d+>?0}", name="my_gallery")
     */
    public function showUserArtworks(ManagerRegistry $doctrine, String $id): Response
    {
        $userArtworks = $this->userArtworks_ORM($doctrine);
        $userCategories = $this->userCategories_ORM($doctrine);
        $isGranted = $this->__isGranted();
        $isLogined = $this->__isLogined();
        if ($userArtworks) {
            return $this->render('gallery_user.html.twig', [
                'artworks' => $userArtworks,
                'id' => $id,
                'isGranted' => $isGranted,
                'isLogined' => $isLogined,
                'categories' => $userCategories,
                'current' => 'my_gallery',
            ]);
        } 
        return $this->render('notfound.html.twig', [
            'error' => "GALLERY NOT FOUND",
            'detail' => "You haven't upload any artwork in your gallery... <a href='my_gallery/artwork/add'>Wanna try it?</a>",
            'isGranted' => $isGranted,
            'isLogined' => $isLogined,
            'current' => 'my_gallery'
        ]);
    }

    /**
     * @Route("/artwork/{id<\d+>?0}", name="artwork")
     */
    public function showArtwork(Request $req, ManagerRegistry $doctrine, String $id): Response
    {
        $artwork = $this->artwork_ORM($doctrine, $id);
        $isGranted = $this->__isGranted();
        $isLogined = $this->__isLogined();
        if ($artwork && ($artwork->isApproved() || $this->getUser() == $artwork->getArtist())) {
            $entityManager = $doctrine->getManager();
            $current = $artwork->getTotalViews() + 1;
            $artwork->setTotalViews($current);
            $entityManager->flush();  

            $likes = $artwork->getLikes();
            $liked = false;
            foreach($likes as $like) {
                if ($this->getUser() === $like->getUser()) {
                    $liked = true;
                    break;
                }
            }

            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);
            $form->handleRequest($req);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $doctrine->getManager();
                $comment = $form->getData();
                $comment->setContent(str_replace('&', '&amp;', $comment->getContent()));
                $comment->setUser($this->getUser());
                $comment->setArtwork($artwork);
                $comment->setCommentTime(new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh')));
                $entityManager->persist($comment);
                $entityManager->flush();
                $id = $artwork->getId();
                return $this->redirect("/artwork/$id#pp-comment");
            }
            return $this->renderForm('artwork.html.twig', [
                'artwork' => $artwork,
                'id' => $id, 
                'isGranted' => $isGranted,
                'isLogined' => $isLogined,
                'current' => 'artwork',
                'form' => $form,
                'liked' => $liked
            ]);
        } else {
            return $this->render('notfound.html.twig', [
                'error' => "ARTWORK NOT FOUND",
                'detail' => "Sorry. Perhaps somethings have gone wrong with the page. Please try again later.",
                'isGranted' => $isGranted,
                'isLogined' => $isLogined,
                'current' => 'notfound'
            ]);
        }
    }

    /**
     * @Route("/my_gallery/manage/{id<\d+>?0}", name="manage")
     */
    public function manageUserGallery(String $id, ManagerRegistry $doctrine): Response
    {
        $isGranted = $this->__isGranted();
        $isLogined = $this->__isLogined(); 
        $userArtworks = $this->userArtworks_ORM($doctrine);
        return $this->render('manage.html.twig', [
            'artworks' => $userArtworks,
            'id' => $id,
            'isGranted' => $isGranted,
            'isLogined' => $isLogined,
            'current' => 'my_gallery'
        ]);
    }

    /**
     * @Route("/my_gallery/artwork/add", name="add_artwork")
     */
    public function addArtwork(Request $req, ManagerRegistry $doctrine): Response
    {
        $artwork = new Artwork();
        $isGranted = $this->__isGranted();
        $isLogined = $this->__isLogined();
        $form = $this->createForm(ManageType::class, $artwork);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $artwork = $form->getData(); 
            $artwork->setArtist($this->getUser());
            $artwork->setDescription(str_replace('&', '&amp;', $artwork->getDescription()));

            $artworkFile = $form['ArtworkFile']->getData();
            if ($artworkFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/artworks';
                $originalFilename = pathinfo($artworkFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.time().'.'.$artworkFile->guessExtension();
                $artworkFile->move($destination,$newFilename);
                $artwork->setArtworkFile($newFilename);
            }
            $entityManager = $doctrine->getManager();
            $entityManager->persist($artwork);
            $entityManager->flush();
            return $this->redirectToRoute('manage');
        }
        return $this->renderForm('form.html.twig', [
            'form' => $form,
            'label' => 'Add new arwork', 
            'isGranted' => $isGranted,
            'isLogined' => $isLogined,
            'current' => 'my_gallery',
            'state' => 'add',
            'artwork' => $artwork,
        ]);
    }

    /**
     * @Route("/my_gallery/artwork/{id<\d+>}/edit",name="edit_artwork")
     */
    public function editArtwork(Request $req, ManagerRegistry $doctrine, int $id): Response
    {
        $isGranted = $this->__isGranted();
        $isLogined = $this->__isLogined();
        $entityManager = $doctrine->getManager();
        $artwork = $this->artwork_ORM($doctrine,$id);
        if ($artwork->getArtist() === $this->getUser()) {  
            $form = $this->createForm(ManageType::class, $artwork);
            $form->handleRequest($req);
            if ($form->isSubmitted() && $form->isValid()) { 
                $artwork = $form->getData();
                $entityManager = $doctrine->getManager(); 
                $artwork->setName($artwork->getName());
                $artwork->setCompletionDate($artwork->getCompletionDate());
                $artwork->setDescription($artwork->getDescription());
                $artwork->setArtworkURL($artwork->getArtworkURL());
                $artworkFile = $form['ArtworkFile']->getData(); 
                if ($artworkFile) {
                    $destination = $this->getParameter('kernel.project_dir').'/public/uploads/artworks';
                    $originalFilename = pathinfo($artworkFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = $originalFilename.'-'.time().'.'.$artworkFile->guessExtension();
                    $artworkFile->move($destination,$newFilename);
                    $artwork->setArtworkFile($newFilename);
                } else {
                    $origin = $this->artwork_ORM($doctrine,$id);
                    $artwork->setArtworkFile($origin->getArtworkFile());
                }
                foreach ($artwork->getCategory() as $category) {
                    $artwork->addCategory($category);
                }
                $entityManager->flush();
                return $this->redirectToRoute('artwork',['id'=>$id]);
            }
            return $this->renderForm('form.html.twig', [
                'form' => $form,
                'label' => 'Edit artwork',
                'isGranted' => $isGranted,
                'isLogined' => $isLogined,
                'current' => 'my_gallery',
                'state' => 'edit',
                'artwork' => $artwork
            ]);
        } else {
            return $this->render('notfound.html.twig', [
                'error' => 'ACCESS DENIED',
                'detail' => 'You have no permission to access this page!',
                'isGranted' => $isGranted,
                'isLogined' => $isLogined,
                'current' => 'notfound',
            ]);
        }
    }

    /**
     * @Route("/my_gallery/artwork/{id<\d+>}/delete/?page={page<\d+>?0}", name="delete_artwork")
     */
    public function deleteArtwork(ManagerRegistry $doctrine, int $id, int $page): Response
    {
        $isGranted = $this->__isGranted();
        $isLogined = $this->__isLogined();
        $entityManager = $doctrine->getManager();
        $artwork = $this->artwork_ORM($doctrine,$id);
        if ($artwork->getArtist() === $this->getUser()) {
            $entityManager->getRepository(Artwork::class)->remove($artwork);
            $entityManager->flush();
            return $this->redirectToRoute('manage',['id' => $page]);
        } else {
            return $this->render('notfound.html.twig', [
                'error' => 'ACCESS DENIED',
                'detail' => 'You have no permission to access this page!',
                'isGranted' => $isGranted,
                'isLogined' => $isLogined,
                'current' => 'notfound',
            ]);
        }
    }

    /**
     * @Route("/like/artwork/{id<\d+>}", name="like")
     */
    public function likeArtwork(ManagerRegistry $doctrine, String $id): Response
    {
        $like = new Like();
        $artwork = $this->artwork_ORM($doctrine,$id);
        $like->setArtwork($artwork);
        $like->setUser($this->getUser());
        $entityManager = $doctrine->getManager();
        $entityManager->persist($like);
        $entityManager->flush();
        return $this->redirectToRoute("artwork",['id'=>$id]);
    }

     /**
     * @Route("/unlike/artwork/{id<\d+>}", name="unlike")
     */
    public function unlikeArtwork(ManagerRegistry $doctrine, String $id): Response
    { 
        $user = $this->getUser();
        $artwork = $this->artwork_ORM($doctrine,$id);
        $like = $doctrine->getRepository(Like::class)->findOneBy(['User'=>$user, 'Artwork'=>$artwork]);
        $entityManager = $doctrine->getManager();
        $entityManager->remove($like);
        $entityManager->flush();
        return $this->redirectToRoute("artwork",['id'=>$id]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchArtworks(Request $req, ManagerRegistry $doctrine): Response
    {
        $artwork = new Artwork();
        $isGranted = $this->__isGranted();
        $isLogined = $this->__isLogined();
        $form = $this->createForm(SearchType::class, $artwork);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $name = $form->getData()->getName();
            $artist = $form->getData()->getArtist();
            $categories = $form->getData()->getCategory(); 
            if ($name && $artist && $categories->count()) {
                $results1 = $doctrine->getRepository(Artwork::class)->findBy(['Approved' => true, 'Name' => $name, 'Artist' => $artist],['TotalViews' => 'DESC']);
                $results2 = $doctrine->getRepository(Artwork::class)->findByCategory($categories);
                $artworks = array_values(array_intersect($results1, $results2));
            } else if ($name && $artist)
                $artworks = $doctrine->getRepository(Artwork::class)->findBy(['Approved' => true, 'Name' => $name, 'Artist' => $artist],['TotalViews' => 'DESC']);
            else if ($name && $categories->count()) {
                $results1 = $doctrine->getRepository(Artwork::class)->findBy(['Approved' => true, 'Name' => $name],['TotalViews' => 'DESC']);
                $results2 = $doctrine->getRepository(Artwork::class)->findByCategory($categories);
                $artworks = array_values(array_intersect($results1, $results2));
            } else if ($artist && $categories->count()) {
                $results1 = $doctrine->getRepository(Artwork::class)->findBy(['Approved' => true, 'Artist' => $artist],['TotalViews' => 'DESC']);
                $results2 = $doctrine->getRepository(Artwork::class)->findByCategory($categories);
                $artworks = array_values(array_intersect($results1, $results2));
            } else if ($name)
                $artworks = $doctrine->getRepository(Artwork::class)->findBy(['Approved' => true, 'Name' => $name],['TotalViews' => 'DESC']);
            else if ($artist)
                $artworks = $doctrine->getRepository(Artwork::class)->findBy(['Approved' => true, 'Artist' => $artist],['TotalViews' => 'DESC']);
            else if ($categories->count()) {
                $results1 = $doctrine->getRepository(Artwork::class)->findBy(['Approved' => true],['TotalViews' => 'DESC']);
                $results2 = $doctrine->getRepository(Artwork::class)->findByCategory($categories);
                $artworks = array_values(array_intersect($results1, $results2));
            } else
                $artworks = $this->allArtworks_ORM($doctrine);
            if ($artworks) {
                if (!$categories->count()) {
                    $categories = array();
                    foreach ($artworks as $artwork) {
                        foreach ($artwork->getCategory() as $category) {
                            array_push($categories, $category);
                        }
                    }
                    $categories = array_unique($categories);
                }
                return $this->render('search_result.html.twig', [
                    'artworks' => $artworks,
                    'categories' => $categories,
                    'id' => 0,
                    'isGranted' => $isGranted,
                    'isLogined' => $isLogined,
                    'current' => 'search'
                ]);
            } else return $this->render('notfound.html.twig', [
                'isGranted' => $isGranted,
                'isLogined' => $isLogined,
                'error' => 'Searching results: Artwork(s) not found',
                'detail' => 'We can not find the artwork(s) that match the keys given. Please <a href="search">try again</a>.',
                'current' => 'search'
            ]);
        }
        return $this->renderForm('search.html.twig', [
            'form' => $form,
            'isGranted' => $isGranted,
            'isLogined' => $isLogined,
            'current' => 'search'
        ]);
    }
}
