
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR CESTA
=============================================*/

if (localStorage.getItem("cantidadCesta") != null) {

	$(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));

	$(".sumaCesta").html(localStorage.getItem("sumaCesta"));
	
}else{

	$(".cantidadCesta").html("0");
	$(".sumaCesta").html("0");

}




/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR LOS PRODUCTOS EN LA PAGUINA DE COMPRAS
=============================================*/


if (localStorage.getItem("listaProductos") != null) {

	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

	listaCarrito.forEach(funcionForEach);

	function funcionForEach(item, index){
		
		$(".cuerpoCarrito").append(

				'<div class="row itemCarrito">'+
							
				'<div class="col-sm-1 col-xs-12">'+
					
					'<br>'+
					'<center>'+
						
						'<button class="btn btn-default backColor quitarItemCarrito" idProducto="'+item.idProducto+'" tipo="'+item.tipo+'" peso="'+item.peso+'"><i class="fa fa-times"></i></button>'+

					'</center>'+

				'</div>'+

				'<div class="col-sm-1 col-xs-12">'+
					
					'<figure >'+
						'<img src="'+item.imagen+'" class="img-thumbnail">'+
					'</figure>'+

				'</div>'+

				'<div class="col-sm-4 col-xs-12">'+
					
					'<br>'+

					'<p class="tituloCarritoCompra text-left">'+item.titulo+'</p>'+

				'</div>'+

				'<div class="col-md-2 col-sm-3 col-xs-8">'+
					
					'<br>'+

					'<p class="precioCarritoCompra text-center">USD $<span>'+item.precio+'</span></p>'+

				'</div>'+

				'<div class="col-md-2 col-sm-3 col-xs-8">'+

					'<br>'+
						
						'<div class="col-xs-8">'+

							'<center>'+
						
								'<input type="number" name="" class="form-control text-center cantidadItem" min="1" value="'+item.cantidad+'" tipo="'+item.tipo+'" precio="'+item.precio+'" idProducto="'+item.idProducto+'">'+

							'</center>'+	

						'</div>'+	

				'</div>'+

				'<div class="col-md-2 col-sm-3 col-xs-8">'+
					
					'<br>'+

					'<p class="subTotal'+item.idProducto+'" id="subTotales">'+

						'<strong>USD $<span>'+item.precio+'</span></strong>'+

					'</p>'+

				'</div>'+

			'</div>'+
			'<div class="clearfix"></div>'+
			'<hr>');

		/*=============================================
		EVITAR MANIPULAR LA CANTIDAD EN PRODUCTOS VIRTUALES
		=============================================*/
		$(".cantidadItem[tipo='virtual']").attr("readonly","true");

	}
}else{

	$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
	$(".sumaCarrito").hide();
	$(".cabezeraCheckout").hide();

}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
AGREGAR AL CARRITO
=============================================*/

$(".agregarCarrito").click(function(){

	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var precio = $(this).attr("precio");
	var titulo = $(this).attr("titulo");
	var tipo = $(this).attr("tipo");
	var peso = $(this).attr("peso");

	var agregarAlCarrito = false;

	/*=============================================
	CAPTURAR DETALLE
	=============================================*/

	if (tipo == "virtual") {

		agregarAlCarrito = true;

	}else{

		var seleccionarDetalle = $(".seleccionarDetalle");

		for(i=0;i<seleccionarDetalle.length;i++){

			if ($(seleccionarDetalle[i]).val() == "") {

				swal({

					title:"¡Debe seleccionar Talla y Color!",
					text:"",
					type:"warning",
					showCancelButton:false,
					confirmButtonColor:"#DD6B55",
					confirmButtonText:"Seleccionar",
					closeOnConfirm:false

				});

				return;
			}else{

				titulo = titulo + "-" + $(seleccionarDetalle[i]).val();

				agregarAlCarrito = true;

			}

		}

	}

	/*=============================================
	ALMACENAR EN EL LOCALSTOREGE LOS PRODUCTOS AGREGADOS AL CARRITO
	=============================================*/

	if (agregarAlCarrito) {

		/*=============================================
		RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE
		=============================================*/

		if (localStorage.getItem("listaProductos") == null) {

			listaCarrito = [];
		}else{

			listaCarrito.concat(localStorage.getItem("listaProductos"));
		}

		listaCarrito.push({"idProducto":idProducto,
					"imagen":imagen,
					"titulo":titulo,
					"precio":precio,
					"tipo":tipo,
					"peso":peso,
					"cantidad":"1"});

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

		/*=============================================
		ACTUALIZAR CESTA
		=============================================*/

		var cantidadCesta = Number($(".cantidadCesta").html())+1;

		var sumaCesta = Number($(".sumaCesta").html())+Number(precio);

		$(".cantidadCesta").html(cantidadCesta);
		$(".sumaCesta").html(sumaCesta);

		localStorage.setItem("cantidadCesta",cantidadCesta);
		localStorage.setItem("sumaCesta",sumaCesta);



		/*=============================================
		MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO
		=============================================*/

		swal({

			title:"",
			text:"!Se ha agregado un nuevo producto al carrito de compras¡",
			type:"success",
			showCancelButton:true,
			confirmButtonColor:"#DD6B55",
			cancelButtonText:"¡Continuar comprando!",
			confirmButtonText:"¡Ir a mi carrito de compras!",
			closeOnConfirm:false
		},
		function(isConfirm){

			if (isConfirm) {
				window.location = rutaOculta+"carrito-de-compras";
			}

		});

	}

})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
QUITAR PRODUCTOS DEL CARRITO
=============================================*/

$(".quitarItemCarrito").click(function(){

	$(this).parent().parent().parent().remove();

	var idProducto = $(".cuerpoCarrito button");

	var imagen = $(".cuerpoCarrito img");

	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");

	var precio = $(".cuerpoCarrito .precioCarritoCompra span");

	var cantidad = $(".cuerpoCarrito .cantidadItem");

	/*=============================================
	SI AUN QUEDAN PRODUCTOS VOLVEMOS A AGREGAR AL CARRITO (LOCALSTORAGE)
	=============================================*/

	listaCarrito = [];

	if (idProducto.length != 0) {

		for(var i = 0; i<idProducto.length;i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var tipoArray = $(cantidad[i]).attr("tipo");
			var pesoArray = $(idProducto[i]).attr("peso");
			var cantidadArray = $(cantidad[i]).val();

			listaCarrito.push({"idProducto":idProductoArray,
					"imagen":imagenArray,
					"titulo":tituloArray,
					"precio":precioArray,
					"tipo":tipoArray,
					"peso":pesoArray,
					"cantidad":cantidadArray});

		}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));
		
	}else{

		/*=============================================
		SI NO QUEDAN PRODUCTOS REMOVER TODO
		=============================================*/

		localStorage.removeItem("listaProductos");

		localStorage.setItem("cantidadCesta","0");
		localStorage.setItem("sumaCesta","0");

		$(".cantidadCesta").html("0");
		$(".sumaCesta").html("0");

		$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
		$(".sumaCarrito").hide();
		$(".cabezeraCheckout").hide();

	}

	sumaSubTotales();
	cestaCarrito(listaCarrito.length);


});

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD
=============================================*/

$(".cantidadItem").change(function(){

	var cantidad = $(this).val();

	var precio =$(this).attr("precio");

	var idProducto = $(this).attr("idProducto");
	
	$(".subTotal"+idProducto).html('<strong>USD $<span>'+(cantidad*precio)+'</span></strong>');

	/*=============================================
	ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE
	=============================================*/

	var idProducto = $(".cuerpoCarrito button");

	var imagen = $(".cuerpoCarrito img");

	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");

	var precio = $(".cuerpoCarrito .precioCarritoCompra span");

	var cantidad = $(".cuerpoCarrito .cantidadItem");

	listaCarrito = [];

	for(var i = 0; i<idProducto.length;i++){

		var idProductoArray = $(idProducto[i]).attr("idProducto");
		var imagenArray = $(imagen[i]).attr("src");
		var tituloArray = $(titulo[i]).html();
		var precioArray = $(precio[i]).html();
		var tipoArray = $(cantidad[i]).attr("tipo");
		var pesoArray = $(idProducto[i]).attr("peso");
		var cantidadArray = $(cantidad[i]).val();

		listaCarrito.push({"idProducto":idProductoArray,
				"imagen":imagenArray,
				"titulo":tituloArray,
				"precio":precioArray,
				"tipo":tipoArray,
				"peso":pesoArray,
				"cantidad":cantidadArray});

	}

	localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

	sumaSubTotales();
	cestaCarrito(listaCarrito.length);

});

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
ACTUALIZAR SUBTOTAL
=============================================*/

var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");
var cantidadItem = $(".cuerpoCarrito .cantidadItem");

for(var i=0; i<precioCarritoCompra.length;i++){

	var precioCarritoArray = $(precioCarritoCompra[i]).html();
	var cantidadItemArray = $(cantidadItem[i]).val();
	var idProductoArray = $(cantidadItem[i]).attr("idProducto");

	$(".subTotal"+idProductoArray).html('<strong>USD $<span>'+(precioCarritoArray*cantidadItemArray)+'</span></strong>');

	sumaSubTotales();

	cestaCarrito(precioCarritoCompra.length);

}


/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
SUMA DE TODO LOS SUBTOTALES
=============================================*/

function sumaSubTotales(){

	var subTotales = $("#subTotales span");

	var arraySumaSubTotales=[];

	for(var i=0;i<subTotales.length;i++){

		var subTotalesArray = $(subTotales[i]).html();

		arraySumaSubTotales.push(Number(subTotalesArray));	

	}

	function sumaArraySubtotales(total,numero){

		return total+numero;
	}

	var sumaTotal = arraySumaSubTotales.reduce(sumaArraySubtotales);

	$(".sumaSubTotal span").html(sumaTotal);

	$(".sumaCesta").html(sumaTotal);

	localStorage.setItem("sumaCesta",sumaTotal);

}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
ACTUALIZAR CESTA AL CAMBIAR CANTIDAD
=============================================*/
function cestaCarrito(cantidadProductos){

	/*=============================================
	SI HAY PRODUCTOS EN EL CARRITO
	=============================================*/
	if (cantidadProductos != 0) {
		
		var cantidadItem = $(".cuerpoCarrito .cantidadItem");

		var arraySumaCantidades = [];

		for(var i=0;i<cantidadItem.length;i++){

			var cantidadItemArray = $(cantidadItem[i]).val();

			arraySumaCantidades.push(Number(cantidadItemArray));

		}

		function sumaArrayCantidades(total,numero){

			return total+numero;
		}

		var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);

		$(".cantidadCesta").html(sumaTotalCantidades);

		localStorage.setItem("cantidadCesta",sumaTotalCantidades);

	}

}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
CHECKOUT
=============================================*/

$(".btnCheckout").click(function(){

	$(".listaProductos table.tablaProductos tbody").html("");
	$("#seleccionarPais").html("");

	var idUsuario = $(this).attr("idUsuario");

	var peso = $(".cuerpoCarrito button");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var cantidad = $(".cuerpoCarrito .cantidadItem");
	var subTotal = $(".cuerpoCarrito #subTotales span");

	var tipoArray = [];
	var cantidadPeso = [];

	/*=============================================
	SUMA SUBTOTAL
	=============================================*/

	var sumaSubTotal = $(".sumaSubTotal span").html();

	$(".valorSubTotal").html(sumaSubTotal);

	$(".valorSubTotal").attr("valor",sumaSubTotal);

	/*=============================================
	TASA IMPUESTOS
	=============================================*/

	var impuestoTotal = (sumaSubTotal * $("#tasaImpuesto").val()) / 100;

	$(".valorTotalImpuesto").html(impuestoTotal.toFixed(2));

	$(".valorTotalImpuesto").attr("valor",impuestoTotal.toFixed(2));

	sumaTotalCompra();

	/*=============================================
	VARIABLES ARRAY
	=============================================*/

	for(var i=0;i<titulo.length;i++){

		var pesoArray = $(peso[i]).attr("peso");
		var tituloArray = $(titulo[i]).html();
		var cantidadArray = $(cantidad[i]).val();
		var subTotalArray = $(subTotal[i]).html();

		
		/*=============================================
		EVALUAR EL PESO DE ACUERDO A LA CANTIDAD DDE PRODUCTOS
		=============================================*/

		cantidadPeso[i] = pesoArray * cantidadArray;

		function sumaArrayPeso(total,numero){
			return total+numero;
		}

		var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso);


		/*=============================================
		MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR
		=============================================*/

		$(".listaProductos table.tablaProductos tbody").append('<tr>'+
																'<td>'+tituloArray+'</td>'+
																'<td>'+cantidadArray+'</td>'+
																'<td>$<span class="valorItem" valor="'+subTotalArray+'">'+subTotalArray+'</span></td>'+
																'</tr>');

		/*=============================================
		SELECIONAR PAIS DE ENVIO SI HAY PRODUCTOS FISICOS
		=============================================*/	

		tipoArray.push($(cantidad[i]).attr("tipo"));

	}

	function checkTipo(tipo){
		return tipo == "fisico";
	}

	/*=============================================
	EXITEN PRODUCTOS FISICOS
	=============================================*/	

	if(tipoArray.find(checkTipo) == "fisico"){

		$(".formEnvio").show();

		$(".btnPagar").attr("tipo","fisico");

		$.ajax({

			url:rutaOculta+"vista/js/plugins/countries.json",
			type:"GET",
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(respuesta){

				respuesta.forEach(seleccionarPais);

				function seleccionarPais(item,index){
					var pais = item.name;
					var codigo = item.code;

					$("#seleccionarPais").append('<option value="'+codigo+'">'+pais+'</option>');
				}

			}

		});

		/*=============================================
		EVALUAR TASAS DE ENVIO SI EL PRODUCTO ES FISICO
		=============================================*/

		$("#seleccionarPais").change(function(){

			$(".alert").remove();

			$("#cambiarDivisa").val("USD");

			var pais = $(this).val();

			var tasaPais = $("#tasaPais").val();

			if(pais == tasaPais){

				var resultadoPeso = sumaTotalPeso * $("#envioNacional").val();

				if(resultadoPeso < $("#tasaMinimaNal").val()){

					$(".valorTotalEnvio").html($("#tasaMinimaNal").val());

					$(".valorTotalEnvio").attr("valor",$("#tasaMinimaNal").val());


				}else{

					$(".valorTotalEnvio").html(resultadoPeso);

					$(".valorTotalEnvio").attr("valor",resultadoPeso);
				}

			}else{

				var resultadoPeso = sumaTotalPeso * $("#envioInternacional").val();

				if(resultadoPeso < $("#tasaMinimaInt").val()){

					$(".valorTotalEnvio").html($("#tasaMinimaInt").val());

					$(".valorTotalEnvio").attr("valor",$("#tasaMinimaInt").val());

				}else{

					$(".valorTotalEnvio").html(resultadoPeso);

					$(".valorTotalEnvio").attr("valor",resultadoPeso);
				}

			}

			sumaTotalCompra();

		});

	}else{

		$(".btnPagar").attr("tipo","virtual");
	}

	

});

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
SUMA TOTAL DE LA COMPRA
=============================================*/
function sumaTotalCompra(){

	var sumaTotalTasas = Number($(".valorSubTotal").html()) + Number($(".valorTotalEnvio").html()) + Number($(".valorTotalImpuesto").html());
	
	$(".valorTotalCompra").html(sumaTotalTasas.toFixed(2));

	$(".valorTotalCompra").attr("valor",sumaTotalTasas.toFixed(2));

}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
METODO DE PAGO PARA CAMBIO DE DIVISA
=============================================*/

var metodoPago = "paypal";
divisa(metodoPago);

$("input[name='pago']").change(function(){

	$("#cambiarDivisa").html("");

	var metodoPago = $(this).val();

	divisa(metodoPago);

});

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
FUNCION PARA EL CAMBIO DE DIVISA
=============================================*/

function divisa(metodoPago){

	if (metodoPago == "paypal") {

		$("#cambiarDivisa").append('<option value="USD">USD</option>'+
									'<option value="EUR">EUR</option>'+
									'<option value="GBP">GBP</option>'+
									'<option value="MXN">MXN</option>'+
									'<option value="JPY">JPY</option>'+
									'<option value="CAD">CAD</option>'+
									'<option value="BRL">BRL</option>');
		
	}else{

		$("#cambiarDivisa").append('<option value="USD">USD</option>'+
									'<option value="BRL">BRL</option>'+
									'<option value="CLP">CLP</option>'+
									'<option value="COP">COP</option>'+
									'<option value="MXN">MXN</option>'+
									'<option value="PEN">PEN</option>'+
									'<option value="ARS">ARS</option>');

	}

}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
CAMBIO DE DIVISA
=============================================*/

var divisaBase = "USD";
var apiKey = "b5cbdcec510d8b4dfa75";

$("#cambiarDivisa").change(function(){

	$(".alert").remove();

	if ($("#seleccionarPais").val() == "") {
		
		$("#cambiarDivisa").after('<div class="alert alert-warning">Seleccione pais de envio</div>');

		console.log("mensaje captrado");

		return;

	}

	var divisa = $(this).val();

	$.ajax({

		url:"https://free.currconv.com/api/v7/convert?q="+divisaBase+"_"+divisa+"&compact=ultra&apiKey="+apiKey,
		type:"GET",
		cache:false,
		cntentType:false,
		processData:false,
		dataType:"jsonp",
		success:function(respuesta){

			var divisaString = JSON.stringify(respuesta);

			var conversion = divisaString.substr(11,4);		

			if (divisa == "USD") {
				conversion = 1;
			}

			$(".cambioDivisa").html(divisa);

			$(".valorSubTotal").html((Number(conversion) * Number($(".valorSubTotal").attr("valor"))).toFixed(2));
			$(".valorTotalEnvio").html((Number(conversion) * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2));
			$(".valorTotalImpuesto").html((Number(conversion) * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2));
			$(".valorTotalCompra").html((Number(conversion) * Number($(".valorTotalCompra").attr("valor"))).toFixed(2));

			var valorItem = $(".valorItem");

			for(var i = 0;i<valorItem.length;i++){

				$(valorItem[i]).html((Number(conversion)*Number($(valorItem[i]).attr("valor"))).toFixed(2));

			}

		}

	})

});


/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
BOTON PAGAR
=============================================*/
$(".btnPagar").click(function(){

	var tipo = $(this).attr("tipo");

	if (tipo == "fisico" && $("#seleccionarPais").val() == "") {
		
		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el pais de envio</div>');

		return;

	}

	console.log("procedad..");
	

});





