<?php
session_start();
include "Categorie.php";
require_once "facebook.php";

$config = array(
		"appId" => '792370110781395',
		"secret" => '93009b1a0e57d02a2281742368e18676');

$fb = new Facebook($config);


$params = array(
		"redirect_uri" => 'http://localhost/florence_route/facebook-php-sdk/src/',
		"scope" => "email,user_likes");

if($fb->getUser() == 0)
{
	echo '<a href="' . $fb->getLoginUrl($params) . '">Login</a>';
}
else
{
	$me = $fb->api('/me');

	/*echo "<pre>";
	print_r($me);
	echo "</pre>";*/
	//    echo "$user_id is a fan!";

	
	$friends = $fb->api('/me/likes/?limit=5000'); 
	
	$i = 0;
	foreach ($friends["data"] as $value) {
		echo $value['category'];
		$i++;
		$categorie = AddCategory( $value['category'], $categorie);//$value['category']);
		echo"<br>";
		/*echo '<li>';
		echo '<div class="pic">';
		echo '<img src="https://graph.facebook.com/' . $value["id"] . '/picture"/>';
		echo '</div>';
		echo '<div class="picName">'.$value["name"].'</div>';
		echo '<div>'.$value['category'].'</div>';
		echo '<pre>';
		print_r($value['category_list']);
		echo '</pre>';
		echo '</li>';*/
	}
	/*echo '<ul>';
	foreach ($friends["data"] as $value) {
		
		echo '<li>';
		echo '<div class="pic">';
		echo '<img src="https://graph.facebook.com/' . $value["id"] . '/picture"/>';
		echo '</div>';
		echo '<div class="picName">'.$value["name"].'</div>';
		echo '<div>'.$value['category'].'</div>';
		echo '<pre>';
		print_r($value['category_list']);
		echo '</pre>';
		echo '</li>';
	}
	echo '</ul>';*/
	echo '<pre>';
	print_r($categorie);
	echo '</pre>';
	$tot = 0;
	foreach ($categorie as $val)
		$tot = $tot + $val;
	echo "<br>".$i."<br>";
	echo "<br>".$tot."<br>";
	echo "<br><a href = 'logout.php'>Logout</a>";
}
//session_destroy();
?>


