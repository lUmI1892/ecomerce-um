<?php 

	class ControladorUsuarios{

		/*=============================================
		REGISTRO USUARIO
		=============================================*/		

		public function ctrRegistroUsuario(){

			if (isset($_POST["regUsuario"])) {
				
				if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["regUsuario"]) &&
					preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z09_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["regEmail"]) && 
					preg_match('/^[a-zA-Z0-9]+$/',$_POST["regPassword"])) {

					$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$encriptarEmail = md5($_POST["regEmail"]);

					$datos = array("nombre"=>$_POST["regUsuario"],
									"password"=>$encriptar,
									"email"=>$_POST["regEmail"],
									"modo"=>"directo",
									"foto"=>"",
									"verificacion"=>1,
									"emailEncriptado"=>$encriptarEmail);

					$tabla = "usuarios";

					$respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla,$datos);

					if ($respuesta == "ok") {

						/*=============================================
						VERIFICACION DE CORREO ELECTRONICO ON PHPMailer
						=============================================*/

						date_default_timezone("America/La_Paz");

						$url = Ruta::ctrRuta();

						$email = new PHPMailer;

						$email->charSet = 'UTF-8';

						$mail->isMail();

						$mail->setFrom('Cursos@tutorialesatualcanse.com','Tutoriales a tu alcanse');

						$mail->addReplyTo('Cursos@tutorialesatualcanse.com','Tutoriales a tu alcanse');

						$email->Subject = "Por favor verifique su direccion de correo electronico";

						$email->addAddress($_POST["regEmail"]);

						$email->smgHTML('<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif;padding-bottom: 40px;">
			
								<center>
									
									<img src="vista/img/plantilla/logo.png" style="padding: 20px; width: 10%">

								</center>

								<div style="position: relative;margin: auto; width: 600px; background: white;padding: 20px;">

									<center>
										
										<img src="vista/img/plantilla/icon-email.png" style="padding: 20px; width: 15%">

										<h3 style="font-weight: 100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

										<hr style="border:1px solid #ccc;width:80%">

										<h4 style="font-weight: 100;color:#999;padding: 0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correo electrónico</h4>
										
										<a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none;">

											<div style="line-height: 60px; background: #0aa;width: 60%;color: white;">Verifique su dirección de correo electrónico</div>

										</a>

										<br>

										<hr style="border:1px solid #ccc;width:80%">

										<h5 style="font-weight: 100;color:#999">Si no se inscribio en esta cuenta, puede ignorar este correo electronico y la cuenta se eliminará</h5>

									</center>
									

								</div>

								

							</div>');


						$envio = $mail->Send();

						if (!$envio) {

							echo '<script>
								swal({

									title: "¡ERROR!",
									text: "¡Ha ocurrido un problema enviando verificacion de correo electronico a '.$_POST["regEmail"].$mail->ErrorInfo.'!",
									type: "error",
									confirmButtonText: "Cerrar",
									closeOnConfirm: false

									},

									function(isConfirm){
										if(isConfirm){
											history.back();
										}
								})
							</script>';
							
							

						}else{

							echo '<script>
								swal({

									title: "¡OK!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electronico '.$_POST["regEmail"].' para verificar su cuenta!",
									type: "success",
									confirmButtonText: "Cerrar",
									closeOnConfirm: false

									},

									function(isConfirm){
										if(isConfirm){
											history.back();
										}
								})
							</script>';

						}

					}
					

				}else{
					echo '<script>
						swal({

							title: "¡ERROR!",
							text: "¡Error al registrar el usuario, no se permiten caracteres especiales!",
							type: "error",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							},

							function(isConfirm){
								if(isConfirm){
									history.back();
								}
						})
					</script>';
				}

			}


		}

		/*=============================================
		MOSTRAR USUARIO
		=============================================*/

		static public function ctrMostrarUsuario($item,$valor){

			$tabla = "usuarios";

			$respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla,$item,$valor);

			return $respuesta;

		}

		/*=============================================
		ACTUALIZAR USUARIO
		=============================================*/

		static public function ctrActualizarUsuario($id,$item,$valor){

			$tabla = "usuarios";

			$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla,$id,$item,$valor);

			return $respuesta;

		}

		/*=============================================
		INGRESO DE  USUARIO
		=============================================*/

		static public function ctrIngresoUsuario(){

			if (isset($_POST["ingEmail"])) {

					if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z09_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["ingEmail"]) && 
					preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingPassword"])) {

						$encriptar = crypt($_POST["ingPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

						$tabla = "usuarios";
						$item = "email";
						$valor = $_POST["ingEmail"];

						$respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla,$item,$valor);

						if ($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar) {
							
							if ($respuesta["verificacion"] == 1) {
								
									echo '<script>
								swal({

									title: "¡NO HA VERIFICADO SU CORREO ELECTRÓNICO!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo para verificar la direccion de correo electrónico '.$respuesta["email"].' para verificar su cuenta!",
									type: "success",
									confirmButtonText: "Cerrar",
									closeOnConfirm: false

									},

									function(isConfirm){
										if(isConfirm){
											history.back();
										}
								})
							</script>';

							}else{

								$_SESSION["validarSession"] = "ok";
								$_SESSION["id"] = $respuesta["id"];
								$_SESSION["nombre"] = $respuesta["nombre"];
								$_SESSION["foto"] = $respuesta["foto"];
								$_SESSION["email"] = $respuesta["email"];
								$_SESSION["password"] = $respuesta["password"];
								$_SESSION["modo"] = $respuesta["modo"];


								echo '<script>

										window.location = localStorage.getItem("rutaActual");

								</script>';


							}

						}else{

							echo '<script>
								swal({

									title: "¡ERROR AL INGRESAR!",
									text: "¡Por favor revise que el usuario o la contraseña coincida con la registrada!",
									type: "error",
									confirmButtonText: "Cerrar",
									closeOnConfirm: false

									},

									function(isConfirm){
										if(isConfirm){
											window.location = localStorage.getItem("rutaActual");
										}
								})
							</script>';

						}


					}else{

						echo '<script>
						swal({

							title: "¡ERROR!",
							text: "¡Error al ingresar al sistema, no se permiten caracteres especiales!",
							type: "error",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							},

							function(isConfirm){
								if(isConfirm){
									history.back();
								}
						})
					</script>';

					}
				
			}

		}

		/*=============================================
		OLVIDO PASSWORD
		=============================================*/

		public function ctrOlvidoPassword(){

			if (isset($_POST["passEmail"])) {

				if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z09_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["passEmail"])) {
					
					/*=============================================
					GENERAR CONTRASEÑA ALEATORIA
					=============================================*/

					function generarPassword($longitud){

						$key = "";

						$pattern = "1234567890abcdefghijklmnopqrstuwxyz";

						$max = strlen($pattern)-1;

						for ($i=0; $i < $longitud; $i++) { 
							
							$key .= $pattern{mt_rand(0,$max)};

						}

						return $key;

					}

					$nuevaPassword = generarPassword(11);

					var_dump($nuevaPassword);

					$encriptar = crypt($nuevaPassword,'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$tabla = "usuarios";

					$item = "email";
					$valor = $_POST["passEmail"];

					$respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla,$item,$valor);

					if ($respuesta){
						
						$id = $respuesta["id"];
						$item2 = "password";
						$valor2 = $encriptar;

						$respuesta2 = ModeloUsuarios::mdlActualizarUsuario($tabla,$id,$item2,$valor2);

						if ($respuesta == "ok") {

							/*=============================================
							CAMBIO DE CONTRASEÑA
							=============================================*/

							date_default_timezone("America/La_Paz");

							$url = Ruta::ctrRuta();

							$email = new PHPMailer;

							$email->charSet = 'UTF-8';

							$mail->isMail();

							$mail->setFrom('Cursos@tutorialesatualcanse.com','Tutoriales a tu alcanse');

							$mail->addReplyTo('Cursos@tutorialesatualcanse.com','Tutoriales a tu alcanse');

							$email->Subject = "Solicitud de nueva contraseña";

							$email->addAddress($_POST["passEmail"]);

							$email->smgHTML('<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif;padding-bottom: 40px;">
		
								<center>
									
									<img src="vista/img/plantilla/logo.png" style="padding: 20px; width: 10%">

								</center>

								<div style="position: relative;margin: auto; width: 600px; background: white;padding: 20px;">

									<center>
										
										<img src="vista/img/plantilla/icon-pass.png" style="padding: 20px; width: 15%">

										<h3 style="font-weight: 100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

										<hr style="border:1px solid #ccc;width:80%">

										<h4 style="font-weight: 100;color:#999;padding: 0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>
										
										<a href="'.$url.'" target="_blank" style="text-decoration:none;">

											<div style="line-height: 60px; background: #0aa;width: 60%;color: white;">Ingrese nuevamente al sitio</div>

										</a>

										<br>

										<hr style="border:1px solid #ccc;width:80%">

										<h5 style="font-weight: 100;color:#999">Si no se inscribio en esta cuenta, puede ignorar este correo electronico y la cuenta se eliminará</h5>

									</center>
									

								</div>

								

							</div>');


							$envio = $mail->Send();

								if (!$envio) {

									echo '<script>
										swal({

											title: "¡ERROR!",
											text: "¡Ha ocurrido un problema enviando cambio de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'!",
											type: "error",
											confirmButtonText: "Cerrar",
											closeOnConfirm: false

											},

											function(isConfirm){
												if(isConfirm){
													history.back();
												}
										})
									</script>';
									
									

								}else{

									echo '<script>
										swal({

											title: "¡OK!",
											text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electronico '.$_POST["passEmail"].' para su cambio de contraseña!",
											type: "success",
											confirmButtonText: "Cerrar",
											closeOnConfirm: false

											},

											function(isConfirm){
												if(isConfirm){
													history.back();
												}
										})
									</script>';

								}

						}

					}else{

						echo '<script>
						swal({

							title: "¡ERROR!",
							text: "¡Error el correo electronico no existe en el sistema!",
							type: "error",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							},

							function(isConfirm){
								if(isConfirm){
									history.back();
								}
							})
						</script>';

					}

				}else{

					echo '<script>
						swal({

							title: "¡ERROR!",
							text: "¡Error al enviar el correo electronico, no se permiten caracteres especiales!",
							type: "error",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							},

							function(isConfirm){
								if(isConfirm){
									history.back();
								}
						})
					</script>';

				}
				


			}

		}

		/*=============================================
		REGISTRO CON REDES SOCIALES
		=============================================*/

		static public function ctrRegistroRedesSociales($datos){

			$tabla = "usuarios";
			$item = "email";
			$valor = $datos["email"];

			$emailRepetido = false;

			$respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla,$item,$valor);

			if ($respuesta) {

				if ($respuesta["modo"] != $datos["modo"]) {
					
					echo '<script>
						swal({

							title: "¡ERROR!",
							text: "¡El correo electronico '.$datos["email"].', ya está registrado el el sistema con un método diferente a google!",
							type: "error",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							},

							function(isConfirm){
								if(isConfirm){
									history.back();
								}
						})
					</script>';

					$emailRepetido = false;

				}

				$emailRepetido = true;

			}else{

				$respuesta1 = ModeloUsuarios::mdlRegistroUsuario($tabla,$datos);

			}

			

			if ($emailRepetido || $respuesta1 == "ok") {
				
				

				$respuesta2 = ModeloUsuarios::mdlMostrarUsuario($tabla,$item,$valor);

				if ($respuesta2["modo"] == "facebook") {

					session_start();
					
					$_SESSION["validarSession"] = "ok";
					$_SESSION["id"] = $respuesta2["id"];
					$_SESSION["nombre"] = $respuesta2["nombre"];
					$_SESSION["foto"] = $respuesta2["foto"];
					$_SESSION["email"] = $respuesta2["email"];
					$_SESSION["password"] = $respuesta2["password"];
					$_SESSION["modo"] = $respuesta2["modo"];

					echo "ok";

				}else if($respuesta2["modo"] == "google"){

					$_SESSION["validarSession"] = "ok";
					$_SESSION["id"] = $respuesta2["id"];
					$_SESSION["nombre"] = $respuesta2["nombre"];
					$_SESSION["foto"] = $respuesta2["foto"];
					$_SESSION["email"] = $respuesta2["email"];
					$_SESSION["password"] = $respuesta2["password"];
					$_SESSION["modo"] = $respuesta2["modo"];

					echo "<span style='color:white'>ok</span>";

				}else{

					echo "";

				}

			}

		}

		/*=============================================
		ACTUALIZAR PERFIL
		=============================================*/

		public function ctrActualizarPerfil(){

			if (isset($_POST["editarNombre"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta="";

				if (isset($_FILES["datosImagen"]["tmp_name"])) {
					
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					$directorio = "vista/img/usuarios/".$_POST["idUsuario"];

					if (!empty($_POST["fotoUsuario"])) {
						
						unlink($_POST["fotoUsuario"]);

					}else{

						mkdir($directorio,0755);

					}

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$aleatorio = mt_rand(100,999);

					$ruta = "vista/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".jpg";

					/*=============================================
					MODIFICAMOS TAMAÑO DE LA FOTO
					=============================================*/

					list($ancho,$alto) = getimagesize($_FILES["datosImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$origen = imagecreatefromjpeg($_FILES["datosImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);

				}

				if ($_POST["editarPassword"] == "") {
					$password = $_POST["passUsuario"];
				}else{

					$password = crypt($_POST["editarPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				}
				
				$datos = array("nombre"=>$_POST["editarNombre"],
								"email"=>$_POST["editarEmail"],
								"password"=>$password,
								"foto"=>$ruta,
								"id"=>$_POST["idUsuario"]);

				$tabla = "usuarios";

				$respuesta = ModeloUsuarios::mdlActualizarPerfil($tabla,$datos);

				if ($respuesta == "ok") {

					$_SESSION["validarSession"] = "ok";
					$_SESSION["id"] = $datos["id"];
					$_SESSION["nombre"] = $datos["nombre"];
					$_SESSION["foto"] = $datos["foto"];
					$_SESSION["email"] = $datos["email"];
					$_SESSION["password"] = $datos["password"];
					$_SESSION["modo"] = $_POST["modoUsuario"];

					echo '<script>
						swal({

							title: "¡OK!",
							text: "¡Su cuenta ha sido actualizada correctamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							},

							function(isConfirm){
								if(isConfirm){
									history.back();
								}
						})
					</script>';
					
				}

			}

		}

		/*=============================================
		MOSTRAR COMPRAS
		=============================================*/

		static public function ctrMostrarCompras($item,$valor){

			$tabla = "compras";

			$respuesta = ModeloUsuarios::mdlMostrarCompras($tabla,$item,$valor);

			return $respuesta;

		}


		/*=============================================
		MOSTRAR COMENTARIOS PERFIL
		=============================================*/

		static public function ctrMostrarComentariosPerfil($datos){

			$tabla = "comentarios";

			$respuesta = ModeloUsuarios::mdlMostrarComentariosPerfil($tabla,$datos);

			return $respuesta;

		}

		/*=============================================
		ACTUALIZAR COMENTARIOS
		=============================================*/

		static public function ctrActualizarComentario(){

			if (isset($_POST["comentario"])) {
				
				if (preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["comentario"])) {
					
					if ($_POST["comentario"] != "") {
						
						$tabla = "comentarios";

						$datos = array("id"=>$_POST["idComentario"],
										"calificacion"=>$_POST["puntaje"],
										"comentario"=>$_POST["comentario"]);

						$respuesta = ModeloUsuarios::mdlActualizarComentario($tabla,$datos);

						if ($respuesta == "ok") {
							
							echo '<script>
								swal({

									title: "¡GRACIAS POR COMPARTIR SU OPINIÓN!",
									text: "¡Su calificaión y comentario ha sido guardado!",
									type: "success",
									confirmButtonText: "Cerrar",
									closeOnConfirm: false

									},

									function(isConfirm){
										if(isConfirm){
											history.back();
										}
								})
							</script>';

						}

					}else{

						echo '<script>
							swal({

								title: "¡ERROR AL ENVIAR SU CALIFICACION!",
								text: "¡El comentario no puede estar vacío!",
								type: "error",
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

								},

								function(isConfirm){
									if(isConfirm){
										history.back();
									}
							})
						</script>';

					}

				}else{

					echo '<script>
						swal({

							title: "¡ERROR AL ENVIAR SU CALIFICACION!",
							text: "¡El comentario no puede llevar caracteres especiales!",
							type: "error",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

							},

							function(isConfirm){
								if(isConfirm){
									history.back();
								}
						})
					</script>';

				}

			}

		}

		/*=============================================
		AGREGAR A LA LISTA DE DESEOS
		=============================================*/

		static public function ctrAgregarDeseo($datos){

			$tabla = "deseos";

			$respuesta = ModeloUsuarios::mdlAgregarDeseo($tabla,$datos);

			return $respuesta;

		}

		/*=============================================
		MOSTRAR LISTA DE DESEOS
		=============================================*/

		static public function ctrMostrarDeseo($item){

			$tabla = "deseos";

			$respuesta = ModeloUsuarios::mdlMostrarDeseo($tabla,$item);

			return $respuesta;

		}

		/*=============================================
		QUITAR LISTA DE DESEOS
		=============================================*/

		static public function ctrQuitarDeseo($datos){

			$tabla = "deseos";

			$respuesta = ModeloUsuarios::mdlQuitarDeseo($tabla,$datos);

			return $respuesta;

		}

		
		/*=============================================
		ELIMINAR USUARIO
		=============================================*/

		public function ctrEliminarUsuario(){

			if (isset($_GET["id"])) {
				
				$tabla1 = "usuarios";
				$tabla2 = "comentarios";
				$tabla3 = "compras";
				$tabla4 = "deseos";

				$id = $_GET["id"];

				if ($_GET["foto"] != "") {
					unlink($_GET["foto"]);
					rmdir('vista/img/usuarios/'.$_GET["id"]);
				}

				$respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla1,$id);

				ModeloUsuarios::mdlEliminarComentarios($tabla2,$id);

				ModeloUsuarios::mdlEliminarCompras($tabla3,$id);
				
				ModeloUsuarios::mdlEliminarListaDeseos($tabla4,$id);

				if ($respuesta == "ok") {
					
					$url = Ruta::ctrRuta();

					echo '<script>
								swal({

									title: "SU CUENTA HA SIDO BORRADA!",
									text: "¡Debe registrarse nuevamente si desea ingresar!",
									type: "success",
									confirmButtonText: "Cerrar",
									closeOnConfirm: false

									},

									function(isConfirm){
										if(isConfirm){
											window.location = "'.$url.'salir";
										}
								})
						</script>';

				}

			}

		}

		

	}