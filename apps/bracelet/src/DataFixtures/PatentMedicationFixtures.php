<?php

namespace App\DataFixtures;

use App\Entity\PatentMedication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PatentMedicationFixtures extends Fixture implements DependentFixtureInterface
{
    const PATENT_MEDICATION_1 = 'patent-medication-1';
    const PATENT_MEDICATION_2 = 'patent-medication-2';

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $patentMedication = new PatentMedication();
        $patentMedication
            ->setNumber(2)
            ->setPerDay(3)
            ->setSchedule('morning')
            ->setMealPeriod('after')
            ->setDrug($this->getReference(DrugFixtures::DRUG_1));

        $this->setReference(self::PATENT_MEDICATION_1, $patentMedication);
        $manager->persist($patentMedication);

        $patentMedication2 = new PatentMedication();
        $patentMedication2
            ->setMonthsDuration(2)
            ->setNumber(2)
            ->setSchedule('noon')
            ->setMealPeriod('before')
            ->setDrug($this->getReference(DrugFixtures::DRUG_2));

        $this->setReference(self::PATENT_MEDICATION_2, $patentMedication2);
        $manager->persist($patentMedication2);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return [
            DrugFixtures::class,
        ];
    }
}
