<?php

class PostsController
{

  public function httpGetMethod(Http $http, array $queryFields)
    {
        $oUserSession = new UserSession();
        if (!$oUserSession->isAuthenticated()) {
            $http->redirectTo('');
        }
    }

  public function httpPostMethod(Http $http, array $formFields)
    {
        $oUserSession = new UserSession();
        if (!$oUserSession->isAuthenticated()) 
        {
            $http->redirectTo('');
        }
        
        try {
            if (!empty($formFields['title']) && !empty($formFields['description']))
            {
                $oPosts = new PostsModel();
                $iId = $oPosts->addPosts([
                    'title'         => $formFields['title'],
                    'description'   => $formFields['description'],
                    'UserId'        => $oUserSession->getUserId() 
                ]);
                
                //var_dump($iId);

                if ($iId > 0) 
                {
                    $oFlash = new FlashBag();
                    $oFlash->add('Vous avez bien crée votre article.');
                    $http->redirectTo('/');
                }

                return $formFields;
            }
        }
        catch(DomainException $e) 
        {  
            return array_merge(
                $formFields,
                [ 'sError' => $e->getMessage() ]
            
            );
                
        }

    }


        
}
  