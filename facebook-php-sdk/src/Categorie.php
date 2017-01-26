<?php


$categorie = array(

		"Ristorante" => 0,
		"Intrattenimento" => 0,
		"Locali" => 0,
		"Sport" => 0,
		"Musica" => 0,
		"Film" => 0,
		"Healt" => 0,
		"Tecnoligia" => 0,
		"Giochi" => 0,
		"Shopping" => 0,
		"Altri" => 0
);
function AddCategory($str, $categorie)
{
	if(stristr($str, "Entertainer") || stristr($str,"entertainment")) $categorie['Intrattenimento']++;
	if(stristr($str,"nightlife") || stristr($str,"beverages")) $categorie['Locali']++;
	if(stristr($str, "Arts") || stristr($str, "Clothing")) $categorie['Shopping']++;
	if(stristr($str, "Restaurant") || stristr($str, "Food")) $categorie['Ristorante']++;
	if(stristr($str,"cafe") || stristr($str, "Bar")) $categorie['Locali']++;
	if(stristr($str,"Appliances")) $categorie['Healt']++;
	if(stristr($str,"Athlete") || stristr($str, "Amateur sports team") || stristr($str, "Sports event")) $categorie['Sport']++;
	if(stristr($str, "Software") || stristr($str, "Website") || stristr($str, "App page") || stristr($str, "Computers"))  $categorie['Tecnoligia']++;
	if(stristr($str, "Tv show") || stristr($str, "Movie") || stristr($str, "Actor")) $categorie['Film']++;
	if(stristr($str, "club") || stristr($str, "band") || stristr($str, "Musician"))  $categorie['Musica']++;
	if(stristr($str, "toys") || stristr($str, "Games"))  $categorie['Giochi']++;

	
	//else $categorie['Altri']++;
	return $categorie;
	
}

?>