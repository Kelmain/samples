<?php

namespace EXCO\CoreBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{

    public function indexAction()
    {

        return $this->render('EXCOCoreBundle:Core:index.html.twig');

    }

    public function contactAction(Request $request)
    {

        $session = $request->getSession();

        $session->getFlashBag()->add('info', 'le formulaire arrive bientôt.');


       return $this->redirect($this->generateUrl('exco_core_home'));
    }
}
