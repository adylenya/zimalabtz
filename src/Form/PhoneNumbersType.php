<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\PhoneNumbers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneNumbersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PhoneNumbers::class,
        ]);
    }
}