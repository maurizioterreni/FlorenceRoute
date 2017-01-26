<?php
include "facebook-php-sdk/src/Categorie.php";
require_once "facebook-php-sdk/src/facebook.php";

$config = array(
		"appId" => '792370110781395',
		"secret" => '93009b1a0e57d02a2281742368e18676');

$fb = new Facebook($config);


$params = array(
		"redirect_uri" => Fb_redirect,
		"scope" => "email,user_likes");


?>


