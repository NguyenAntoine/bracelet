<?php

namespace App\DataFixtures;

use App\Entity\Patent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PatentFixtures extends Fixture implements DependentFixtureInterface
{
    const PATENT_1 = 'patent-1';

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $patent = new Patent();
        $patent
            ->setFirstName('Robert')
            ->setLastName('Michel')
            ->addDisease($this->getReference(DiseaseFixtures::DISEASE_1));

        $this->setReference(self::PATENT_1, $patent);

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
        ];
    }
}
