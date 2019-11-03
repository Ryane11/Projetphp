<?php

class PostsModel
{
    //Ajouter des posts
	public function addPosts($aInfosUsers)
	{
		  //--- Gestion des Erreurs
        foreach ($aInfosUsers as $sName => $sValue)
        {
            $sMethodControl = 'control'.ucfirst($sName);
            if (method_exists($this, $sMethodControl)) 
            {
                $this->$sMethodControl($sValue);
            }
            
            $sMethodSet = 'set'.ucfirst($sName);
            if (method_exists($this, $sMethodSet)) 
            {
                $aInfosUsers[$sName] = $this->$sMethodSet($sValue);
            }
        }        

		$oBdd = new Database();
 
		return $oBdd->executeSql('INSERT INTO Posts
			(
				Title,
				Description,
				CreationDate,
                User_Id
				
			) VALUES (:title, :description, NOW(),:UserId)',
			$aInfosUsers


		);
	}
        
    //Lire un Post
    public function getOnePost($iId = 0)
    {

        $oBdd = new Database();
        if ($iId > 0) 
        {
            return $oBdd->queryOne('
                    SELECT *
                    FROM Posts
                    WHERE Id=?',
                    [$iId]
            );
        }
    }
    
    // Compter le nombre de Posts
    public function getCountPosts()
    {      
        $oBdd = new Database();
        $posts = $oBdd->queryOne('SELECT COUNT(*) AS nb FROM Posts'); 
        return $posts['nb'];  
    }
    
    //Compter le nombre de posts de cet utilisateur
    public function getCountPostsByUser($iUserId = 0)
    {      
        $oBdd = new Database();
        $posts = $oBdd->queryOne('SELECT COUNT(*) AS nb FROM Posts WHERE User_Id=?', [$iUserId]); 
        return $posts['nb'];    
    }
    
    //R?cup?ration des diff?rents Posts de l'utilisateur
    public function getPostsByUser($iUserId = 0)
    {    
        $oBdd = new Database();
        
        //Si connecter alors r?cuperer ces Posts
        if ($iUserId > 0) {
            return $oBdd->query('SELECT * FROM Posts WHERE User_Id=? ', [$iUserId]);
        } 
    }
    //R?cup?ration des diff?rents Posts
    public function getPosts($postsByPage = 5)
    {    
        $oBdd = new Database();
        
        $currentPage = 1;
        
        if(!empty($_GET['page']) && $_GET['page'] > 0)
        {
           $currentPage = intval($_GET['page']);
        } 
        $defaultPage = ($currentPage-1)*$postsByPage;
        return $oBdd->query('SELECT * FROM Posts ORDER BY CreationDate DESC LIMIT '.$defaultPage.','.$postsByPage);
  
    }
    
    //recherche de Posts
    public function researchPosts($word) 
    {
        $oBdd = new Database();
        return $oBdd->query('SELECT * FROM Posts WHERE Title LIKE "%'.$word.'%"', [$word]);

    } 
    
    //Suppression d'un Posts
	public function Delete($dataId)
	{
	 	//$dataId = $_REQUEST['data-article-id'];
	 	echo ($dataId);

		$oBdd = new Database();
		return $oBdd->query('
			DELETE
			FROM Posts
			WHERE Id = ?',
			[$dataId]);
	}

	private function controlDescription($sValue)
    {
        if (!(strlen($sValue) >= 20)) 
        {
            throw new DomainException('Votre Description dois au moins comporter 20 caractères!');
        }
    }

     private function controlTitle($sValue)
    {
        if (!(strlen($sValue) >= 10)) 
        {
            throw new DomainException('Le titre de l\'article dois comporter au minimum 10 caractères!');
        }
    }

}