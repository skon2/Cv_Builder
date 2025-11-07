<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', TextType::class, [
                'label' => 'Position',
                'attr' => ['class' => 'form-control']
            ])
            ->add('company', TextType::class, [
                'label' => 'Company',
                'attr' => ['class' => 'form-control']
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Start Date',
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
                'attr' => ['class' => 'form-control', 'rows' => 4]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}