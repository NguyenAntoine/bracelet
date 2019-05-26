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
        $file = file_get_contents(__DIR__ . "/diseases.json");
        $diseases = json_decode($file, true);

        $i = 0;
        foreach ($diseases['children'] as $categories) {
            foreach ($categories['children'] as $subcategories) {
                foreach ($subcategories['children'] as $diseaseJson) {
                    $disease = new Disease();
                    $disease
                        ->setName($diseaseJson['name'])
                        ->setChronically(true);

                    if ($i === 1) {
                        $this->setReference(self::DISEASE_1, $disease);
                    }
                    $manager->persist($disease);

                    if ($i % 25 === 0) {
                        $manager->flush();
                        $manager->clear();
                    }

                    $i++;
                }

            }
        }
        $manager->flush();
        $manager->clear();
    }
}
