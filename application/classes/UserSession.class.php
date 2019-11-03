<?php

class UserSession
{
	public function __construct()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
            // Démarrage du module PHP de gestion des sessions.
			session_start();
		}
	}
    
    // public function create($iId, $sEmail, $sLastName, $sFirstName)
    public function create($aData)
    {
    	$_SESSION['user'] = [
        	'Email' 		=> $aData['Email'], 	// $sEmail
        	'FirstName'		=> $aData['FirstName'], // $sFirstName
            'LastName'		=> $aData['LastName'], 	// $sLastName
            'UserId'		=> $aData['Id'],		// $iId
            'UserAdmin'     => $aData['UserAdmin']
        ];
    }
    
    public function delete()
    {
        unset($_SESSION['user']);
    }
    
    
  	public function getEmail()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }

        return $_SESSION['user']['Email'];
    }

    public function getFirstName()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }

        return $_SESSION['user']['FirstName'];
    }

    public function getFullName()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }

        return $_SESSION['user']['FirstName'].' '.$_SESSION['user']['LastName'];
    }

    public function getLastName()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }

        return $_SESSION['user']['LastName'];
    }

    public function getUserId()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }

        return $_SESSION['user']['UserId'];
    }
    
    
    public function isAuthenticated()
	{
		if(array_key_exists('user', $_SESSION) == true)
		{
			if(empty($_SESSION['user']) == false)
			{
				return true;
			}
		}

		return false;
	}

    public function isAdmin()
    {
        if(array_key_exists('user', $_SESSION) == true)
        {
            if(!empty($_SESSION['user']['UserAdmin']) && $_SESSION['user']['UserAdmin'] == 1)
            {
                
                    return true;
            
             }         
        }

    }
       
}