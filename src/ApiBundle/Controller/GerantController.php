<?php

/**
 * Created by PhpStorm.
 * User: ajaunasse2015
 * Date: 02/05/2017
 * Time: 11:20
 */

namespace ApiBundle\Controller;

use ApiBundle\Entity\Gerant;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GerantController extends Controller
{

    /**
     * @return array
     */
    public function getGerantsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $gerants = $em->getRepository('ApiBundle:Gerant')->findAll();

        return array('gerants' => $gerants);
    }

    /**
     * @param Gerant $gerant
     * @return array
     */
    public function getGerantAction(Gerant $gerant)
    {
        return array('gerant' => $gerant);
    }

    public function loginAction(Request $request) {
        $em = $this->getDoctrine()->getManager() ;
        $email = $request->query->get('email') ;
        $password = $request->query->get('password') ;
        $jsonResponse = [] ;
        $gerant = $em->getRepository('ApiBundle:Gerant')->findOneByEmail($email);
        if(empty($gerant)){
            return new JsonResponse(['message' => 'Gerant not found'], Response::HTTP_NOT_FOUND);
        }
        if($gerant->getPassword() == $password) {
            $ok = true ;
        } else {
            $ok = false;
        }
        $jsonResponse = array('object' => $gerant, 'ok' => $ok);
        // Récupération du view handler
        $viewHandler = $this->get('fos_rest.view_handler');

        // Création d'une vue FOSRestBundle
        $view = View::create($jsonResponse);
        $view->setFormat('json');

        // Gestion de la réponse
        return $viewHandler->handle($view);
    }
}