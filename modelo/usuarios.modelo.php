<?php 

	require_once "conexion.php";

	class ModeloUsuarios{

		/*=============================================
		REGISTRO DE USUARIO
		=============================================*/

		static public function mdlRegistroUsuario($tabla,$datos){

			$stmt = Conexion::conectar()->prepare("INSERT into $tabla(nombre,password,email,modo,foto,verificacion,emailEncriptado) VALUES(:nombre,:password,:email,:modo,:foto,:verificacion,:emailEncriptado)");

			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":password",$datos["password"],PDO::PARAM_STR);
			$stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
			$stmt->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
			$stmt->bindParam(":modo",$datos["modo"],PDO::PARAM_STR);
			$stmt->bindParam(":verificacion",$datos["verificacion"],PDO::PARAM_INT);
			$stmt->bindParam(":emailEncriptado",$datos["emailEncriptado"],PDO::PARAM_STR);

			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt=null;

		}

		/*=============================================
		MOSTRAR USUARIO
		=============================================*/

		static public function mdlMostrarUsuario($tabla,$item,$valor){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item=:valor");

			$stmt->bindParam(":valor",$valor,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

			$stmt->close();
			$stmt=null;

		}


		/*=============================================
		ACTUALIZAR USUARIO
		=============================================*/

		static public function mdlActualizarUsuario($tabla,$id,$item,$valor){

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item=:$item WHERE id=:id");

			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

			$stmt->bindParam(":id",$id,PDO::PARAM_STR);

			if($stmt -> execute()){

				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt=null;

		}

		/*=============================================
		ACTUALIZAR PERFIL
		=============================================*/

		static public function mdlActualizarPerfil($tabla,$datos){

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre,email=:email,password=:password,foto=:foto WHERE id=:id");

			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);

			$stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);

			$stmt->bindParam(":password",$datos["password"],PDO::PARAM_STR);

			$stmt->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);

			$stmt->bindParam(":id",$datos["id"],PDO::PARAM_STR);

			if($stmt -> execute()){

				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt=null;

		}

		/*=============================================
		MOSTRAR COMPRAS
		=============================================*/
		static public function mdlMostrarCompras($tabla,$item,$valor){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item=:valor");

			$stmt->bindParam(":valor",$valor,PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt->fetchAll();

			$stmt->close();
			$stmt=null;

		}

		/*=============================================
		MOSTRAR COMENTARIOS PERFIL
		=============================================*/
		static public function mdlMostrarComentariosPerfil($tabla,$datos){

			if ($datos["idUsuario"] != "") {
				
				$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_usuario=:id_usuario and id_producto=:id_producto");

				$stmt->bindParam(":id_usuario",$datos["idUsuario"],PDO::PARAM_INT);
				$stmt->bindParam(":id_producto",$datos["idProducto"],PDO::PARAM_INT);

				$stmt -> execute();

				return $stmt->fetch();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_producto=:id_producto order by Rand()");

				$stmt->bindParam(":id_producto",$datos["idProducto"],PDO::PARAM_INT);

				$stmt -> execute();

				return $stmt->fetchAll();

			}

			

			$stmt->close();
			$stmt=null;

		}

		/*=============================================
		ACTUALIZAR COMENTARIO
		=============================================*/
		static public function mdlActualizarComentario($tabla,$datos){

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET calificacion=:calificacion, comentario=:comentario where id=:id");

			$stmt->bindParam(":calificacion",$datos["calificacion"],PDO::PARAM_STR);
			$stmt->bindParam(":comentario",$datos["comentario"],PDO::PARAM_STR);
			$stmt->bindParam(":id",$datos["id"],PDO::PARAM_INT);

			if($stmt -> execute()){

				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt=null;

		}

		/*=============================================
		AGREGAR A LISTA DE DESEOS
		=============================================*/

		static public function mdlAgregarDeseo($tabla,$datos){

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario,id_producto) values (:id_usuario,:id_producto)");

			$stmt->bindParam(":id_usuario",$datos["id_usuario"],PDO::PARAM_INT);
			$stmt->bindParam(":id_producto",$datos["id_producto"],PDO::PARAM_INT);

			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt = null;

		}

		/*=============================================
		MOSTRAR LISTA DE DESEOS
		=============================================*/

		static public function mdlMostrarDeseo($tabla,$item){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_usuario = :id_usuario order by id DESC");

			$stmt->bindParam(":id_usuario",$item,PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

			$stmt->close();

		}

		/*=============================================
		MOSTRAR LISTA DE DESEOS
		=============================================*/

		static public function mdlQuitarDeseo($tabla,$datos){

			$stmt = Conexion::conectar()->prepare("DELETE from $tabla where id=:id");

			$stmt->bindParam(":id",$datos,PDO::PARAM_INT);

			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt = null;

		}

		/*=============================================
		ELIMINAR USUARIO
		=============================================*/

		static public function mdlEliminarUsuario($tabla,$id){

			$stmt = Conexion::conectar()->prepare("DELETE from $tabla where id=:id");

			$stmt->bindParam(":id",$id,PDO::PARAM_INT);

			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt = null;

		}

		/*=============================================
		ELIMINAR COMENTARIOS DE USUARIO
		=============================================*/

		static public function mdlEliminarComentarios($tabla,$id){

			$stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_usuario=:id_usuario");

			$stmt->bindParam(":id_usuario",$id,PDO::PARAM_INT);

			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt = null;

		}


		/*=============================================
		ELIMINAR COMPRAS DE USUARIO
		=============================================*/

		static public function mdlEliminarCompras($tabla,$id){

			$stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_usuario=:id_usuario");

			$stmt->bindParam(":id_usuario",$id,PDO::PARAM_INT);

			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt = null;

		}


		/*=============================================
		ELIMINAR LISTA DE DESEOS DE USUARIO
		=============================================*/

		static public function mdlEliminarListaDeseos($tabla,$id){

			$stmt = Conexion::conectar()->prepare("DELETE from $tabla where id_usuario=:id_usuario");

			$stmt->bindParam(":id_usuario",$id,PDO::PARAM_INT);

			if ($stmt->execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt->close();
			$stmt = null;

		}


	}

 ?>