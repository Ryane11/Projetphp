<?php
class LogoutController                                                                                                       
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
        $oUserSession = new UserSession();
		$oUserSession->delete();
		$http->redirectTo('/');
    }

}
