<?php

namespace App\Controller\Rest;

use App\Entity\Patent;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

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
}
