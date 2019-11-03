<?php

class FlashBagFilter extends FlashBag implements InterceptingFilter
{
	public function run(Http $http, array $queryFields, array $formFields)
	{
		return
        [
            'aMessages' => $this->fetchMessages()
        ];
	}
}

