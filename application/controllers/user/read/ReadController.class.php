<?php
class ReadController
{

	public function httpGetMethod(Http $http, array $queryFields)
    {
        $oUserSession = new UserSession();

        if (!$oUserSession->isAuthenticated()) {
            $http->redirectTo('');
        }

    	$oread = new PostsModel();
      	return [
            'post' => $oread->getOnePost($queryFields['id_post'])
        ];

    }

	public function httpPostMethod(Http $http, array $formFields)
    {
   
        $oUserSession = new UserSession();
        if (!$oUserSession->isAuthenticated()) {
            $http->redirectTo('');
        }
    }
}