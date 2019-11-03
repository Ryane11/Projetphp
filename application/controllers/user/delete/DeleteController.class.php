<?php 

class DeleteController
{
  public function httpGetMethod(Http $http, array $queryFields)
    {
        echo $_REQUEST['data-article-id'];
        $oDelete = new PostsModel();
        $dataId = $_REQUEST['data-article-id'];
        $oDelete -> Delete($dataId);
    }

  public function httpPostMethod(Http $http, array $formFields)
    { 
        
    }

}