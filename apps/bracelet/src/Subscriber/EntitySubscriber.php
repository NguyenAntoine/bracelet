<?php
/**
 * Created by PhpStorm.
 * User : Antoine
 * Date : 16/04/2019
 * Time : 15:12
 */

namespace App\Subscriber;

use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Exception;

class EntitySubscriber implements EventSubscriber
{
    /**
     * @return array|string[]
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate',
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws Exception
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $this->setCreatedAt($entity);
    }

    protected function setCreatedAt($entity)
    {
        if (method_exists($entity, 'setCreatedAt')) {
            $entity->setCreatedAt(new DateTime());
        }

    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $this->setUpdatedAt($entity);
    }

    protected function setUpdatedAt($entity)
    {
        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new DateTime());
        }
    }
}
