<?php

	class ControladorProductos{

		public function ctrMostrarCategorias(){

			$tabla = "categoria";

			$respuesta = ModeloProductos::mdlMostrarCategorias($tabla);

			return $respuesta;
		}

		public function ctrMostrarSubCategorias($id){

			$tabla = "subcategoria";

			$respuesta = ModeloProductos::mdlMostrarSubCategorias($tabla,$id);

			return $respuesta;
		}
	}