<?php

class HomeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $oposts = new PostsModel();
        $oFlash = new FlashBag();
        $postsByPage = 5;
        $currentPage = 1;
        
        if(!empty($_GET['page']) && $_GET['page'] > 0)
        {
           $currentPage = intval($_GET['page']);
        } 
        
        if(isset($queryFields['r']) AND !empty($queryFields['r'])){
            $r =  htmlspecialchars($queryFields['r']);
            $aposts = $oposts->researchPosts($queryFields['r']);
        }
        else{
            $aposts = $oposts->getPosts($postsByPage);
          
        }
        return [
            'posts' => $aposts, 
            'totalPages' => ceil($oposts->getCountPosts()/$postsByPage),
            'currentPage' => $currentPage
        ];
        
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	
    }
    
}

function tronquer($description, $max_caracteres = 80)
    {

    // Test si la longueur du texte dépasse la limite
    if (strlen($description)>$max_caracteres)
    { 
    // Séléction du maximum de caractères
    $description = substr($description, 0, $max_caracteres);
    // Récupération de la position du dernier espace (afin déviter de tronquer un mot)
    $position_espace = strrpos($description, " "); 
    $description = substr($description, 0, $position_espace); 
    // Ajout des "..."
    $description = $description."...";
    }
    return $description;
    }