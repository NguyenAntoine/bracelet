<?php

namespace App\DataFixtures;

use App\Entity\MedicationTaken;
use App\Entity\Patent;
use App\Entity\PatentsWithMedications;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MedicationTakenFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $date = new DateTime();

        $medicationTaken = new MedicationTaken();
        $medicationTaken
            ->addPatentsWithMedication($this->getReference(PatentsWithMedicationsFixtures::PATENTS_WITH_MEDICATIONS_1))
            ->setTaken(true)
            ->setTakenAt($date->modify('-2 days'));

        $manager->persist($medicationTaken);

        $medicationTaken = new MedicationTaken();
        $medicationTaken
            ->addPatentsWithMedication($this->getReference(PatentsWithMedicationsFixtures::PATENTS_WITH_MEDICATIONS_2))
            ->setTaken(true)
            ->setTakenAt($date->modify('-2 days'));

        $date = new DateTime();

        $manager->persist($medicationTaken);

        $medicationTaken = new MedicationTaken();
        $medicationTaken
            ->addPatentsWithMedication($this->getReference(PatentsWithMedicationsFixtures::PATENTS_WITH_MEDICATIONS_1))
            ->setTaken(false)
            ->setTakenAt($date->modify('-1 day'));

        $manager->persist($medicationTaken);

        $medicationTaken = new MedicationTaken();
        $medicationTaken
            ->addPatentsWithMedication($this->getReference(PatentsWithMedicationsFixtures::PATENTS_WITH_MEDICATIONS_2))
            ->setTaken(true)
            ->setTakenAt($date->modify('-1 day'));

        $manager->persist($medicationTaken);

        $date = new DateTime();

        $medicationTaken = new MedicationTaken();
        $medicationTaken
            ->addPatentsWithMedication($this->getReference(PatentsWithMedicationsFixtures::PATENTS_WITH_MEDICATIONS_1))
            ->setTaken(false)
            ->setTakenAt($date);

        $manager->persist($medicationTaken);

        $medicationTaken = new MedicationTaken();
        $medicationTaken
            ->addPatentsWithMedication($this->getReference(PatentsWithMedicationsFixtures::PATENTS_WITH_MEDICATIONS_2))
            ->setTaken(true)
            ->setTakenAt($date);

        $manager->persist($medicationTaken);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return [
            PatentsWithMedicationsFixtures::class,
        ];
    }
}
