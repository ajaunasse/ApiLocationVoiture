<?php
/**
 * Created by PhpStorm.
 * User: ajaunasse2015
 * Date: 03/05/2017
 * Time: 14:03
 */

namespace ApiBundle\Controller;


use ApiBundle\Entity\Location;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends GenericController
{

    /**
     * @param Request $request
     * @param $idVehicule
     * @param $idClient
     * @Rest\Post("/locations")
     */
   public function postLocationsAction(Request $request)
   {
        $vehicule = $this->getRepository('ApiBundle:Vehicule')->find($request->get('vehicule')) ;
        $client = $this->getRepository('ApiBundle:Client')->find($request->get('client')) ;
        $dateDebut = new DateTime(date('Y-m-d', strtotime($request->get('debutLocation'))));
        $dateFin = new DateTime(date('Y-m-d', strtotime($request->get('finLocation'))));

        if(empty($client) || empty($vehicule)) {
            return new JsonResponse(['message' => 'Le vehicule ou le client n\'existe pas'], Response::HTTP_NOT_FOUND);
        }
        $location = new Location();
        $location->setClient($client) ;
        $location->setVehicule($vehicule) ;
        $location->setDateDebutLocation($dateDebut) ;
        $location->setDateFinLocation($dateFin) ;

        $prixTotal = $vehicule->getPrix() * ($dateDebut->diff($dateFin)->days) ;

        $location->setPrixTotal(floatval($prixTotal)) ;
        $vehicule->setEstLoue(true) ;

        $this->getEm()->persist($location) ;
        $this->getEm()->persist($vehicule) ;

        $this->getEm()->flush();

       return new JsonResponse(
           array('ok' => true, 'message' => 'Location ajouté'),
           Response::HTTP_CREATED);


   }

}