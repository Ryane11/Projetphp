<?php

class PlacesController
{

	 public function httpGetMethod(Http $http, array $queryFields)
    {
        $oPlaces = new PlacesModel();


        //var_dump(__DIR__.' [L.'.__LINE__.']');
        
        
        $aPlaces = $oPlaces->getPlaces();
          return [
            'Places'      => $aPlaces
        ];

        

       /* $sName = 'World'; // Valeur par defaut
        // Si on recoit “firstname” depuis $queryFields(GET)

        if (isset($queryFields['firstname'])) {
            $sName = ucfirst(strtolower($queryFields['firstname']));
        }

        // Le framework attend un tableau pour effectuer un extract
        // de celui-ci pour fournir les variables a la vue
        return ['sMyName'=>$sName];*/
    }
}