<?php

namespace App\Form;

use App\Entity\ComputerSkill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ComputerSkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Language/Technology',
                'attr' => ['class' => 'form-control']
            ])
            ->add('level', ChoiceType::class, [
                'label' => 'Proficiency Level',
                'choices' => [
                    'Beginner' => 'Beginner',
                    'Intermediate' => 'Intermediate',
                    'Advanced' => 'Advanced',
                    'Expert' => 'Expert'
                ],
                'attr' => ['class' => 'form-select']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ComputerSkill::class,
        ]);
    }
}