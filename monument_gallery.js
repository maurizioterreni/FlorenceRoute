var i = 0;
var change = true;

/*
window.setInterval(function(){
	
	if(change == true)
	{
		$(".immagine"+i).hide(1000);
		$(".immagine"+((i + 2) % 3)).hide();
		$(".immagine"+((i + 1) % 3)).show(1000);

		$(".n_photo"+i).css("text-decoration", "none");
		$(".n_photo"+((i + 2) % 3)).css("text-decoration", "none");
		$(".n_photo"+((i + 1) % 3)).css("text-decoration", "underline");

		i = ((i + 1) % 3);
		
	}
	else change = true;
}, 10000);*/

$(document).on("click", ".immagine0", function(){
	console.log(i);
	change = false;
	$(".immagine"+i).hide(1000);
	$(".n_photo"+i).css("text-decoration", "none");
	
	i = ((i + 1) % 3);
	
	$(".immagine"+((i + 1) % 3)).hide();
	$(".n_photo"+((i + 1) % 3)).css("text-decoration", "none");

	
	$(".immagine"+i).show(1000);
	$(".n_photo"+i).css("text-decoration", "underline");
	
	//i = ((i + 1) % 3);
	
	console.log(i);
});



$(document).on("click", ".immagine1", function(){
	console.log(i);
	change = false;
	$(".immagine"+i).hide(1000);
	$(".n_photo"+i).css("text-decoration", "none");
	i = ((i + 1) % 3);
	$(".immagine"+((i + 1) % 3)).hide();
	$(".n_photo"+((i + 1) % 3)).css("text-decoration", "none");
	
	//i = 1;
	
	$(".immagine"+i).show(1000);
	$(".n_photo"+i).css("text-decoration", "underline");
	
	//i = ((i + 1) % 3);
	
	console.log(i);
});


$(document).on("click", ".immagine2", function(){
	console.log(i);
	change = false;
	$(".immagine"+i).hide(1000);
	$(".n_photo"+i).css("text-decoration", "none");
	i = ((i + 1) % 3);
	$(".immagine"+((i + 1) % 3)).hide();
	$(".n_photo"+((i + 1) % 3)).css("text-decoration", "none");
	
//	i = 2;
	
	$(".immagine"+i).show(1000);
	$(".n_photo"+i).css("text-decoration", "underline");
	
	//i = ((i + 1) % 3);
	
	console.log(i);
});










$(document).on("click", ".n_photo0", function(){
	console.log(i);
	change = false;
	$(".immagine"+i).hide(1000);
	$(".n_photo"+i).css("text-decoration", "none");
	
	$(".immagine"+((i + 1) % 3)).hide();
	$(".n_photo"+((i + 1) % 3)).css("text-decoration", "none");
	i = 0;
	
	$(".immagine"+i).show(1000);
	$(".n_photo"+i).css("text-decoration", "underline");
	
	//i = ((i + 1) % 3);
	
	console.log(i);
});



$(document).on("click", ".n_photo1", function(){
	console.log(i);
	change = false;
	$(".immagine"+i).hide(1000);
	$(".n_photo"+i).css("text-decoration", "none");
	
	$(".immagine"+((i + 1) % 3)).hide();
	$(".n_photo"+((i + 1) % 3)).css("text-decoration", "none");
	
	i = 1;
	
	$(".immagine"+i).show(1000);
	$(".n_photo"+i).css("text-decoration", "underline");
	
	//i = ((i + 1) % 3);
	
	console.log(i);
});


$(document).on("click", ".n_photo2", function(){
	console.log(i);
	change = false;
	$(".immagine"+i).hide(1000);
	$(".n_photo"+i).css("text-decoration", "none");
	
	$(".immagine"+((i + 1) % 3)).hide();
	$(".n_photo"+((i + 1) % 3)).css("text-decoration", "none");
	
	i = 2;
	
	$(".immagine"+i).show(1000);
	$(".n_photo"+i).css("text-decoration", "underline");
	
	//i = ((i + 1) % 3);
	
	console.log(i);
});




$( document ).on( "pageinit", function() {
    $( "#popupMap iframe" )
        .attr( "width", 0 )
        .attr( "height", 0 );
		  
    $( "#popupMap iframe" ).contents().find( "#map_canvas" )
        .css( { "width" : 0, "height" : 0 } );
	 	     
    $( "#popupMap" ).on({
        popupbeforeposition: function() {
            var size = scale( 480, 320, 0, 1 ),
                w = size.width,
                h = size.height;

            $( "#popupMap iframe" )
                .attr( "width", w )
                .attr( "height", h );
					 
            $( "#popupMap iframe" ).contents().find( "#map_canvas" )
                .css( { "width": w, "height" : h } );
        },
        popupafterclose: function() {
            $( "#popupMap iframe" )
                .attr( "width", 0 )
                .attr( "height", 0 );
					 
            $( "#popupMap iframe" ).contents().find( "#map_canvas" )
                .css( { "width": 0, "height" : 0 } );
        }
    });
});