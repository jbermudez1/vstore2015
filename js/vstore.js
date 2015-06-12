$( document ).ready(function() {
$('.bar').load('menu_superior.html');
$('footer').load('footer_vstore.html');

mostrarBanner(dos);
});

// function arrancaBanners (){
// 	$('.banner').css("display", "visible")
// }

var uno = function (){
	$('.banner3').fadeOut( function(){
		$('.banner').fadeIn();
	});
	mostrarBanner(dos);
}


var dos = function(){
	$('.banner').fadeOut( function(){
		$('.banner2').fadeIn();
	});
	mostrarBanner(tres);

}

var tres = function(){
	$('.banner2').fadeOut( function(){
		$('.banner3').fadeIn();
	});
	mostrarBanner(uno);
}

function mostrarBanner ( amostrar ){
 	setTimeout(function() {
 		console.log(amostrar)
  		amostrar();
 	}, 5000);
}