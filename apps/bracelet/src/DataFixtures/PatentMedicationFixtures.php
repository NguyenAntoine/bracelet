<?php

namespace App\DataFixtures;

use App\Entity\PatentMedication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PatentMedicationFixtures extends Fixture
{
    const PATENT_MEDICATION_1 = 'patent-medication-1';

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $patentMedication = new PatentMedication();
        $patentMedication
            ->setMonthsDuration('2')
            ->setNumber(2)
            ->setPerDay('3')
            ->setSchedule('matin')
            ->setMealPeriod('après');
        $this->setReference(self::PATENT_MEDICATION_1, $patentMedication);
        $manager->persist($patentMedication);
        $manager->flush();
    }
}
