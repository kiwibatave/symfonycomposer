<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 10/10/17
 * Time: 14:14
 */
//on se place dans le namespace des contrôleurs de notre bundle. Suivez juste la structure des répertoires dans lequel se trouve le contrôleur.
namespace BC\PlatformBundle\Controller;
//use pour utiliser notre bundle Platform
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// le nom de notre contrôleur respecte le nom du fichier pour que l'autoload fonctionne.
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function viewAction($id)
    {
        // $id vaut 5 si l'on a appelé l'URL /platform/advert/5
        // Ici, on récupèrera depuis la base de données
        // l'annonce correspondant à l'id $id.
        // Puis on passera l'annonce à la vue pour
        // qu'elle puisse l'afficher

        return new Response("Affichage de l'annonce d'id: ".$id);
    }

    public function viewSlugAction($slug, $year, $format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format."."
        );
    }
//    public function indexAction()
////On définit la méthode indexAction(). Mettre le suffixe Action derrière le nom de la méthode.
//    {
////On récupère via GET le template et on l'affiche via RENDER en allant le chercher où il se trouve
//        $content = $this
//            ->get('templating')
//            ->render('BCPlatformBundle:Advert:index.html.twig', array('name' => 'Hombres'))
//        ;
////On crée une simple réponse. L'argument de l'objet Response. Et on retourne l'objet.
//        return new Response($content);
//    }
    public function endAction()
    {
        $lastpage = $this
            ->get('templating')
            ->render('BCPlatformBundle:Advert:end.html.twig');
        return new Response($lastpage);
    }
}