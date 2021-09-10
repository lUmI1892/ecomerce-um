<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viweport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<meta name="title" content="Tienda Virtual">

	

	<meta name="descripcion" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	">

	<meta name="keyword" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor, incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris, nisi ut aliquip ex ea commodo">
	<title>Tienda Virtual</title>

	<?php 

	session_start();

	$servidor = Ruta::ctrRutaServidor();

	$icono = ControladorPlantilla::ctrEstiloPlantilla();

	echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';

		/*=============================================
		MANTENER LA RUTA FIJA DEL PROYECTO
		=============================================*/	

		$ruta = Ruta::ctrRuta();
		$url = Ruta::ctrRuta();

		?>

		<!--=====================================
		PLUGINS DE CSS
		======================================-->
		

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/plugins/bootstrap.min.css">

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/plugins/font-awesome.min.css">

		<!--<link rel="stylesheet" href="https://font.googleapis.com/css?family=Ubuntu">

		<link rel="stylesheet" href="https://font.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed">-->

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/plugins/flexslider.css">

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/plugins/sweetalert.css">

		<!--=====================================
		HOJAS DE ESTILO PERSONALIZADAS
		======================================-->

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/plantilla.css">

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/cabezote.css">

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/slide.css">

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/productos.css">

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/infoproducto.css">

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/perfil.css">

		<link rel="stylesheet" href="<?php echo $ruta; ?>vista/css/carrito-de-compras.css">


		<!--=====================================
		PLUGINS DE JAVASCRIP
		======================================-->

		<script type="text/javascript" src="<?php echo $ruta; ?>vista/js/plugins/jquery.min.js"></script>

		<script type="text/javascript" src="<?php echo $ruta; ?>vista/js/plugins/bootstrap.min.js"></script>

		<script type="text/javascript" src="<?php echo $ruta; ?>vista/js/plugins/jquery.easing.js"></script>

		<script type="text/javascript" src="<?php echo $ruta; ?>vista/js/plugins/jquery.scrollUp.js"></script>

		<script type="text/javascript" src="<?php echo $ruta; ?>vista/js/plugins/jquery.flexslider.js"></script>

		<script type="text/javascript" src="<?php echo $ruta; ?>vista/js/plugins/sweetalert.min.js"></script>




	</head>
	<body>

	<!--=====================================
	CABEZOTE
	======================================-->
	
	<?php 

	include "modulos/cabezote.php";

		/*=============================================
			CONTENIDO DINAMICO
			=============================================*/


			$rutas = array();

			$ruta = null;	

			$infoProducto = null;  

			if (isset($_GET["ruta"])) {
				
				$rutas = explode("/",$_GET["ruta"]);

				$item = "ruta";

				$valor = $rutas[0];
				//var_dump($valor);

				/*=============================================
				URL AMIGABLES DE CATEGORIA
				=============================================*/


				$rutaCategorias = ControladorProductos::ctrMostrarCategorias($item,$valor);

				if($valor == $rutaCategorias["ruta"]){
					$ruta = $valor;
				}

				/*=============================================
				URL AMIGABLES DE SUBCATEGORIAS
				=============================================*/

				$rutaSubCategoria = ControladorProductos::ctrMostrarSubCategorias($item,$valor);

				foreach ($rutaSubCategoria as $key => $value) {
					
					if ($rutas[0] == $value["ruta"]) {
						$ruta = $rutas[0];
					}
				}

				/*=============================================
				URL AMIGABLES DE PRODUCTOS
				=============================================*/

				$rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item,$valor);



				if ($rutas[0] == $rutaProductos["ruta"]) {
					$infoProducto = $rutas[0];
				}

				/*=============================================
				LISTA BLANCA DE URL AMIGABLES
				=============================================*/

				if ($ruta != null || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto" || $rutas[0] == "articulos-gratis") {

					include "modulos/productos.php";

				}else if($infoProducto != null){

					include "modulos/infoproducto.php";

				}else if($rutas[0] == "buscador" || $rutas[0] == "verificar" || $rutas[0] == "salir" || $rutas[0] == "perfil" || $rutas[0] == "carrito-de-compras"){

					include "modulos/".$rutas[0].".php";

				}else{

					include "modulos/error404.php";

				}
			}	
			else{

				include "modulos/slide.php";

				include "modulos/destacados.php";
			} 

			?>

			<input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">

			<!--=====================================
				JAVASCRIP PERSONALIZADO
			======================================-->

			<script src="<?php echo $url; ?>vista/js/cabezote.js"></script>
			<script src="<?php echo $url; ?>vista/js/plantilla.js"></script>
			<script src="<?php echo $url; ?>vista/js/slide.js"></script>
			<script src="<?php echo $url; ?>vista/js/buscador.js"></script>
			<script src="<?php echo $url; ?>vista/js/infoproducto.js"></script>
			<script src="<?php echo $url; ?>vista/js/usuarios.js"></script>
			<script src="<?php echo $url; ?>vista/js/registroFacebook.js"></script>
			<script src="<?php echo $url; ?>vista/js/carrito-de-compras.js"></script>

			<!--=====================================
			SCRIPT PARA INICIO DE SESSION EN FACEBOOK
			======================================-->	

			<script>
			  window.fbAsyncInit = function() {
			    FB.init({
			      appId      : '2854638071460721',
			      cookie     : true,
			      xfbml      : true,
			      version    : 'v10.0'
			    });
			      
			    FB.AppEvents.logPageView();   
			      
			  };

			  (function(d, s, id){
			     var js, fjs = d.getElementsByTagName(s)[0];
			     if (d.getElementById(id)) {return;}
			     js = d.createElement(s); js.id = id;
			     js.src = "https://connect.facebook.net/en_US/sdk.js";
			     fjs.parentNode.insertBefore(js, fjs);
			   }(document, 'script', 'facebook-jssdk'));
			</script>

		</body>
		</html>