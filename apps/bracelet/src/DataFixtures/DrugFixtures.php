<?php

namespace App\DataFixtures;

use App\Entity\Drug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DrugFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        ini_set('memory_limit','-1');
        $file = file_get_contents(__DIR__ . "/cis.txt");

        $lines = explode("\n", $file);
        $i = 0;

        foreach ($lines as $line) {
            $parts = explode(',', $line);
            $last = array_pop($parts);
            $parts = array(implode(',', $parts), $last);

            $drug = new Drug();

            if ($i === 25) {
                $drug->setPatents($this->getReference(PatentMedicationFixtures::PATENT_MEDICATION_1));
            }

            $nameAndNo = $parts[0];
            $part = explode('	', $nameAndNo);

            if (isset($part[0]) or $part[0] != "") {
                $no = $part[0];
                $drug->setNoDrug($no);
            }
            if (isset($part[1])) {
                $name = $part[1];
                $drug->setName($name);
            } else {
                $drug->setName("Medicament test");
            }

            $typeAndWay = $parts[1];
            $part = explode('	', $typeAndWay);

            if (isset($part[1]) or $part[1] != "") {
                $type = $part[1];
                $type = ltrim($type, ' ');
                $drug->setType($type);
            }
            if (isset($part[2]) or $part[2] != "") {
                $way = $part[2];
                $drug->setInjectionType($way);
            }
            $manager->persist($drug);
            $i++;
        }
        $manager->flush();
        ini_set('memory_limit','256M');
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return [
            PatentMedicationFixtures::class,
        ];
    }
}
