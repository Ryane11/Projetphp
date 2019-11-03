<?php

class PlacesModel
{
    public function getPlaces(/*Http $http, array $queryFields*/)
    {
        $oBdd = new Database();
        $aPlaces=$oBdd->query('
            SELECT *
            FROM Places');

        return $aPlaces;
        
    }
}