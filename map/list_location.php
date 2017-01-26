<?php
session_start();
include "../libs/ConDB.php";
include "print_lista.php";
//include "Create_Route.php";

if(isset($_SESSION['Monument'])){
	$posi = $_SESSION['Monument'];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Florence Routes</title>
<link rel="stylesheet"
	href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
	<link rel="stylesheet"
	href="stylelist.css">
	<link rel="stylesheet" href="../style_monumenti.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script	src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script	src="../monument_gallery.js"></script>

<script language="javascript" type="text/javascript">


$(document).on("click", ".cliccke", function(){
	var selectId = $(this).data("itemid");
	if($(this).hasClass('ui-btn-active')) 
	{
		$(this).removeClass('ui-btn-active');	 
	 }
	 else 
	 {
		 $(this).addClass('ui-btn-active'); 
	 }
	console.log(selectId);
	$.post('sel_poi.php', 'id=' + selectId, function( data ) {

		 $( "."+selectId).replaceWith(data);
		 
		console.log("." +selectId);
	});
	//console.log(s);

	
});
</script>
</head>


<body>

<div data-role="page">

  <div data-role="header">
    <?php 
        
        if($_SESSION['Fb_nome']== "")
        {/*
        	echo "<a  style=\"width:36px; height: 17px;";
				echo "background-image: url('../img/FB.png');"; 
        	echo "background-size: 100% 100%;";
        	echo "background-repeat: no-repeat;";
        	
        	echo "\" rel=\"external\" data-inline=\"true\"   href=\"../index.php\"></a>";
        	*/
        	echo "<a href=\"../index.php\" rel=\"external\" data-inline=\"true\" style=\"width:60px; height: 17px;\"><img src=\"../img/fb2.png\" style=\"height: 36px; position:relative;top:-9px;left:-13px;\"><img src=\"../img/fb3.png\" style=\"height: 36px; position:relative;top:-9px;left:-13px;\"></a>";
        		
        }
        else 
        {
        	/*
        	echo "<a  style=\"width:17px; height: 17px;";
        	echo "background-image: url('https://graph.facebook.com/".$_SESSION['ID']."/picture?width=50&height=50');";
        	echo "background-size: 100%;";
        	echo "background-repeat: no-repeat;";
        	echo "\" rel=\"external\" data-inline=\"true\" href=\"../facebook-php-sdk/src/logout.php\"></a>";
        	*/
        	echo "<a href=\"../facebook-php-sdk/src/logout.php\" rel=\"external\" data-inline=\"true\" style=\"width:60px; height: 17px;\"><img src='https://graph.facebook.com/".$_SESSION['ID']."/picture?width=75&height=72' style=\"height: 36px; position:relative;top:-9px;left:-13px;\"><img src=\"../img/fb3b.png\" style=\"height: 36px; position:relative;top:-9px;left:-13px;\"></a>";
        		
        }
        ?>
    <h1>Florence Routes</h1>
    
    <a href="../index.php" data-icon="back" rel="external">Home!</a>
  </div>
   <div data-role="navbar">
      <ul>
        <li><a href="Mappa.php" rel="external">Map</a></li>
        <li><a href="#" class="ui-btn-active ui-state-persist">List</a></li>
      </ul>
    </div>
  <div data-role="content">
  <ul data-role="listview" data-inset="true" >
   <li  data-theme="a"><a class="readonly-state-d"><label data-theme="a" data-corners="false" >
    <div class="marker_g_you">
     		<p>A</p>
     </div>
     <h1 class="title" style="float: left;">Your Position</h1>
    </a>
 </label> 
    </li>
   <!--

				<li>
						<div class="marker_g_you">
							<p>A</p>
						</div>
						<h1 class="title" style="float: left;">Your Position</h1>
				<a href="#purchase" data-rel="popup" data-position-to="window"
					data-transition="pop">Purchase album</a>
				</li>

				<!-- 
   
     <li  data-theme="a"><a href="#" data-itemid="1" class="left"><label data-theme="a" data-corners="false" >
    <div class="marker_g">
     		<p>A</p>
     </div>
     <h1 class="title" style="float: left;">Your Position</h1>
   </li> </label>  </a>
     	-->
     <?php
	
     
     
     stampa();
  
     
   ?> 
    
  </ul>
</div>

  <div data-role="footer" data-position="fixed">
			<!-- 
		-->
		<center>
		<?php
		
		if($_SESSION['Fb_nome'] != "") echo "Welcome " . $_SESSION['Fb_nome'];
	//	else echo "Connect with Facebook!";
		
		?>	
	
</center>		
		</div>
		<!-- /footer -->
  
</div>
</body>
</html>