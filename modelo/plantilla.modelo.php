<?php 

	require_once "conexion.php";

	class ModeloPlantilla{

		static public function mdlEstiloPlantilla($tabla){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

			$stmt -> execute();

			return $stmt->fetch(); 

			$stmt ->close();
		} 
	}

 ?>