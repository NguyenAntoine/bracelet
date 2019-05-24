<?php

namespace App\Controller\Rest;

use App\Entity\MedicationTaken;
use App\Entity\Patent;
use App\Entity\PatentMedication;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Rest\Client;

/**
 * Class PatentController
 * @package App\Controller\Rest
 * @Rest\Version("v1")
 */
class PatentController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/patent/{id}")
     * @param Patent $patent
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getPatentAction(Patent $patent, SerializerInterface $serializer)
    {
        return JsonResponse::fromJsonString($serializer->serialize($patent, 'json'));
    }

    /**
     * @Rest\Post("/medication/{id}/taken/{taken}", defaults={"taken"=1})
     * @param PatentMedication $medication
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @param Client $twilio
     * @param bool $taken
     * @return JsonResponse
     * @throws Exception
     */
    public function postMedicationTaken(
        PatentMedication $medication,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        Client $twilio,
        $taken = true
    )
    {
        $date = new DateTime();
        $medicationTaken = new MedicationTaken();
        $medicationTaken
            ->addPatentsWithMedication($medication->getPatent())
            ->setTaken($taken)
            ->setTakenAt($date);
        $em->persist($medicationTaken);
        $em->flush();

        if (!$taken) {
            // Send SMS
            $twilio->messages->create(
                '+33610762702',
                [
                    'from' => getenv('TWILIO_PHONENUMBER'),
                    'body' => 'Bonjour, ' .
                        $medication->getPatent()->getPatent()->getFullName() .
                        ' n\'a pas pris son médicament ' .
                        $medication->getDrug()->getName() .
                        ' aujourd\'hui à ' . $date->format('H:i')
                ]
            );
        }

        return JsonResponse::fromJsonString($serializer->serialize($medicationTaken, 'json'), Response::HTTP_CREATED);
    }
}
