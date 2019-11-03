<?php

class PersonalpostsController
{
 public function httpGetMethod(Http $http, array $queryFields)
    {
        $oUserSession = new UserSession();

        if (!$oUserSession->isAuthenticated()) {
            $http->redirectTo('');
        }

        $oPersonalposts = new PostsModel();
        $postsByPage = 5;
        return [
            'posts' => $oPersonalposts->getPostsByUser( $oUserSession->getUserId() ),
            'totalPages' => ceil($oPersonalposts->getCountPosts()/$postsByPage)
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