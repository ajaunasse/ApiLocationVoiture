<?php
/**
 * Created by PhpStorm.
 * User: ajaunasse2015
 * Date: 02/05/2017
 * Time: 14:38
 */

namespace ApiBundle\Controller;


use ApiBundle\Entity\Agence;
use ApiBundle\Entity\Vehicule;
use ApiBundle\Form\VehiculeType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
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
        $vehicule = $this->constructObjectVehicule($vehicule) ;

        $em->persist($vehicule);
        $em->flush();

        return new JsonResponse(
            array('ok' => true, 'message' => 'Vehicule créé'),
            Response::HTTP_CREATED);

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function putVehiculesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager() ;
        $vehicule = $em->getRepository('ApiBundle:Vehicule')->find($id) ;
        $agence = $em->getRepository('ApiBundle:Agence')->find($request->get('agence')) ;
        if($vehicule && $agence) {

            $vehicule = $this->constructObjectVehicule($vehicule) ;

            $em->persist($vehicule);
            $em->flush();

            return new JsonResponse(
                array('ok' => true, 'message' => 'Vehicule edité'),
                Response::HTTP_CREATED);
        } else {
            return new JsonResponse(['message' => 'Le vehicule n\'existe pas'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * DELETE VEHICULE
     * @return array
     * @Rest\Delete("/vehicules/{id}")
     * @Rest\View(statusCode=204)
     */
    public function deleteVehiculesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $user = $em->getRepository('ApiBundle:Vehicule')->find($request->get('id'));

        if ($user) {
            $em->remove($user);
            $em->flush();
            return new JsonResponse(
                array('ok' => true, 'message' => 'Vehicule supprimé'),
                Response::HTTP_CREATED);
        } else {
            return new JsonResponse(['message' => 'Le vehicule n\'existe pas'], Response::HTTP_NOT_FOUND);
        }
    }


    /**
     * @param Request $request
     * @param Vehicule $vehicule
     * @param Agence $agence
     * @return Vehicule
     */
    private function constructObjectVehicule(Request $request, Vehicule $vehicule, Agence $agence) {
        $vehicule->setImmatriculation($request->get('immatriculation'))
            ->setMarque($request->get('marque'))
            ->setLibelle($request->get('libelle'))
            ->setCaracteristiques($request->get('caracteristiques'))
            ->setPrix($request->get('prix'))
            ->setImage($request->get('image'))
            ->setAgence($agence);

        return $vehicule;
    }

}