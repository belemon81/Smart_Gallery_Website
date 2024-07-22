<?php

namespace App\Form;

use App\Entity\Artwork;
use App\Entity\Category; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class ManageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class,[ 
                'attr' => [
                    'placeholder' => 'Enter the name of your artwork'
                ] 
            ])
            ->add('CompletionDate', TypeDateType::class, [
                'widget' => 'single_text', 
            ])
            ->add('Description',TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Describe somethings about your artwork (e.g. inspriration, ponderation, experience, etc)'
                ], 
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => '*Your artwork must contains some description to be verified!',
                //     ]),
                // ], 
                'required' => false,
                'empty_data' => '<em>The artist left nothing...</em>'
            ]) 
            ->add('ArtworkURL',UrlType::class, [
                'attr' => [
                    'placeholder' => 'If you don\'t have the artwork file, put the URL which contains the illustration of the artwork'
                ],
                'required' => false,
            ])
            ->add('ArtworkFile',FileType::class,[
                'required' => false,
                'data_class' => null,
                'mapped' => false,
                'constraints' => [
                    new Image([
                        'mimeTypes' => 'image/*', 
                        'mimeTypesMessage' => '*The mime type of the file is invalid ({{ type }}). Allowed mime types are {{ types }}.'
                    ]) 
                ],
            ])
            ->add('Category',EntityType::class,[ 
                'class' => Category::class, 
                'multiple' => true,
                'expanded' => true, 
                'required' => false,
            ])
            ->add('save', SubmitType::class); 
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artwork::class,
        ]);
    }
}
