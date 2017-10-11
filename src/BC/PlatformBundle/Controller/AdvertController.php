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
use Symfony\Component\HttpFoundation\Request;
//Use utilisé pour récupérer le Request
use Symfony\Component\HttpFoundation\RedirectResponse;
//use pour rediriger la réponse
use Symfony\Component\HttpFoundation\Response;
//Ce use est utilisé pour générer l'url complète de chaque page
//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{
    //On injecte la requête dans les arguments de la méthode
    public function viewAction($id)
    {
        // On récupère le paramètre tag
        // $tag = $request->query->get('tag');

        // Création de la réponse en JSON grâce à json_encode()
        $response = new Response(json_encode(array('id' => $id)));

        // Définition du Content-type pour indiquer au navigateur
        // que l'on renvoie du json et non du html

        $response->headers->set('Content-Type', 'application/json');

        return $response;



//        return $this->redirectToRoute('bc_platform_home');

        // $id vaut 5 si l'on a appelé l'URL /platform/advert/5
        // Ici, on récupèrera depuis la base de données
        // l'annonce correspondant à l'id $id.
        // Puis on passera l'annonce à la vue pour
        // qu'elle puisse l'afficher

        // On utilise le raccourci : il crée un objet Response
        //Et on lui donne comme contenu, le contenu du template
//        return $this->render(
//            'BCPlatformBundle:Advert:view.html.twig',
//            array('id' => $id, 'tag' => $tag)
//        );

//        // On crée la réponse sans contenu (pour l'instant)
//        $response = new Response();
//
//        // On définit le contenu
//        $response->setContent("Ceci est une page d'erreur 404");
//
//        // On définit le code http à Not Found (erreur 404)
//        $response->setStatusCode(Response::HTTP_NOT_FOUND);
//
//        // On retourne la réponse
//        return $response;

//        return new Response("Affichage de l'annonce d'id: ".$id.", avec le tag : ".$tag);
    }

    public function viewSlugAction($slug, $year, $format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format."."
        );
    }

    public function indexAction()
    {
        $url = $this
            ->get('router')
            ->generate(
                'bc_platform_view',
                array('id' => 5)
            );
        return new Response("L'URL de l'annonce d'id 5 est : ".$url);
//  Cette fonction permet de généner l'url en entière de chaque page
//        $url = $this
//            ->get('router')
//            ->generate(
//                'oc_platform_home',
//                array(), UrlGeneratorInterface::ABSOLUTE_URL
//            );
    }

    public function endAction()
    {
        $lastpage = $this
            ->get('templating')
            ->render('BCPlatformBundle:Advert:end.html.twig');
        return new Response($lastpage);
    }
}