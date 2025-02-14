<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Customer entity
 */
class CustomerType extends AbstractType
{
    /**
     * Builds the customer form
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Обязательные поля
            ->add('firstName', TextType::class, [
                'label' => 'Имя',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Введите имя'
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Фамилия',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Введите фамилию'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'example@domain.com'
                ]
            ])
            // Необязательные поля
            ->add('companyName', TextType::class, [
                'label' => 'Название компании',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Введите название компании'
                ]
            ])
            ->add('position', TextType::class, [
                'label' => 'Должность',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Введите должность'
                ]
            ])
            ->add('phone1', TelType::class, [
                'label' => 'Телефон 1',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '+7 (999) 999-99-99'
                ]
            ])
            ->add('phone2', TelType::class, [
                'label' => 'Телефон 2',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '+7 (999) 999-99-99'
                ]
            ])
            ->add('phone3', TelType::class, [
                'label' => 'Телефон 3',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '+7 (999) 999-99-99'
                ]
            ])
        ;
    }

    /**
     * Configures the options for this form
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}