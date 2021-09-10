/*=============================================
CAPTURAR RUTA ACTUAL
=============================================*/

var rutaActual = location.href;

$(".btnIngreso, #btnFacebookRegistro, #btnGoogleRegistro").click(function(){

	localStorage.setItem("rutaActual",rutaActual);

})

/*=============================================
FORMATEAR LOS INPUT
=============================================*/
$("input").focus(function(){

	$(".alert").remove();

})



/*=============================================
VALIDAR EMAIL REPETIDO
=============================================*/

var validarEmailRepetido = false;

$("#regEmail").change(function(){

	var email = $("#regEmail").val();

	var datos = new FormData();

	datos.append("validarEmail",email);

	$.ajax({

		url:rutaOculta+"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){

			if (respuesta == "false") {

				$(".alert").remove();

				validarEmailRepetido = false;

			}else{

				var modo = JSON.parse(respuesta).modo;

				if (modo == "directo") {

					modo = "esta página";
				}

				$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, fue registrado a través de '+modo+', por favor ingrese otro diferente</div>');

				validarEmailRepetido = true;

			}

		}

	})

})


/*=============================================
VALIDAR EL REGISTRO DE USUARIO
=============================================*/

function registroUsuario(){

	/*=============================================
	VALIDAR EL NOMBRE
	=============================================*/

	var nombre = $("#regUsuario").val();

	if (nombre != "") {

		var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

		if (!expresion.test(nombre)) {

			$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> No se permiten numeros ni caracteres especiales</div>');

			return false;

		}


	}else{
		$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');

		return false;
	}


	/*=============================================
	VALIDAR EL EMAIL
	=============================================*/

	var email = $("#regEmail").val();

	if (email != "") {

		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

		if (!expresion.test(email)) {

			$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Escriba correctamente el correo electronico</div>');

			return false;

		}

		if (validarEmailRepetido) {

			$("#regEmail").parent().before('<div class="alert alert-danger"><strong>ATENCIÓN:</strong> El correo electronico ya existe en la base de datos, por favor ingrese otro diferente</div>');

			return false;

		}


	}else{
		$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');

		return false;
	}


	/*=============================================
	VALIDAR EL PASSWORD
	=============================================*/

	var password = $("#regPassword").val();

	if (password != "") {

		var expresion = /^[a-zA-Z0-9]*$/;

		if (!expresion.test(password)) {

			$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> No se permiten caracteres especiales</div>');

			return false;

		}


	}else{
		$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>');

		return false;
	}


	/*=============================================
	VALIDAR POLITICAS DE PRIVACIDAD
	=============================================*/

	//var politicas = $(".checkbox #regPoliticas:checked").val();

	if (!$("#regPoliticas").is(':checked')) {

		$("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y politicas de privacidad</div>');
		return false;
	}

	return true;

}

/*=============================================
	CAMBIAR FOTO
=============================================*/

$("#btnCambiarFoto").click(function(){

	$("#imgPerfil").toggle();
	$("#subirImagen").toggle();

})

$("#datosImagen").change(function(){

	var imagen = this.files[0];

	/*=============================================
	VALIDAMOS EL FORMATO DE LA FOTO
	=============================================*/

	if(imagen["type"] != "image/jpeg"){

		$("#datosImagen").val("");

		swal({

				title:"Error al subir la imagen",
				text:"¡La imagen debe estar en formato JPG!",
				type:"error",
				confirmButtonText:"¡Cerrar!",
				closeOnConfirm:false
			},
			function(isConfirm){

				if (isConfirm) {

					window.location = rutaOculta+"perfil";

				}

			});

	}else if(Number(imagen["size"]) > 2000000){

		$("#datosImagen").val("");

		swal({

				title:"Error al subir la imagen",
				text:"¡La imagen no debe pesar mas de 2 MB!",
				type:"error",
				confirmButtonText:"¡Cerrar!",
				closeOnConfirm:false
			},
			function(isConfirm){

				if (isConfirm) {

					window.location = rutaOculta+"perfil";

				}

			});

	}else{

		var datosImagen = new FileReader;

		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load",function(event){

			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src",rutaImagen);

		})

	}

})

/*=============================================
COMENTARIOS
=============================================*/

$(".calificarProducto").click(function(){

	var idComentario = $(this).attr("idComentario");

	$("#idComentario").val(idComentario);

});

$("input[name='puntaje']").change(function(){

	var puntaje = $(this).val();

	switch(puntaje){

		case "0.5":

			$("#estrellas").html('<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');

			break;

		case "1":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');

			break;

		case "1.5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');

			break;

		case "2":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');

			break;

		case "2.5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');

			break;

		case "3":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');

			break;

		case "3.5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');

			break;

		case "4":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-o text-success" aria-hidden="true"></i> ');

			break;

		case "4.5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> ');

			break;

		case "5":

			$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
					'<i class="fa fa-star text-success" aria-hidden="true"></i> ');

			break;

	}

});

/*=============================================
VALIDAR EL COMENTARIO
=============================================*/

function validarComentario(){

	var comentario = $("#comentario").val();

	if (comentario != "") {

		var exprecion = /^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

		if (!exprecion.test(comentario)) {

			$("#comentario").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> No se permiten caracteres especiales como por ejemplo !$%&/[]</div>');

			return	false;

		}

	}else{

		$("#comentario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Campo obligatorio</div>');

		return	false;

	}

	return	true;

}
/*=============================================
LISTA DE DESEOS
================================================*/
$(".deseos").click(function(){

	var idProducto = $(this).attr("idProducto");
	var idUsuario = localStorage.getItem("usuario");

	if (idUsuario == null) {

			swal({

				title:"Debe ingresar al sistema",
				text:"¡Para agregar un producto a la 'lista de deseos' debe primero ingresar al sistema!",
				type:"warning",
				confirmButtonText:"¡Cerrar!",
				closeOnConfirm:false
			},
			function(isConfirm){

				if (isConfirm) {

					window.location = rutaOculta;

				}

			});
	}else{

		$(this).addClass("btn-danger");

		var datos = new FormData();

		datos.append("id_usuario",idUsuario);
		datos.append("id_producto",idProducto);

		$.ajax({
			url:rutaOculta+"ajax/usuarios.ajax.php",
			method:"POST",
			data:datos,
			cache:false,
			contentType:false,
			processData:false,
			success:function(respuesta){
				console.log("respuesta",respuesta);
			}
		})

	}

})

/*=============================================
BORRAR PRODUCTOS DE LISTA DE DESEOS
================================================*/

$(".quitarDeseo").click(function(){

	var idDeseo = $(this).attr("idDeseo");

	console.log(idDeseo);

	$(this).parent().parent().parent().remove();

	var datos = new FormData();
	datos.append("idDeseo",idDeseo);

	$.ajax({

		url:rutaOculta+"ajax/usuarios.ajax.php",
			method:"POST",
			data:datos,
			cache:false,
			contentType:false,
			processData:false,
			success:function(respuesta){
				console.log("respuesta",respuesta);
			}

	})

});

/*=============================================
ELIMINAR USUARIO
================================================*/
$("#eliminarUsuario").click(function(){

	var id = $("#idUsuario").val();

	if ($("#modoUsuario").val() == "directo") {

		if ($("#fotoUsuario").val() != "") {

			var foto = $("#fotoUsuario").val();

		}

	}

	swal({

			title:"¿Está usted seguro(a) de eliminar su cuenta?",
			text:"¡Si borra esta cuenta ya no se puede recuperar los datos!",
			type:"warning",
			showCancelButton:true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText:"¡Si, borrar cuenta!",
			closeOnConfirm:false
		},
		function(isConfirm){

			if (isConfirm) {

				window.location = "index.php?ruta=perfil&id="+id+"&foto="+foto;

			}

		});

});