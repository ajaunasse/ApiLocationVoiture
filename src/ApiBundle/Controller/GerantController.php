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
use FOS\RestBundle\Controller\Annotations as Rest;
class GerantController extends GenericController
{

    /**
     * @return array
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/gerant/gerants
     */
    public function getGerantsAction()
    {
        return array('gerants' =>  $this->getRepository('ApiBundle:Gerant')->findAll());
    }

    /**
     * @param Gerant $gerant
     * @return array
     */
    public function getGerantAction(Gerant $gerant)
    {
        return array('gerant' => $gerant);
    }

    /**
     * API LOGIN GERANT (Param url : email & password)
     * @param Request $request
     * @return JsonResponse
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/gerant/login?email=louie54@yahoo.com&password=test
     */
    public function loginAction(Request $request) {
        //Récupération des paramètres
        $email = $request->query->get('email') ;
        $password = $request->query->get('password') ;
        //Query
        $gerant = $this->getRepository('ApiBundle:Gerant')->findOneByEmail($email);

        if(empty($gerant)){
            return new JsonResponse(['message' => 'Gerant not found'], Response::HTTP_NOT_FOUND);
        }
        //check password ok
        $ok = $gerant->getPassword() == $password ;

        $jsonResponse = array('object' => $gerant, 'ok' => $ok);

        return $this->handleView($jsonResponse, 'json');
    }
}