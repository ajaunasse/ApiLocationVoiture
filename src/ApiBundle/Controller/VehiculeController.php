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

class VehiculeController extends GenericController
{
    /**
     * Get all Vehicules by agence
     * @param Request $request
     * @param $idAgence
     * @return mixed|JsonResponse
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/vehicule/agence/vehicules/1
     */
    public function getByAgenceAction(Request $request, $idAgence){
        $vehicules = $this->getRepository('ApiBundle:Vehicule')->findByAgence($idAgence) ;
        //Cas pas de voiture
        if(empty($vehicules)){
            return new JsonResponse(['message' => 'Aucun vehicules'], Response::HTTP_NOT_FOUND);
        }

        return $this->handleView($vehicules, 'json') ;
    }

    /**
     * Ajout d'un vehicule
     * Requête type post
     * @param Request $request
     * @return JsonResponse
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/vehicule/vehicules
     * Params : immatriculation, marque, libelle, caracteristiques, prix, agence, image
     */
    public function postVehiculesAction(Request $request) {
        $vehicule = new Vehicule();
        $agence = $this->getRepository('ApiBundle:Agence')->find($request->get('agence')) ;
        if(empty($agence)){
            return new JsonResponse(['message' => 'L\'agence n\'existe pas'], Response::HTTP_NOT_FOUND);
        }
        $vehicule = $this->constructObjectVehicule($request, $vehicule, $agence) ;

        $this->getEm()->persist($vehicule);
        $this->getEm()->flush();

        return new JsonResponse(
            array('ok' => true, 'message' => 'Vehicule créé'),
            Response::HTTP_CREATED);

    }

    /**
     * Edit Vehicule
     * Requête de type put
     * @param Request $request
     * @param $id
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/vehicule/vehicules/1
     * Params : immatriculation, marque, libelle, caracteristiques, prix, agence, image
     */
    public function putVehiculesAction(Request $request, $id)
    {
        $vehicule = $this->getRepository('ApiBundle:Vehicule')->find($id) ;
        $agence = $this->getRepository('ApiBundle:Agence')->find($request->get('agence')) ;
        if($vehicule && $agence) {
            $vehicule = $this->constructObjectVehicule($request, $vehicule, $agence) ;

            $this->getEm()->persist($vehicule);
            $this->getEm()->flush();

            return new JsonResponse(
                array('ok' => true, 'message' => 'Vehicule edité'),
                Response::HTTP_CREATED);
        } else {
            return new JsonResponse(['message' => 'Le vehicule n\'existe pas'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * DELETE VEHICULE
     * Requête type delete
     * @return array
     * @Rest\Delete("/vehicules/{id}")
     * @Rest\View(statusCode=204)
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/vehicule/vehicules/4
     */
    public function deleteVehiculesAction(Request $request)
    {
        $vehicule = $this->getRepository('ApiBundle:Vehicule')->find($request->get('id'));

        if ($vehicule) {
            $this->getEm()->remove($vehicule);
            $this->getEm()->flush();
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