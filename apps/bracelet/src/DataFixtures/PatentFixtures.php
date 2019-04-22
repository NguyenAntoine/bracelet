<?php

namespace App\DataFixtures;

use App\Entity\Patent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PatentFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $patent = new Patent();
        $patent
            ->setFirstName('Robert')
            ->setLastName('Michel')
            ->setMedication($this->getReference(PatentMedicationFixtures::PATENT_MEDICATION_1))
            ->addDisease($this->getReference(DiseaseFixtures::DISEASE_1));

        $manager->persist($patent);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return [
            DiseaseFixtures::class,
            DrugFixtures::class,
            PatentMedicationFixtures::class,
        ];
    }
}
