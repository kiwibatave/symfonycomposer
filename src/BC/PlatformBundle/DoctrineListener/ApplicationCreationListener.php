<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 23/10/17
 * Time: 15:18
 */

namespace BC\PlatformBundle\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use BC\PlatformBundle\Email\ApplicationMailer;
use BC\PlatformBundle\Entity\Application;

class ApplicationCreationListener
{
    /**
     * @var ApplicationMailer
     */
    private $applicationMailer;

    public function __construct(ApplicationMailer $applicationMailer)
    {
        $this->applicationMailer = $applicationMailer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

//        On ne veut envoyer un mail que pour les entités Application
        if(!$entity instanceof Application)
        {
            return;
        }

        $this->applicationMailer->sendNewNotification($entity);
    }
}