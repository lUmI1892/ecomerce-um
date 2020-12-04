<?php 
	
	require_once "controlador/plantilla.controlador.php";
	require_once "controlador/productos.controlador.php";

	require_once "modelo/plantilla.modelo.php";
	require_once "modelo/productos.modelo.php";

	$plantilla = new ControladorPlantilla();
	$plantilla ->plantilla();

 ?>

 