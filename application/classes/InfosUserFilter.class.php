<?php

class InfosUserFilter implements InterceptingFilter
{
	public function run(Http $http, array $queryFields, array $formFields)
	{

        $oUser = new CurrentUser();
		return
        [
            'infosUser' => $oUser->get()
        ];
	}
}