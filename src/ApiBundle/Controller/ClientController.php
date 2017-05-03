<?php
/**
 * Created by PhpStorm.
 * User: ajaunasse2015
 * Date: 03/05/2017
 * Time: 09:09
 */

namespace ApiBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends GenericController
{

    /**
     * @return array
     */
    public function getClientsAction() {
        return array('clients' =>  $this->getRepository('ApiBundle:Client')->findAll());
    }


    public function getClientAction($id) {
        $client = $this->getRepository('ApiBundle:Client')->find($id);
        if(empty($client)) {
            return new JsonResponse(['message' => 'Le client n\'existe pas'], Response::HTTP_NOT_FOUND);
        }

        return $this->handleView($client, 'json');
    }

}