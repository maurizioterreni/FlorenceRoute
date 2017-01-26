<?php
	session_start();
	include "Create_Route.php";
	//$posi = $_GET['id'];
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Florence Routes</title>
<link rel="stylesheet"
	href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">

<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script	src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
  <link rel="stylesheet" href="../style_monumenti.css">
    <script	src="../monument_gallery.js"></script>
	<link rel="stylesheet"
	href="stylelist.css">
	
	<style type='text/css'>
    #content {
    padding: 0;
    position : absolute !important; 
    top : 80px !important;  
    right : 0; 
    bottom : 0px !important;  
    left : 0 !important;     
}
.legenda{
	position: absolute;
	background-color: #636363;
	background-image: url('img/legend.jpg');
	height: 50px;
	width: 70px;
	bottom: 0px;
	left: 0px;
}
  </style>
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

  <div data-role="page" id="index">
        <div data-theme="a" data-role="header">
        <?php 
        
        if($_SESSION['Fb_nome']== "")
        {
        	
        	/*
        	echo "<a  style=\"width:36px; height: 17px;";
				echo "background-image: url('../img/FB.png');"; 
        	echo "background-size: 100% 100%;";
        	echo "background-repeat: no-repeat;";
        	
        	echo "\" rel=\"external\" data-inline=\"true\"  href=\"../index.php\"></a>";
        	
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
        	*/echo "<a href=\"../facebook-php-sdk/src/logout.php\" rel=\"external\" data-inline=\"true\" style=\"width:60px; height: 17px;\"><img src='https://graph.facebook.com/".$_SESSION['ID']."/picture?width=75&height=72' style=\"height: 36px; position:relative;top:-9px;left:-13px;\"><img src=\"../img/fb3b.png\" style=\"height: 36px; position:relative;top:-9px;left:-13px;\"></a>";
			
        }
        ?>
        	<a href="../index.php" data-icon="back" rel="external">Home!</a>
            <h3>
            	Florence Routes
             
            </h3>
        </div>
 <div data-role="navbar">
      <ul>
        <li><a href="#" class="ui-btn-active ui-state-persist">Map</a></li>
        <li><a href="list_location.php" >List</a></li>
      </ul>
    </div>
        <div data-role="content" id="content">
            
        
        <iframe id="external" src="map2.php" width="100%" height="100%" style="background:#FFF; overflow:hidden;"></iframe>
	 
        
        
        
        </div>

        <div data-role="footer" data-position="fixed">
	</div><!-- /footer -->
    </div>

</body>
</html>    
  
</body>


</html>


