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

		$icono = ControladorPlantilla::ctrEstiloPlantilla();

		echo '<link rel="icon" href="http://localhost/backend/'.$icono["icono"].'">';

	 ?>

	

	<link rel="stylesheet" href="vista/css/plugins/bootstrap.min.css">

	<link rel="stylesheet" href="vista/css/plugins/font-awesome.min.css">

	<link rel="stylesheet" href="https://font.googleapis.com/css?family=Ubuntu">

	<link rel="stylesheet" href="https://font.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed">

	<link rel="stylesheet" href="vista/css/plantilla.css">

	<link rel="stylesheet" href="vista/css/cabezote.css">

	<script type="text/javascript" src="vista/js/plugins/jquery.min.js"></script>

	<script type="text/javascript" src="vista/js/plugins/bootstrap.min.js"></script>

	


</head>
<body>

	<!--=====================================
	CABEZOTE
	======================================-->
	
	<?php 

		include "modulos/cabezote.php";		

	 ?>

	<script src="vista/js/cabezote.js"></script>
	<script src="vista/js/plantilla.js"></script>
</body>
</html>