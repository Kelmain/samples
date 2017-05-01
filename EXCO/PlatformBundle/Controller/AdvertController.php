<?php
/**
 * Created by PhpStorm.
 * User: Armin
 * Date: 16/04/2017
 * Time: 21:58
 */

namespace EXCO\PlatformBundle\Controller;


use EXCO\PlatformBundle\Entity\Advert;

use EXCO\PlatformBundle\Entity\AdvertSkill;
use EXCO\PlatformBundle\Form\AdvertType;
use EXCO\PlatformBundle\Form\ImageType;
use EXCO\PlatformBundle\Form\CategoryType;
use EXCO\PlatformBundle\Form\AdvertEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{

   public function indexAction($page)
   {
       // On ne sait pas combien de pages il y a
       // Mais on sait qu'une page doit être supérieure ou égale à 1
       if ($page < 1) {
           // On déclenche une exception NotFoundHttpException, cela va afficher
           // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
           throw new NotFoundHttpException('Page "'.$page.'" inexistante.');

       }

       $nbPerPage = 3;

       // Pour récupérer la liste de toutes les annonces : on utilise findAll()
       $listAdverts = $this->getDoctrine()
           ->getManager()
           ->getRepository('EXCOPlatformBundle:Advert')
           ->getAdverts($page, $nbPerPage)
       ;

       $nbPages = ceil(count($listAdverts)/ $nbPerPage);

       if ($page > $nbPages) {
           throw $this->createNotFoundException("La page ".$page." n'existe pas.");

       }
       // Ici, on récupérera la liste des annonces, puis on la passera au template

       // Mais pour l'instant, on ne fait qu'appeler le template

       return $this->render('EXCOPlatformBundle:Advert:index.html.twig', array(
           'listAdverts' => $listAdverts,
           'nbPages' => $nbPages,
           'page' => $page
       ));
   }




   public function viewAction($id)
   {
     $em = $this->getDoctrine()
                ->getManager()
     ;

     $advert = $em->getRepository('EXCOPlatformBundle:Advert')->find($id);

      if (null === $advert) {
        throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
       }

       $listapplication = $em
           ->getRepository('EXCOPlatformBundle:Application')
           ->findBy(array('advert' => $advert))
           ;

      $listAdvertSkills = $em
          ->getRepository('EXCOPlatformBundle:AdvertSkill')
          ->findBy(array('advert' => $advert))
          ;

      return $this->render('EXCOPlatformBundle:Advert:view.html.twig', array(
          'advert' => $advert,
          'listapplication' => $listapplication,
          'listAdvertSkills' => $listAdvertSkills
            ));
   }



   public function addAction(Request $request)
    {

       $advert = new Advert();

        //$form = $this->get('form.factory')->create(AdvertType::class, $advert);
        $form = $this->createForm(AdvertType::class, $advert);

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
       if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


           // c'est elle qui déplace l'image là où on veut les stocker

           // On vérifie que les valeurs entrées sont correctes
           // On enregistre notre objet $advert dans la base de données, par exemple
               $em = $this->getDoctrine()->getManager();
               $em->persist($advert);
               $em->flush();


               $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                // Puis on redirige vers la page de visualisation de cette annonce
               return $this->redirectToRoute('exco_platform_view', array('id' => $advert->getId()));
           }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('EXCOPlatformBundle:Advert:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }




    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('EXCOPlatformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        $form = $this->get('form.factory')->create(AdvertEditType::class, $advert);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // Inutile de persister ici, Doctrine connait déjà notre annonce
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('exco_platform_view', array('id' => $advert->getId()));
        }

        return $this->render('EXCOPlatformBundle:Advert:edit.html.twig', array(
            'advert' => $advert,
            'form'   => $form->createView(),
        ));
    }




    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('EXCOPlatformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($advert);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");

            return $this->redirectToRoute('exco_platform_home');
        }

        return $this->render('EXCOPlatformBundle:Advert:delete.html.twig', array(
            'advert' => $advert,
            'form'   => $form->createView(),
        ));
    }



    public function menuAction()
    {
       $listAdverts = array(
           array('id' => 2, 'title' => 'Recherche développeur Symfony'),
           array('id' => 5, 'title' => 'Mission de webmaster'),
           array('id' => 9, 'title' => 'Offre de stage webdesigner')
       );

       return $this->render('EXCOPlatformBundle:Advert:menu.html.twig', array(
           // Tout l'intérêt est ici : le contrôleur passe
           // les variables nécessaires au template !
           'listAdverts' => $listAdverts
       ));
    }

    public function purgeAction($days, Request $request)
    {

        $purger = $this->get('exco_platform.purger.advert');

        $purger->purge($days);

        $request->getSession()->getFlashBag()->add('info', 'all older then '.$days.'days was purged.');

        return $this->redirectToRoute('exco_platform_home');
    }



}