<?php 
	session_start();
	include "libs/ConDB.php";
	include "fb_connect.php";
	include "map/foursquere.php";
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Florence Routes</title>
<link rel="stylesheet" href="style_monumenti.css">


<link rel="stylesheet"
	href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
<link rel="stylesheet" href="style_Lista_elementi.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script
	src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

<script type='text/javascript'
	src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>



<script type='text/javascript'
	src="http://jquery-ui-map.googlecode.com/svn/trunk/ui/jquery.ui.map.js"></script>



<script type='text/javascript'
	src="http://jquery-ui-map.googlecode.com/svn/trunk/ui/jquery.ui.map.services.js"></script>



<script type='text/javascript'
	src="http://jquery-ui-map.googlecode.com/svn/trunk/ui/jquery.ui.map.extensions.js"></script>


  <script src="monument_gallery.js"></script>
   
<script src="main.js"></script>
</head>

<body>

	<div data-role="page">

		<div data-role="header">
			<h1>Florence Routes</h1>
			<?php 
			if(($fb->getUser() == 0) && $_SESSION['Fb_nome']== "")
			{
			 
			
				echo "<a href=\"".$fb->getLoginUrl($params)."\" rel=\"external\" data-inline=\"true\" style=\"width:60px; height: 17px;\"><img src=\"img/fb2.png\" style=\"height: 36px; position:relative;top:-9px;left:-13px;\"><img src=\"img/fb3.png\" style=\"height: 36px; position:relative;top:-9px;left:-13px;\"></a>";
				
				
			/*
				echo "<a  style=\"width:36px; height: 17px;";
				echo "background-image: url('img/FB.png');";   
				echo "background-size: 100% 100%;";
				echo "background-repeat: no-repeat;"; 
				
				echo "\" rel=\"external\" data-inline=\"true\"  href=\"".$fb->getLoginUrl($params)."\"></a>";
				
				*/
			}
			else
			{
				$me = $fb->api('/me');
				$_SESSION['Fb_nome'] = $me['name'];
				$_SESSION['ID'] = $me['id'];
				//echo "<a data-icon=\"fb\" rel=\"external\" href=\"facebook-php-sdk/src/logout.php\">Logout</a>";
				/*echo "<a  style=\"width:17px; height: 17px;";
				echo "background-image: url('https://graph.facebook.com/".$_SESSION['ID']."/picture?width=50&height=50');";
				echo "background-size: 100%;";
				echo "background-repeat: no-repeat;";
				echo "\" rel=\"external\" data-inline=\"true\" href=\"facebook-php-sdk/src/logout.php\"></a>";
			//	echo "<a rel=\"external\" data-inline=\"true\" data-role=\"button\" href=\"facebook-php-sdk/src/logout.php\">Logout</a>";
			
				*/
				
				echo "<a href=\"facebook-php-sdk/src/logout.php\" rel=\"external\" data-inline=\"true\" style=\"width:60px; height: 17px;\"><img src='https://graph.facebook.com/".$_SESSION['ID']."/picture?width=75&height=72' style=\"height: 36px; position:relative;top:-9px;left:-13px;\"><img src=\"img/fb3b.png\" style=\"height: 36px; position:relative;top:-9px;left:-13px;\"></a>";
			
				/* print_r($me);
				echo "</pre>";*/
				//    echo "$user_id is a fan!";
				//"https://graph.facebook.com/".$_SESSION['ID']."/picture?width=29&height=29"
				
			
				
				$friends = $fb->api('/me/likes/?limit=5000');

				$i = 0;
				foreach ($friends["data"] as $value) {
					
				//	echo $value['category'];
					$i++;
					$categorie = AddCategory( $value['category'], $categorie);//$value['category']);
				//	echo"<br>";
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
				$_SESSION['Categorie'] = $categorie;
				Get_Location_By_Like();
				/*print_r($_SESSION['Categorie']);
				echo '<ul>';
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
				//echo '<pre>';
				//print_r($categorie);
				//echo '</pre>';
				}
			?>
			<a class='entry-link' data-inline="true"  rel="external" href="#" data-role="button"  data-icon="check">Route</a>
			</div>
			
			
		<!-- /header -->

		<div role="main" class="ui-content">
			
			
			<ul class="nlist" data-filter="true" data-role="listview"  data-split-theme="a" data-inset="false">
			 <?php 
	        	$result = mysqli_query($con,"SELECT * FROM Monument LIMIT 0 , 22");
	        	$i = 0;
	        	while($row = mysqli_fetch_array($result))
	        	{
	        		echo "<li  data-theme=\"a\"><a href=\"#\" data-itemid=\"".$row['ID']."\" ><label  data-theme=\"a\" style=\"white-space: nowrap !important;\" data-corners=\"false\" >";
	        		echo "<h1  style=\"white-space: normal !important;\" >" . $row['Nome'] . "</h1>";
	        		
	        		echo "<input type=\"checkbox\" onclick=\"myFunction(".$row['ID'].")\" class=\"left\" data-theme=\"a\" value=\"Santa Maria del Fiore\" ><div id=\"image\"> <img src=\"/florenceroutes/". $row['Url_Img'] ."thumb.jpg\" style=\"max-width:200px;max-height:200px; margin:0px 0px 0px 2px; border-radius: 5px 5px 5px 5px;\"/></div>   </label>  </a>";
	        		 
	        		//echo "<input type=\"checkbox\" class=\"inputdimerda\"  data-theme=\"a\" value=\"Santa Maria del Fiore\" ><div id=\"image\"> <img src=\"".$row['Url_Img']."\" style=\"max-width:200px;max-height:200px; margin:0px 0px 0px 2px; border-radius: 5px 5px 5px 5px;\"/></div>   </label>  </a>";
	        		//htmlContent += "<label data-theme=\"a\" data-corners=\"false\" >";
	        			
	        		echo "<a href=\"monument_page.php?id=".$row['ID']."\" data-rel=\"dialog\" data-transition=\"pop\"></a></li>";
	        		
	        	}
	        	?>
			
			</ul>
			
			
			
			
		</div>
		<!-- /content -->
<div data-role="popup"  id="myPopupDiv"><p>They will be added POI selected according to your likes on facebook</p></div>
		<div data-role="footer" data-position="fixed">
			<!-- 
		-->
		<center>
		<?php
		
		if($_SESSION['Fb_nome'] != "") echo "Welcome " . $_SESSION['Fb_nome'];
		//else echo "Connect with Facebook!";
		
		?>	
	
</center>		
		</div>
		<!-- /footer -->
	
	</div>
	<!-- /page -->
	
	
	
	
	
</body>
</html>
