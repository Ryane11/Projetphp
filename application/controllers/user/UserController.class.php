<?php

class UserController
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
        try {
            $formFields['birthDate'] = $formFields['birthYear'].'-'.$formFields['birthMonth'].'-'.$formFields['birthDay'];
            unset($formFields['birthYear']);
            unset($formFields['birthMonth']);
            unset($formFields['birthDay']);


            $oUser = new UserModel();
            $iId = $oUser->addUser($formFields);

            if ($iId > 0) {
                $oFlash = new FlashBag();
                $oFlash->add('Votre inscription a bien été prise en compte.');
                $http->redirectTo('/user/login');
              
            }

            return $formFields;
        }
        catch(DomainException $e) {
            
            return array_merge(
            
                $formFields,
                [ 'sError' => $e->getMessage() ]
            
            );
            
        }
       
        
    }
}


