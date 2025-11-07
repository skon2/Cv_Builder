<?php

namespace App\Form;

use App\Entity\SocialActivity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SocialActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Activity Title',
                'attr' => ['class' => 'form-control']
            ])
            ->add('organization', TextType::class, [
                'label' => 'Organization',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Start Date',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'End Date',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SocialActivity::class,
        ]);
    }
}