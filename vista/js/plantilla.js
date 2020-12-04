/*=============================================
PLANTILLA
=============================================*/

$.ajax({

	url:"ajax/plantilla.ajax.php",
	success:function(respuesta){

		//console.log(JSON.parse(respuesta));

		var colorFondo = JSON.parse(respuesta).colorFondo;
		var colorTexto = JSON.parse(respuesta).colorTexto;
		var barraSuperior = JSON.parse(respuesta).barraSuperior;
		var textoSuperior = JSON.parse(respuesta).textoSuperior;

		//APLICANDO ESTILOS ATRAVEZ DE AJAX A LAS CLASES DESDE LA BASE DE DATOS.
		
		$(".backColor, .backColor a").css({"background": colorFondo,
											"color": colorTexto})

		$(".barraSuperior, .barraSuperior a").css({"background": barraSuperior, 
			                                       "color": textoSuperior})

	}


})