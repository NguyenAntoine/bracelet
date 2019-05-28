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
use JMS\Serializer\ArrayTransformerInterface;
use JMS\Serializer\SerializerInterface;
use Mailjet\Resources;
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
     * @Rest\Get("/patent/{id}/medication/taken")
     * @param Patent $patent
     * @param ArrayTransformerInterface $serializer
     * @return JsonResponse
     */
    public function getMedicationsTaken(Patent $patent, ArrayTransformerInterface $serializer)
    {
        $medicationsTaken = [];
        $medicationTakenArray = $patent->getMedications();

        foreach ($medicationTakenArray as $patentsWithMedications) {
            $medicationsTaken[] = $serializer->toArray($patentsWithMedications->getMedicationTaken());
        }

        return new JsonResponse($medicationsTaken);
    }

    /**
     * @Rest\Post("/medication/{id}/taken/{taken}", defaults={"taken"=1})
     * @param PatentMedication $medication
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @param Client $client
     * @param bool $taken
     * @return JsonResponse
     * @throws Exception
     */
    public function postMedicationTaken(
        PatentMedication $medication,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        Client $client,
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
            $message = 'Bonjour, ' .
                $medication->getPatent()->getPatent()->getFullName() .
                ' n\'a pas pris son médicament ' .
                $medication->getDrug()->getName() .
                ' aujourd\'hui à ' . $date->format('H:i');

            // Send SMS with Twilio
            $client->messages->create(
                getenv('TWILIO_PHONENUMBER_DEMO'),
                [
                    'from' => getenv('TWILIO_PHONENUMBER'),
                    'body' => $message
                ]
            );

            // Send email with Mailjet
            $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => getenv('MAILJET_EMAIL_DEMO'),
                            'Name' => getenv('MAILJET_EMAIL_DEMO'),
                        ],
                        'To' => [
                            [
                                'Email' => 'antoine.ngu@outlook.fr',
                                'Name' => 'Antoine Nguyen',
                            ]
                        ],
                        'Subject' => '[Observant] Urgent : Oubli de médicament',
                        'TextPart' => $message,
                        'HTMLPart' => $this->render('email/medication_not_taken.html.twig', [
                            'medication' => $medication
                        ]),
                    ]
                ],
            ];
            $mailjetClient = new \Mailjet\Client(
                getenv('MAILJET_APIKEY_PUBLIC'),
                getenv('MAILJET_APIKEY_PRIVATE'),
                true,
                ['version' => 'v3.1']
            );
            $mailjetClient->post(Resources::$Email, ['body' => $body]);
        }

        return JsonResponse::fromJsonString($serializer->serialize($medicationTaken, 'json'), Response::HTTP_CREATED);
    }
}
