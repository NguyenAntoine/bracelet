<?php

namespace App\DataFixtures;

use App\Entity\Drug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DrugFixtures extends Fixture
{
    const DRUG_1 = 'drug-1';
    const DRUG_2 = 'drug-2';

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        ini_set('memory_limit','-1');
        $file = file_get_contents(__DIR__ . "/drugs.txt");

        $lines = explode("\n", $file);
        $i = 0;

        foreach ($lines as $line) {
            $parts = explode(',', $line);
            $last = array_pop($parts);
            $parts = array(implode(',', $parts), $last);

            $drug = new Drug();

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

            if ($i === 25) {
                $this->setReference(self::DRUG_1, $drug);
            } elseif ($i === 42) {
                $this->setReference(self::DRUG_2, $drug);
            }

            $manager->persist($drug);

            if ($i % 25 === 0) {
                $manager->flush();
                $manager->clear();
            }
            $i++;
        }
        $manager->flush();
        $manager->clear();
        ini_set('memory_limit','256M');
    }
}
