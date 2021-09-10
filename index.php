<?php 
	
	require_once "controlador/plantilla.controlador.php";
	require_once "controlador/productos.controlador.php";
	require_once "controlador/slide.controlador.php";
	require_once "controlador/usuarios.controlador.php";
	require_once "controlador/carrito.controlador.php";


	require_once "modelo/plantilla.modelo.php";
	require_once "modelo/productos.modelo.php";
	require_once "modelo/slide.modelo.php";
	require_once "modelo/usuarios.modelo.php";
	require_once "modelo/carrito.modelo.php";

	require_once "modelo/rutas.php";

	require_once "extensiones/PHPMailer/PHPMailerAutoload.php";
	require_once "extensiones/vendor/autoload.php";

	$plantilla = new ControladorPlantilla();
	$plantilla ->plantilla();

?>

