<?php
class DebugException extends Exception {}


try
{
	$sEmail = 'toto@yopmail.com';
    
    if (filter_var($sEmail , FILTER_VALIDATE_EMAIL)) {
    	
        echo 'c\'est cool';
        var_dump($sEmail);
    
    } else {
    	throw new DebugException('Non mais sérieux c\'est pas un email '.$sEmail);
    }

}
catch(DebugException $e)
{
	include 'UserModel.class.php';
}