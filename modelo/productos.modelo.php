<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/
	static public function mdlMostrarCategorias($tabla,$item,$valor){

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item=:valor");

			$stmt->bindParam(":valor",$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();


		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUBCATEGORIAS
	=============================================*/
	

	static public function mdlMostrarSubCategorias($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item=:$item");

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla,$ordenar,$item,$valor,$base,$tope,$modo){

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item=:$item order by $ordenar $modo limit $base,$tope");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt->fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla order by $ordenar $modo limit $base,$tope");

			$stmt -> execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR INFOPRODUCTO
	=============================================*/
	

	static public function mdlMostrarInfoProducto($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item=:$item");

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	LISGTAR PRODUCTOS
	=============================================*/
	

	static public function mdlListarProductos($tabla,$ordenar,$item,$valor){

		if ($item != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item=:$item ORDER BY $ordenar DESC");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla ORDER BY $ordenar DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}	

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarBanner($tabla,$ruta){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where ruta=:ruta");

		$stmt->bindParam(":ruta",$ruta,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BUSCADOR
	=============================================*/

	static public function mdlBuscarProductos($tabla,$busqueda,$base,$tope,$ordenar,$modo){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where ruta like '%$busqueda%' or titulo like '%$busqueda%' or titular like '%$busqueda%' or descripion like '%$busqueda%' order by $ordenar $modo limit $base, $tope");

		$stmt->execute();

		return $stmt ->fetchAll();

		$stmt ->close();

		$stmt = null;

	}

	/*=============================================
	LISTAR PRODUCTOS BUSCADOR
	=============================================*/

	static public function mdlListarProductosBusqueda($tabla,$busqueda){


		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where ruta like '%$busqueda%' or titulo like '%$busqueda%' or titular like '%$busqueda%' or descripion like '%$busqueda%'");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR VISTA PRODUCTO
	=============================================*/

	static public function mdlActualizarVistaProducto($tabla,$datos,$item){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set $item=:item where ruta = :ruta");

		$stmt->bindParam(":item",$datos["valor"],PDO::PARAM_STR);
		$stmt->bindParam(":ruta",$datos["ruta"],PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$stmt -> close();

		$stmt = null;

	}
}