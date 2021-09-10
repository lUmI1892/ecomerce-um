<?php

	class ControladorProductos{

		/*=============================================
		MOSTRAR CATEGORIAS
		=============================================*/

		public function ctrMostrarCategorias($item,$valor){

			$tabla = "categoria";

			$respuesta = ModeloProductos::mdlMostrarCategorias($tabla,$item,$valor);

			return $respuesta;
		}

		/*=============================================
		MOSTRAR SUBCATEGORIAS
		=============================================*/

		public function ctrMostrarSubCategorias($item,$valor){

			$tabla = "subcategoria";

			$respuesta = ModeloProductos::mdlMostrarSubCategorias($tabla,$item,$valor);

			return $respuesta;
		}
		/*=============================================
		MOSTRAR PRODUCTOS
		=============================================*/

		static public function ctrMostrarProductos($ordenar,$item,$valor,$base,$tope,$modo){

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlMostrarProductos($tabla,$ordenar,$item,$valor,$base,$tope,$modo);

			return $respuesta;
		}

		/*=============================================
		MOSTRAR INFO PRODUCTO
		=============================================*/

		static public function ctrMostrarInfoProducto($item,$valor){

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlMostrarInfoProducto($tabla,$item,$valor);

			return $respuesta;

		}

		/*=============================================
		LISTAR PRODUCTOS
		=============================================*/

		static public function ctrListarProductos($ordenar,$item,$valor){

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlListarProductos($tabla,$ordenar,$item,$valor);

			return $respuesta;

		}

		static public function ctrMostrarBanner($ruta){

			$tabla = "banner";

			$respuesta = ModeloProductos::mdlMostrarBanner($tabla,$ruta);

			return $respuesta;

		}

		/*=============================================
		BUSCADOR PRODUCTOS
		=============================================*/

		static public function ctrBuscarProductos($busqueda,$base,$tope,$ordenar,$modo){

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlBuscarProductos($tabla,$busqueda,$base,$tope,$ordenar,$modo);

			return $respuesta;
		}

		/*=============================================
		LISTAR PRODUCTOS BUSCARDOR
		=============================================*/

		static public function ctrListarProductosBusqueda($busqueda){

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlListarProductosBusqueda($tabla,$busqueda);

			return $respuesta;
		}

		/*=============================================
		ACTUALIZAR VISTA PRODUCTO
		=============================================*/

		static public function ctrActualizarVistaProducto($datos,$item){

			$tabla = "productos";

			$respuesta = ModeloProductos::mdlActualizarVistaProducto($tabla,$datos,$item);

			return $respuesta;
		}
		
	}