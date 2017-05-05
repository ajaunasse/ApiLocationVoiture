<?php
/**
 * Created by PhpStorm.
 * User: ajaunasse2015
 * Date: 03/05/2017
 * Time: 09:09
 */

namespace ApiBundle\Controller;

use ApiBundle\Entity\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
class ClientController extends GenericController
{

    /**
     * Get list Client
     * @return array
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/client/clients
     */
    public function getClientsAction() {
        return $this->handleView( $this->getRepository('ApiBundle:Client')->findAll(), 'json') ;
    }


    /**
     * Get detail Client
     * @param $id
     * @return JsonResponse|mixed
     * Exemples : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/client/clients/1
     */
    public function getClientAction($id) {
        $client = $this->getRepository('ApiBundle:Client')->find($id);
        if(empty($client)) {
            return new JsonResponse(['message' => 'Le client n\'existe pas'], Response::HTTP_NOT_FOUND);
        }

        return $this->handleView($client, 'json');
    }

    /**
     * Ajout d'un client
     * Requête type post
     * @param Request $request
     * @return JsonResponse
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/client/clients
     * Params : nom, prenom, adresse, codepostal, ville, email, telephone
     */
    public function postClientsAction(Request $request) {
        $client = new Client();
        $client = $this->constructObjectVehicule($request, $client) ;

        $this->getEm()->persist($client);
        $this->getEm()->flush();

        return new JsonResponse(
            array('ok' => true, 'message' => 'Client créé'),
            Response::HTTP_CREATED);

    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function putClientsAction(Request $request, $id)
    {
        $client = $this->getRepository('ApiBundle:Client')->find($id) ;
        if($client) {
            $client = $this->constructObjectVehicule($request, $client) ;

            $this->getEm()->persist($client);
            $this->getEm()->flush();

            return new JsonResponse(
                array('ok' => true, 'message' => 'Client edité'),
                Response::HTTP_CREATED);
        } else {
            return new JsonResponse(['message' => 'Le vehicule n\'existe pas'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * DELETE CLIENT
     * Requête type delete
     * @Rest\Delete("/clients/{id}")
     * @Rest\View(statusCode=204)
     * Exemple : http://localhost:8080/ApiLocationVoiture/web/app_dev.php/api/client/clients/3
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteVehiculesAction(Request $request)
    {
        $client = $this->getRepository('ApiBundle:Client')->find($request->get('id'));

        if ($client) {
            $this->getEm()->remove($client);
            $this->getEm()->flush();
            return new JsonResponse(
                array('ok' => true, 'message' => 'Client supprimé'),
                Response::HTTP_CREATED);
        } else {
            return new JsonResponse(['message' => 'Le client n\'existe pas'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @param Client $client
     * @return Client
     */
    private function constructObjectVehicule(Request $request, Client $client)
    {
        $client->setNom($request->get('nom'))
            ->setPrenom($request->get('prenom'))
            ->setAdresse($request->get('adresse'))
            ->setCodepostal($request->get('codepostal'))
            ->setVille($request->get('ville'))
            ->setEmail($request->get('email'))
            ->setTelephone($request->get('telephone')) ;

        return $client;
    }

}