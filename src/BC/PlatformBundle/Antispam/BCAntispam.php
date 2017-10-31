<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 16/10/17
 * Time: 10:22
 */
//Création simple du fichier BCAntispam
namespace BC\PlatformBundle\Antispam;

class BCAntispam
{
//    On passe des paramètres privés
    private $mailer;
    private $locale;
    private $minLength;

    public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
    {
        $this->mailer    = $mailer;
        $this->locale    = $locale;
        $this->minLength = (int) $minLength;
    }

//    On crée juste un antispam cad si une annonce fait moins de 50 caractères = spam
    public function isSpam($text)
    {
        return strlen($text) < $this->minLength;
    }
}