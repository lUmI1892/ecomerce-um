/*=============================================
VARIABLES
=============================================*/

var item = 0;

var itemPaguinacion = $("#paguinacion li");

var interrupirCiclo = false;

var imgProducto = $(".imgProducto");

var titulos1 = $("#slide h1");

var titulos2 = $("#slide h2");

var titulos3 = $("#slide h3");

var btnVerProducto = $("#slide button");

var detenerIntervalo = false;

var toogle = false;

$("#slide ul li").css({"width":100/$("#slide ul li").length + "%"})

$("#slide ul").css({"width":$("#slide ul li").length*100+"%"})


/*=============================================
ANIMACION INICIAL
=============================================*/
$(imgProducto[item]).animate({"top":-10+"%","opacity":0},100);
$(imgProducto[item]).animate({"top":30+"px","opacity":1},600);

$(titulos1[item]).animate({"top":-10+"%","opacity":0},100);
$(titulos1[item]).animate({"top":30+"px","opacity":1},600);

$(titulos2[item]).animate({"top":-10+"%","opacity":0},100);
$(titulos2[item]).animate({"top":30+"px","opacity":1},600);

$(titulos3[item]).animate({"top":-10+"%","opacity":0},100);
$(titulos3[item]).animate({"top":30+"px","opacity":1},600);

$(btnVerProducto[item]).animate({"top":-10+"%","opacity":0},100);
$(btnVerProducto[item]).animate({"top":30+"px","opacity":1},600);

/*=============================================
PAGUINACION
=============================================*/
$("#paguinacion li").click(function() {

	item = $(this).attr("item")-1;
	//console.log(item);

	movimientoSlide(item);
	
});

/*=============================================
AVANZAR
=============================================**/

function avanzar(){
	if (item == $("#slide ul li").length -1) {

		item = 0;
	}else{

		item++;
	}
	movimientoSlide(item);
}

$("#slide #avanzar").click(function(event) {
	
	avanzar();
});

/*=============================================
RETOCEDER
=============================================**/

$("#slide #retroceder").click(function(event) {
	
	if (item == 0) {

		item = $("#slide ul li").length -1;
	}else{

		item--;
	}
	movimientoSlide(item);
});

/*=============================================
MOVIMIENTO SLIDE
=============================================*/
function movimientoSlide(item){

	$("#slide ul").animate({"left":item * -100+"%"},1000);

	$("#paguinacion li").css({"opacity":.5});
	//console.log(itemPaguinacion);

	$(itemPaguinacion[item]).css({"opacity":1});

	interrupirCiclo = true;

	$(imgProducto[item]).animate({"top":-10+"%","opacity":0},100);
	$(imgProducto[item]).animate({"top":30+"px","opacity":1},600);

	$(titulos1[item]).animate({"top":-10+"%","opacity":0},100);
	$(titulos1[item]).animate({"top":30+"px","opacity":1},600);

	$(titulos2[item]).animate({"top":-10+"%","opacity":0},100);
	$(titulos2[item]).animate({"top":30+"px","opacity":1},600);

	$(titulos3[item]).animate({"top":-10+"%","opacity":0},100);
	$(titulos3[item]).animate({"top":30+"px","opacity":1},600);

	$(btnVerProducto[item]).animate({"top":-10+"%","opacity":0},100);
	$(btnVerProducto[item]).animate({"top":30+"px","opacity":1},600);

}

/*=============================================
INTERVALO
=============================================*/

setInterval(function(){

	if (interrupirCiclo) {

		interrupirCiclo = false;
	}else{

		if (!detenerIntervalo) {
			avanzar();
		}
		
	}

},3000)

/*=============================================
APARECER FLECHAS
=============================================*/

$("#slide").mouseover(function(){
	$("#slide #retroceder").css({"opacity":1});
	$("#slide #avanzar").css({"opacity":1});

	detenerIntervalo = true;
	//console.log(detenerIntervalo);
})

$("#slide").mouseout(function(){
	$("#slide #retroceder").css({"opacity":0});
	$("#slide #avanzar").css({"opacity":0});

	detenerIntervalo = false;
	//console.log(detenerIntervalo);
})

/*=============================================
ESCONDER SLIDE
=============================================*/

$("#btnSlide").click(function(){

	if (!toogle) {
		toogle = true;

		$("#slide").slideUp("fast");

		$("#btnSlide").html('<i class="fa fa-angle-down"></i>');

	}else{

		toogle = false;
		$("#slide").slideDown("fast");

		$("#btnSlide").html('<i class="fa fa-angle-up"></i>');

	}
	
})