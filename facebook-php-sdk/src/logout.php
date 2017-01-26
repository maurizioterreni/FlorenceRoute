<?php 

require 'facebook.php';

$facebook = new Facebook(array (
		'appId' => '792370110781395',
		'secret' => '93009b1a0e57d02a2281742368e18676'
));

$facebook->destroySession();
session_destroy();

header('Location: ../../index.php');

?>