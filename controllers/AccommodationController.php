<?php

namespace controllers;

use Entities\Accommodation;
use kernel\Kernel;
use Kernel\ServiceHandler\ServiceInterface;
use Services\HttpFoundation\AccessDeniedException;


class AccommodationController extends BaseController
{
    public static function getName(){
        return "accommodation.controller";
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function index(){
        $kernel = $this->kernel;

        $dataBase = $kernel->get("database.object");
        $databaseService = $kernel->get("database.service");
        $accommodationService = $kernel->get("accommodation.service");
        $sessionService = $kernel->get("session.manager");
        $accommodationService->setServiceConnect($databaseService);
        $accommodationService->setDataBaseObject($dataBase);
        $databaseService->connect($dataBase);
        $user = $sessionService->getCurrentUser();
        $accomodations = $accommodationService->getAccommodationByUserId($user->getId());
       

        //$var = $this->get('access.granter')->isGranted("AUTHENTICATED_USER");
        //if($var)
            return $this->get("template.service")->parse("appartements/modifierAppartement.php", array("user"=>$this->get('session.manager')->getCurrentUser(), "accomodations" =>$accomodations));

        //throw new AccessDeniedException();
    }
}

