<?php
class LoginController                                                                                                               
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
        $oUserSession = new UserSession();
        if ($oUserSession->isAuthenticated()) {
            $http->redirectTo('');
        }
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $oUserSession = new UserSession();
        if ($oUserSession->isAuthenticated()) {
            $http->redirectTo('');
        }
        $oUser = new UserModel();
        
       $iId = $aInfos = $oUser->connectUser($formFields);

    
        if (!empty($aInfos)) 
        {
            // On gère la connexion
            $oUserSession = new UserSession();
            $oUserSession->create($aInfos);

            //$http->redirectTo('');

                /***********/
        }
        if ($iId > 0) {
        $oFlash = new FlashBag();
        $oFlash->add('Vous venez de vous connecter à votre compte.');
        $http->redirectTo('/');
            }

        else 
        {
            echo 'Echec d\'identification';
        }

    }
}