<?php

namespace App\DataFixtures;

use App\Entity\Patent;
use App\Entity\PatentsWithMedications;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PatentsWithMedicationsFixtures extends Fixture implements DependentFixtureInterface
{
    const PATENTS_WITH_MEDICATIONS_1 = 'patents-with-medications-1';
    const PATENTS_WITH_MEDICATIONS_2 = 'patents-with-medications-2';

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $patentsWithMedications = new PatentsWithMedications();
        $patentsWithMedications
            ->setPatent($this->getReference(PatentFixtures::PATENT_1))
            ->setPatentMedication($this->getReference(PatentMedicationFixtures::PATENT_MEDICATION_1));
        $this->setReference(self::PATENTS_WITH_MEDICATIONS_1, $patentsWithMedications);

        $manager->persist($patentsWithMedications);

        $patentsWithMedications2 = new PatentsWithMedications();
        $patentsWithMedications2
            ->setPatent($this->getReference(PatentFixtures::PATENT_1))
            ->setPatentMedication($this->getReference(PatentMedicationFixtures::PATENT_MEDICATION_2));
        $this->setReference(self::PATENTS_WITH_MEDICATIONS_2, $patentsWithMedications2);

        $manager->persist($patentsWithMedications2);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return [
            PatentFixtures::class,
            PatentMedicationFixtures::class,
        ];
    }
}
