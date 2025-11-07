<?php

namespace App\Form;

use App\Entity\Cv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CvTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Full Name',
                'attr' => ['class' => 'form-control']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-control']
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'attr' => ['class' => 'form-control']
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'attr' => ['class' => 'form-control']
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'Professional Summary',
                'attr' => ['class' => 'form-control', 'rows' => 4]
            ])
            ->add('photoFile', VichImageType::class, [
                'label' => 'Profile Photo',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Remove photo',
                'download_uri' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('template', ChoiceType::class, [
                'label' => 'CV Template',
                'choices' => [
                    'Classic' => 'classic',
                    'Modern' => 'modern',
                    'Creative' => 'creative',
                ],
                'attr' => ['class' => 'form-select']
            ])
            ->add('educations', CollectionType::class, [
                'entry_type' => EducationType::class,
                'entry_options' => [
                    'label' => false,
                    'attr' => ['class' => 'education-item']  // Add specific class for items
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__education_prototype__',  // Unique prototype name
                'label' => false,
                'attr' => [
                    'class' => 'education-collection',
                ]
            ])
            ->add('experiences', CollectionType::class, [
                'entry_type' => ExperienceType::class,
                'entry_options' => [
                    'label' => false,
                    'attr' => ['class' => 'experience-item']
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__experience_prototype__',
                'label' => false,
                'attr' => [
                    'class' => 'experience-collection',
                ]
            ])
            ->add('languageSkills', CollectionType::class, [
                'entry_type' => LanguageSkillType::class,
                'entry_options' => [
                    'label' => false,
                    'attr' => ['class' => 'language-item']
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__language_prototype__',
                'label' => false,
                'attr' => [
                    'class' => 'language-collection',
                ]
            ])
            ->add('computerSkills', CollectionType::class, [
                'entry_type' => ComputerSkillType::class,
                'entry_options' => [
                    'label' => false,
                    'attr' => ['class' => 'computer-skill-item']
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__computer_skill_prototype__',
                'label' => false,
                'attr' => [
                    'class' => 'computer-skills-collection',
                ]
            ])
            ->add('projects', CollectionType::class, [
                'entry_type' => ProjectType::class,
                'entry_options' => [
                    'label' => false,
                    'attr' => ['class' => 'project-item']
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__project_prototype__',
                'label' => false,
                'attr' => [
                    'class' => 'project-collection',
                ]
            ])
            ->add('socialActivities', CollectionType::class, [
                'entry_type' => SocialActivityType::class,
                'entry_options' => [
                    'label' => false,
                    'attr' => ['class' => 'social-activity-item']
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__social_activity_prototype__',
                'label' => false,
                'attr' => [
                    'class' => 'social-collection',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
            'allow_extra_fields' => true  // Important for dynamic forms
        ]);
    }
}