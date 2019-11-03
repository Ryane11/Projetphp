<?php


class UserModel
{

	public function addUser($aInfosUsers)
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
        
    
        //--- Appel de la Base de Données
    	$oBdd = new Database();

        $user = $oBdd->queryOne('SELECT Id FROM User WHERE Email = ?', [ $aInfosUsers['email'] ]);
        
         // @todo : Gérer les utilisateurs déjà enregistré
        if (!empty($user)) {
        	// On ne peut pas ajouter cet utilisateur
        }


         $aInfosUsers['password'] = $this->hashPassword($aInfosUsers['password']);
        
        
         // Insertion de l'utilisateur

        $iIdUser = $oBdd->executeSql('INSERT INTO User
			(
				LastName,
				FirstName,
				Email,
				Password,
				BirthDate,
				CreationDate,
				Adress,
				City,
				Phone
			) VALUES (:lastName, :firstName, :email, :password, :birthDate, NOW(), :address, :city, :phone)',
			$aInfosUsers

		);

        if ($iIdUser == 0) {

        	
			// @todo : gérer le message d'erreur (flashBag)
        }

        return $iIdUser;        
        
	}

	public function connectUser($aData)
    {
    
   		$oBdd = new Database();
    	$user = $oBdd->queryOne('SELECT Id, Password, Email, LastName, FirstName, UserAdmin FROM User WHERE Email = ?', [ $aData['email'] ]);
        

        if (!empty($user)) 
        {
        
        	// $aData['password'] : correspond au password en clairt soumis par l'utilisateur
            // $user['Password'] : correspond au hash se trouvant en base de données
            if (password_verify($aData['password'], $user['Password'])) {
				return $user;
            } 
        }
       // var_dump($aData);
        return false;
    }


    private function controlEmail($sValue)
    {
        if (!filter_var($sValue , FILTER_VALIDATE_EMAIL ) ) 
        {
            throw new DomainException('Votre adresse n\'a pas le format attendu !');
        }
    }

    private function controlPhone($sValue)
    {
        //var_dump($sValue);
        if (!preg_match('/^([0-9]{2}[\s\.\-]?){5}$/', $sValue))
        {
            throw new DomainException('Veuillez saisir un numéro de téléphone Valide !');
        }
       
        
    }

    private function controlPassword($sValue)
    {
        if (!(strlen($sValue) >= 6)) 
        {
            throw new DomainException('Votre mot de passe dois être supperieur a 6 caractères !');
        }
    }
  
        
    private function setLastName($sValue)
    {
        return strtoupper($sValue);
    }
    

	private function hashPassword($sPassword)
    {
   		return password_hash($sPassword, PASSWORD_DEFAULT);
    }
      

}


