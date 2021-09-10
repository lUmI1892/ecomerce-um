/*=============================================
TOOL TIP
=============================================*/
$('[data-toggle="tooltip"]').tooltip(); 

/*=============================================
PLANTILLA
=============================================*/

var rutaOculta = $("#rutaOculta").val();

$.ajax({

	url:rutaOculta+"ajax/plantilla.ajax.php",
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

/*=============================================
CUADRICULA O LISTA
=============================================*/

var btnList = $(".btnList");

for(var i = 0; i<btnList.length;i++){

	$("#btnGrid"+i).click(function() {

		var numero = $(this).attr("id").substr(-1);

		$(".list"+numero).hide();

		$(".grid"+numero).show();

		$("#btnGrid"+numero).addClass('backColor');
		$("#btnList"+numero).removeClass('backColor');		

	});

	$("#btnList"+i).click(function() {

		var numero = $(this).attr("id").substr(-1);

		$(".list"+numero).show();

		$(".grid"+numero).hide();

		$("#btnGrid"+numero).removeClass('backColor');
		$("#btnList"+numero).addClass('backColor');	

	});

}	

/*=============================================
EFECTO CON EL SCROLL
=============================================*/

$(window).scroll(function(event) {
	var scrollY = window.pageYOffset;

	if (window.matchMedia("(min-width:768px)").matches) {

		if ($(".banner").html() !=null) {

			if (scrollY < ($(".banner").offset().top)-200) {
				console.log("es menor");
				$(".banner img").css({"margin-top":-scrollY/2+"px"})
			}else{
				scrollY = 0;
			}
			
		}

		
	}

	
});


$.scrollUp({

	scrollText:"",
	scrollSpeed:1500
	//easingType: "easyOutQuint"
});

/*=============================================
MIGAS DE PAN
=============================================*/
var pagActiva = $(".pagActiva").html();

if(pagActiva != null){

	//la G es para q reemplaze todos los giones sin la G solo reeemplazaria el primero
	var regPagActiva = pagActiva.replace(/-/g, " ");
	$(".pagActiva").html(regPagActiva);

}

/*=============================================
ENLACES PAGUINACION
=============================================*/

var url = window.location.href;

var indice = url.split("/");



$("#item"+indice.pop()).addClass('active');









