<?php

namespace App\Form;

use App\Entity\Patent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', null, ['label' => 'Nom* :'])
            ->add('last_name', null, ['label' => 'Prénom* :'])
            ->add('medications', CollectionType::class, [
                'entry_type' => PatentWithMedicationsType::class,
                // these options are passed to each "email" type
                'entry_options' => ['label' => false, 'attr' => ['class' => 'list-group-item']],
                'allow_add' => true,
                'prototype' => true,
                'allow_delete' => true,
            ])
            ->add('emergencyEmails', ChoiceType::class, [
                'label' => 'Mails de proches* :',
                'choices' => ['antoine.ngu@outlook.fr' => 'antoine.ngu@outlook.fr'],
                'multiple' => true,
            ])
            ->add('emergencyPhoneNumbers', ChoiceType::class, [
                'label' => 'Numéros de proches* :',
                'choices' => ['+33610762702' => '+33610762702'],
                'multiple' => true,
            ])
//            ->add('diseases')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patent::class,
        ]);
    }
}
