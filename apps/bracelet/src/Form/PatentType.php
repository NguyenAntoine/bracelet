<?php

namespace App\Form;

use App\Entity\Patent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', null, ['label' => 'Nom'])
            ->add('last_name', null, ['label' => 'Prénom'])
            ->add('emergencyEmails', ChoiceType::class, [
                'label' => 'Mails de proches',
                'choices' => ['antoine.ngu@outlook.fr' => 'antoine.ngu@outlook.fr']
            ])
            ->add('emergencyPhoneNumbers', ChoiceType::class, [
                'label' => 'Numéros de proches',
                'choices' => ['+33610762702' => '+33610762702']
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
