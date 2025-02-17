<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('gender', ChoiceType::class, [
                'label' => 'Пол',
                'required' => true,
                'choices' => [
                    'Мужской' => 'male',
                    'Женский' => 'female'
                ],
                'attr' => ['class' => 'form-control']
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
            ->add('phoneNumbers', PhoneNumbersType::class)
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