<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',  TextType::class, [
                'constraints' => [
                    new Length(['min' => 5]),
                ],
            ])
            ->add('published')
            ->add('url', UrlType::class)
            ->add('description')
            ->add('selected_category', ChoiceType::class, [
                'choices'  => [
                    'Jeux-videos' => 'Jeux-videos',
                    'Anime-manga' => 'Anime-manga',
                    'Musique' => 'Musique',
                    'Sport' => 'Sport',
                ],
            ])
            
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
