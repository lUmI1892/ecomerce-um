<?php 

	require_once "../controlador/usuarios.controlador.php";
	require_once "../modelo/usuarios.modelo.php";

	class AjaxUsuarios{

		/*=============================================
		VALIDAR EMAIL EXISTENTE
		=============================================*/

		public $validadEmail;

		public function ajaxValidarEmail(){

			$datos = $this->validarEmail;

			$respuesta = ControladorUsuarios::ctrMostrarUsuario("email",$datos);

			echo json_encode($respuesta,true);

		}

		/*=============================================
		REGISTRO CON FACEBOOK
		=============================================*/

		public $email;
		public $nombre;
		public $foto;

		public function ajaxRegistroFacebook(){

			$datos = array("nombre"=>$this->nombre,
							"email"=>$this->email,
							"foto"=>$this->foto,
							"password"=>"null",
							"modo"=>"facebook",
							"verificacion"=>0,
							"emailEncriptado"=>"null");

			$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

			echo $respuesta;

		}

		/*=============================================
		AGREGAR A LA LISTA DE DESEOS
		=============================================*/

		public $idUsuario;
		public $idProducto;

		public function ajaxAgregarDeseo(){

			$datos = array("id_usuario"=>$this->idUsuario,
							"id_producto"=>$this->idProducto);

			$respuesta = ControladorUsuarios::ctrAgregarDeseo($datos);

			echo $respuesta;

		}

		/*=============================================
		QUITAR PRODUCTO DE LA LISTA DE DESEOS
		=============================================*/

		public $idDeseo;
		
		public function ajaxQuitarDeseo(){

			$datos = $this->idDeseo;

			$respuesta = ControladorUsuarios::ctrQuitarDeseo($datos);

			echo $respuesta;

		}

	}

/*=============================================
	VALIDAR EMAIL EXISTENTE
=============================================*/

if (isset($_POST["validarEmail"])) {
	
	$valEmail = new AjaxUsuarios();

	$valEmail -> validarEmail = $_POST["validarEmail"];

	$valEmail->ajaxValidarEmail();

}

/*=============================================
	REGISTRO CON FACEBOOK
=============================================*/

if (isset($_POST["email"])) {
	
	$regFacebook = new AjaxUsuarios();

	$regFacebook -> email = $_POST["email"];
	$regFacebook -> nombre = $_POST["nombre"];
	$regFacebook -> foto = $_POST["foto"];

	$regFacebook->ajaxRegistroFacebook();

}

/*=============================================
	AGREGAR A LISTA DE DESEOS
=============================================*/

if (isset($_POST["id_usuario"])) {
	
	$deseo = new AjaxUsuarios();

	$deseo -> idUsuario = $_POST["id_usuario"];
	$deseo -> idProducto = $_POST["id_producto"];
	$deseo->ajaxAgregarDeseo();

}

/*=============================================
	QUITAR PRODUCTOS DE LA LISTA DE DESEO
=============================================*/

if (isset($_POST["idDeseo"])) {
	
	$quitarDeseo = new AjaxUsuarios();

	$quitarDeseo -> idDeseo = $_POST["idDeseo"];
	$quitarDeseo->ajaxQuitarDeseo();

}