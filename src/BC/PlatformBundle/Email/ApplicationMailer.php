<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 23/10/17
 * Time: 14:54
 */
namespace BC\PlatformBundle\Email;

use BC\PlatformBundle\Entity\Application;

class ApplicationMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewNotification(Application $application)
    {
        $message = new \Swif_Message('Nouvelle candidature', 'Vous avez reçu une nouvelle candidature.');

        $message
            ->addTo($application->getAdvert()->getAuthor()) // Ici il faut mettre l'email mais comme non défini j'utilise "author"
            ->addForm('admin@votresite.com');

        $this->mailer->send($message);
    }
}