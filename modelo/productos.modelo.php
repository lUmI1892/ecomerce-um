<?php

	require_once "conexion.php";

	class ModeloProductos{
		static public function mdlMostrarCategorias($tabla){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

			$stmt->execute();

			return $stmt->fetchAll();

			$stmt -> close();

			$stmt = null;

		}


		static public function mdlMostrarSubCategorias($tabla,$id){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_categoria = :id_categoria");

			$stmt->bindParam(":id_categoria",$id,PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

			$stmt -> close();

			$stmt = null;

		}
	}