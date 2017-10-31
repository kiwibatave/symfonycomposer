<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 18/10/17
 * Time: 16:05
 */
namespace BC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BC\PlatformBundle\Entity\Skill;

class LoadSkill implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $names = array('PHP', 'Symfony', 'Java', 'PhpStorm', 'Photoshop',);

        foreach ($names as $name) {
//            On crée la compétence
            $skill = new Skill();
            $skill->setName($name);

//            On persiste
            $manager->persist($skill);
        }
//        On lance l'enregistrement de toutes les catégories
        $manager->flush();
    }
}