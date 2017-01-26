var Monument_Route = [];
$(document).bind("pageinit", '.ui-content',function(){

	
	var items;
	//var Monument_Route = [];
	$.ajax({
		url:"./libs/RssMonument.php",
		method:"GET",
		dataType:"xml",
		success : function(data){
			console.log("Success: " + data);
		
			items = $(data).find("Monument");
			var htmlContent = "";
			for(var i = 0; i < $(items).length; i++){
			/*	var id = $(items[i]).find("ID").text();
				var title = $(items[i]).find("NAME").text();
				var img = $(items[i]).find("IMG").text();
				var text = $(items[i]).find("TEXT").text();
				var tel = $(items[i]).find("TEL").text();
				var prezzo = $(items[i]).find("PREZZO").text();
				var orario = $(items[i]).find("ORARIO").text();
				var web = $(items[i]).find("WEB_SITE").text();
				
				
				/*
				htmlContent += "<li  data-theme=\"a\"><a href=\"#\" ><label data-theme=\"a\" data-corners=\"false\" >";
				htmlContent += "<h1>" + title + "</h1>";
				htmlContent += "<input type=\"checkbox\" class=\"inputdimerda\"  data-theme=\"a\" value=\"Santa Maria del Fiore\" ><div id=\"image\"> <img src=\"http://trinity.micc.unifi.it/florenceroutes/upload/thumb_Santa_Maria_del_Fiore.jpg\" style=\"max-width:200px;max-height:200px; margin:0px 0px 0px 2px; border-radius: 5px 5px 5px 5px;\"/></div>   </label>  </a>";
				//htmlContent += "<label data-theme=\"a\" data-corners=\"false\" >";
			
				htmlContent += "<a href=\"monument_page.php?id="+id+"\" data-rel=\"dialog\" data-transition=\"pop\"></a></li>";
				
		//		htmlContent += "<p>Time: "+ orario +" | Price: "+prezzo+" | Phone: "+tel+"<br>"+text+"<br>Web Site: "+web+"</p>";
		//		htmlContent += "</div><div class='c_right'>";
		//		htmlContent += "<a href=\"monument_page.php?id="+id+"\" data-rel=\"dialog\" data-transition=\"pop\"><img src='"+img+"'></a>";
		//		htmlContent += "</label></li>";
		*/
				Monument_Route.push( 0 );
		//		console.log(htmlContent);
				
			}
		//	$(".nlist").html(htmlContent);
		//	$(".nlist").listview('refresh');

		},
		error:  function(err){
			console.log("Error: " + err);
		}
	});
	
	   if (navigator.geolocation) {
		   navigator.geolocation.getCurrentPosition(success);
		 } 
	   else {
		   error('Geo Location is not supported');
		 }
	
	/*$(document).on("click", ".entry-link", function(){
		$.mobile.changePage( "map/Map.php", { transition: "slideup", changeHash: false });
	});*/
	/*$(".c_left").click(function(){
		var selectId = $(this).data("itemid");
		console.log(selectId);
		if($(".c_left").css("background-color") == "rgb(255, 255, 255)"){
			$(".c_left").css("background-color","#E6E6E6");
		}
		else $(".c_left").css("background-color","white");
	  });
	*/

	$(document).on("click", ".left", function(){
		var selectId = $(this).data("itemid");
		console.log(selectId);
		if(Monument_Route[selectId-1] == 0) Monument_Route[selectId-1] = 1;
		else Monument_Route[selectId-1] = 0;
		var lista = "";
		for ( var i = 0; i < Monument_Route.length; i = i + 1 ) {
			 
		    lista += "id[]=" + Monument_Route[i] + "&";
		 
		}
		lista += "id[]=-1";
		console.log(lista);
		$(".entry-link").attr("href", "go_to_map.php?"+lista);
	});
});
$(document).on("click", ".facebook_login", function(){
	
	var str = $(".facebook_login").text();
	if(str == "Login"){
		$(".facebook_login").html("Logout");
		alert("Login");
	}
	else{
		$(".facebook_login").html("Login");
		alert("Logout");
	}
});

function myFunction(selectId) 
{
	
	console.log(selectId);
	if(Monument_Route[selectId-1] == 0) Monument_Route[selectId-1] = 1;
	else Monument_Route[selectId-1] = 0;
	var lista = "";
	for ( var i = 0; i < Monument_Route.length; i = i + 1 ) {
		 
	    lista += "id[]=" + Monument_Route[i] + "&";
	 
	}
	lista += "id[]=-1";
	console.log(lista);
	$(".entry-link").attr("href", "go_to_map.php?"+lista);
}





function success(position)
{
	directionsDisplay = new google.maps.DirectionsRenderer();

	$.post('map/location.php', 'lat=' + position.coords.latitude + '&lon='+ position.coords.longitude);
	console.log(position.coords.latitude );
	console.log("here");
}
