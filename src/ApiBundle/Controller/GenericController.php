<?php
/**
 * Created by PhpStorm.
 * User: ajaunasse2015
 * Date: 03/05/2017
 * Time: 09:21
 */

namespace ApiBundle\Controller;


use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GenericController extends Controller
{

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    protected function getEm() {
        return $this->getDoctrine()->getManager() ;
    }

    /**
     * @param $class
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository($class) {
        return $this->getEm()->getRepository($class) ;
    }

    /**
     * @param $entity
     * @param $format
     * @return mixed
     */
    protected function handleView($entity, $format) {
        // Récupération du view handler
        $viewHandler = $this->get('fos_rest.view_handler');

        // Création d'une vue FOSRestBundle
        $view = View::create($entity);
        $view->setFormat($format);

        return $viewHandler->handle($view);
    }

}