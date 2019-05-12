<?php

namespace App\DataFixtures;

use App\Entity\Disease;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DiseaseFixtures extends Fixture
{
    const DISEASE_1 = 'disease_1';

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $disease = new Disease();
        $disease
            ->setName("Thyroïde")
            ->setChronically(true);
        $this->setReference(self::DISEASE_1, $disease);
        $manager->persist($disease);
        $manager->flush();
    }
}
