<?php
/**
 * Created by PhpStorm.
 * User: ajaunasse2015
 * Date: 02/05/2017
 * Time: 14:38
 */

namespace ApiBundle\Controller;


use ApiBundle\Entity\Vehicule;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VehiculeController extends Controller
{
    public function getByAgenceAction(Request $request, $idAgence){
        $em = $this->getDoctrine()->getManager() ;
        $vehicules = $em->getRepository('ApiBundle:Vehicule')->findByAgence($idAgence) ;
        //Cas pas de voiture
        if(empty($vehicules)){
            return new JsonResponse(['message' => 'Aucun vehicules'], Response::HTTP_NOT_FOUND);
        }
            // Récupération du view handler
            $viewHandler = $this->get('fos_rest.view_handler');

            // Création d'une vue FOSRestBundle
            $view = View::create($vehicules);
            $view->setFormat('json');

            // Gestion de la réponse
            return $viewHandler->handle($view);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function postVehiculesAction(Request $request) {
        $vehicule = new Vehicule();
        $em = $this->getDoctrine()->getManager() ;
        $agence = $em->getRepository('ApiBundle:Agence')->find($request->get('agence')) ;
        $vehicule->setImmatriculation($request->get('immatriculation'))
            ->setMarque($request->get('marque'))
            ->setLibelle($request->get('libelle'))
            ->setCaracteristiques($request->get('caracteristiques'))
            ->setPrix($request->get('prix'))
            ->setAgence($agence) ;

        $em->persist($vehicule);
        $em->flush();

        return new JsonResponse(array('ok' => 'Vehicule créer'), Response::HTTP_CREATED);

    }
}