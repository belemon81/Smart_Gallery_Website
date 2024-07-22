<?php

namespace App\Form;

use App\Entity\Artwork;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class,[
                'empty_data'=>null,
                'attr' => [
                    'placeholder' => '-- Enter the name of artwork --'
                ],
                'required' => false

            ])
            ->add('Artist', EntityType::class,[
                'class' => User::class, 
                'placeholder' => '-- Select the name of artist --',
                'empty_data'=>null,
                'required' => false
            ])
            ->add('Category',EntityType::class,[ 
                'class' => Category::class, 
                'multiple' => true,
                'expanded' => true,
                'empty_data'=> null, 
                'required' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Search'
            ]); 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artwork::class,
        ]);
        
    }
}
