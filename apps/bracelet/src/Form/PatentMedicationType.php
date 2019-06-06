<?php

namespace App\Form;

use App\Entity\Drug;
use App\Entity\PatentMedication;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatentMedicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('drug', EntityType::class, [
                'class' => Drug::class,
                'choice_label' => function(Drug $drug) {
                    return $drug->getName() . ' - ' . $drug->getType() . ' - ' . $drug->getInjectionType();
                },
                'attr' => ['class' => 'select2']
            ])
            ->add('schedule', null, ['label' => 'Période de la journée* :'])
            ->add('mealPeriod', null, ['label' => 'Période pendant le repas* :'])
            ->add('number', null, ['label' => 'Nombre à prendre* : '])
            ->add('weeksDuration', null, ['label' => 'Durée en semaine :', 'required' => false])
            ->add('monthsDuration', null, ['label' => 'Durée en mois :', 'required' => false])
            ->add('perDay', null, ['label' => 'Par jour :', 'required' => false])
            ->add('perWeek', null, ['label' => 'Par semaine :', 'required' => false])
            ->add('perMonth', null, ['label' => 'Par mois :', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatentMedication::class,
        ]);
    }
}
