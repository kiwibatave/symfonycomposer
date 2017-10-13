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
//use Symfony\Component\HttpFoundation\RedirectResponse;
//use pour rediriger la réponse
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


//Ce use est utilisé pour générer l'url complète de chaque page
//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
//        On ne sait pas encore combien de pages il y a, mais on sait qu'une page doit être >= à 1
        if ($page < 1) {
//        On déclenche une exception NotFoundHttpException
//        pour afficher une 404 (que l'on peut perso après)
        throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }
//        Ici on récupère la liste des annonces, puis on la passe au template
//        Mais pour le moment on n'appele que le template
        return $this->render('BCPlatformBundle:Advert:index.html.twig', array(
//            Liste d'ads en dur
            'listAdverts' => array(
                array(
                    'title'   => 'Recherche développpeur Symfony',
                    'id'      => 1,
                    'author'  => 'Alexandre',
                    'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
                    'date'    => new \Datetime()),
                array(
                    'title'   => 'Mission de webmaster',
                    'id'      => 2,
                    'author'  => 'Hugo',
                    'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                    'date'    => new \Datetime()),
                array(
                    'title'   => 'Offre de stage webdesigner',
                    'id'      => 3,
                    'author'  => 'Mathieu',
                    'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                    'date'    => new \Datetime())
            )));
//          Modification second argument pour injecter dans la liste
        return $this->render('BCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));


//        $url = $this
//            ->get('router')
//            ->generate(
//                'bc_platform_view',
//                array('id' => 5)
//            );
//        return new Response("L'URL de l'annonce d'id 5 est : ".$url);
//  Cette fonction permet de généner l'url en entière de chaque page
//        $url = $this
//            ->get('router')
//            ->generate(
//                'oc_platform_home',
//                array(), UrlGeneratorInterface::ABSOLUTE_URL
//            );
    }
    //On injecte la requête dans les arguments de la méthode : public function viewAction($id, Request $request)
    public function viewAction($id)
    {
        $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );
//        On récupère l'annonce correspondante à l'id $id
        return $this->render('BCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert
        ));
//        // Récupération session
//        $session = $request->getSession();
//
//        // Récupération du contenu de la var user_id
//        $userId = $session->get('user_id');
//
//        // Définition nouvelle valeur pour var user_id
//        $session->set('user_id', 91);
//
//        // Renvoi de la réponse
//        return new Response("<body> Je suis un test, je répête, je suis un test</body>");

        // On récupère le paramètre tag
        // $tag = $request->query->get('tag');

        // Création de la réponse en JSON grâce à json_encode()
//        $response = new Response(json_encode(array('id' => $id)));

        // Définition du Content-type pour indiquer au navigateur
        // que l'on renvoie du json et non du html

//        $response->headers->set('Content-Type', 'application/json');

//        return $response;

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
          //On ajoute cette méthode pour ajouter une annonce
    public function addAction(Request $request)
    {
//        La gestion d'un form est particulière :
//        - Si la requête est en POST, c'est le visiteur qui a soumis le form
        if ($request->isMethod('POST')) {
//        Ici, on s'occupe de la création et la gestion du form
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
//        Puis on redirige vers la page de visualisation de l'annonce
            return $this->redirectToRoute('bc_platform_view', array('id' => 5));
        }

//        - Si l'on n'est pas en POST, alors on affiche le form
        return $this->render('BCPlatformBundle:Advert:add.html.twig');

//        $session = $request->getSession();
//          // Cette méthode devra réellement ajouter l'annonce
//          // Simulons l'ajout
//        $session->getFlashBag()->add('info', 'Annonce bien enregistrée');
//
//          // Le "FlashBag" est ce qui contient les messages flash dans la session
//          // Et il peut bien entendu contenir plusieurs messages
//        $session->getFlashBag()->add('info', 'Oui oui, elle est bien enregistrée !');
//
//          // On redirige ensuite vers la page de visualisation de cette annonce
//        return $this->redirectToRoute('bc_platform_view', array('id' => 5));

    }

    public function editAction($id, Request $request)
    {
//        Ici, on récupère l'annonce correspondante à $id
//        (Même principe que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('bc_platform_view', array('id' => 5));
        }

        $advert = array(
            'title'    => 'Recherche dev Symfony',
            'id'       => $id,
            'author'   => 'Alex',
            'content'  => 'Nous cherchons un dev Symfony bla bla bla bla',
            'date'     => new \Datetime()

        );

        return $this->render('BCPlatformBundle:Advert:edit.html.twig', array(
            'advert' => $advert
        ));
    }

    public function deleteAction($id)
    {
//        Ici, on récupère l'annonce correspondante à $id
//        Et on génére la suppression de l'annonce en question
        return $this->render('BCPlatform:Bundle:Advert:delete.html.twig');
    }

//    Ajout du menu
    public function menuAction($limit)
    {
//        On fixe ici en dur pour l'ex mais on récupéra dans une bdd après
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche dev Symfony'),
            array('id' => 5, 'title' => 'Mission Webmaster'),
            array('id' => 9, 'title' => 'Offre de stage'),
        );

        return $this->render('BCPlatformBundle:Advert:menu.html.twig', array(
//            !!!! Le contrôleur passe toutes les var
//            dont l'on a besoin au template !!!!
            'listAdverts' => $listAdverts
        ));
    }
//    public function viewSlugAction($slug, $year, $format)
//    {
//        return new Response(
//            "On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format."."
//        );
//    }


//    public function endAction()
//    {
//        $lastpage = $this
//            ->get('templating')
//            ->render('BCPlatformBundle:Advert:end.html.twig');
//        return new Response($lastpage);
//    }
}