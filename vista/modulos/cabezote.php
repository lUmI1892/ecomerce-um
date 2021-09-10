<?php 

	$servidor = Ruta::ctrRutaServidor();
	$url = Ruta::ctrRuta();

		/*=============================================
	INICIO DE SESSION USUARIO
	=============================================*/
	if (isset($_SESSION["validarSession"])) {
		if ($_SESSION["validarSession"] == "ok") {
			echo '<script>

				localStorage.setItem("usuario","'.$_SESSION["id"].'");
			</script>';
		}
	}


	/*=============================================
	CREAR EL OBJETO DE LA API DE GOOGLE
	=============================================*/
	$cliente = new Google_Client();
	$cliente->setAuthConfig('modelo/client_secret.json');
	$cliente->setAccessType("offline");
	$cliente->setScopes(['profile','email']);

	/*=============================================
	RUTA PARA EL LOGIN DE GOOGLE
	=============================================*/

	$rutaGoogle = $cliente->createAuthUrl();

	/*=============================================
	RECIVIMOS LA VARIABLE GET DE GOOGLE LLAMDA CODE
	=============================================*/

	if (isset($_GET["code"])) {
		
		$token = $cliente->authenticate($_GET["code"]);

		$_SESSION["id_token_google"] = $token;

		$cliente->setAccessToken($token);


	}

	/*=============================================
	RECIBIMOS LOS DATOS CRIFRADOS DE GOOGLE EN UN ARRAY
	=============================================*/

	if ($cliente->getAccessToken()) {
		
		$item = $cliente->verifyIdToken();

		$datos = array("nombre"=>$item["name"],
						"email"=>$item["email"],
						"foto"=>$item["picture"],
						"password"=>"null",
						"modo"=>"google",
						"verificacion"=>0,
						"emailEncriptado"=>"null");

		$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

			echo '<script>
	
				setTimeout(function(){

					window.location = localStorage.getItem("rutaActual");				
	
				},1000)
			</script>';

	}

 ?>

<!--=====================================
TOP
======================================-->

<div class="container-fluid barraSuperior" id="top">
	<div class="container">

		<div class="row">
			
			<!--=====================================
			SOCIAL
			======================================-->
			
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
				
				<ul>

					<?php 

					$social = ControladorPlantilla::ctrEstiloPlantilla();

					$jsonRedesSociales = json_decode($social["redesSociales"],true);

					foreach ($jsonRedesSociales as $key => $value) {
						echo'<li>
						<a href="'.$value["url"].'" target="_blank">
						<i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
						</a>
						</li>';
					}

					?>

				</ul>

			</div>

			<!--=====================================
			REGISTRO
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
				
				<ul>

					<?php 

						if (isset($_SESSION["validarSession"])) {
							
							if ($_SESSION["validarSession"] == "ok") {
								
								if ($_SESSION["modo"] == "directo") {
									
									if ($_SESSION["foto"] != "") {
										
										echo '<li>

											<img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">
	
										</li>';

									}else{


										echo '<li>

											<img class="img-circle" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="10%">
	
										</li>';

									}

									echo '<li>|</li>
									<li><a href="'.$url.'perfil">Ver perfil</a></li>
									<li>|</li>
									<li><a href="'.$url.'salir">Salir</a></li>';

								}

								if($_SESSION["modo"] == "facebook"){

									echo '<li>

										<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
	
									</li>
									<li>|</li>
									<li><a href="'.$url.'perfil">Ver perfil</a></li>
									<li>|</li>
									<li><a href="'.$url.'salir" class="salir">Salir</a></li>';

								}

								if ($_SESSION["modo"] == "google") {
									
									echo '<li>

										<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
	
									</li>
									<li>|</li>
									<li><a href="'.$url.'perfil">Ver perfil</a></li>
									<li>|</li>
									<li><a href="'.$url.'salir">Salir</a></li>';

								}

							}

						}else{

							echo '<li>
								<a href="#modalIngreso" data-toggle="modal">Ingresar</a>
							</li>

							<li>|</li>

							<li>
								<a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a>
							</li>';

						}

					 ?>
					
				

				</ul>

			</div>

		</div>
		
	</div>
</div>

<!--=====================================
HEADER
======================================-->
<header class="container-fluit">
	<div class="container">
		
		<div class="row" id="cabezote">
			
			<!--=====================================
			lOGOTIPO
			======================================-->

			<div class="col-lg3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
				<a href="<?php echo $url; ?>">
					<img src="<?php echo $servidor.$social["logo"]; ?>" class="img-responsive">
				</a>
			</div>

			<!--=====================================
			BLOQUE CATEGORIA Y BUSCADOR
			======================================-->

			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">

			<!--=====================================
			BOTON CATEGORIAS
			======================================-->

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">

				<p>CATEGORÍAS
					<span class="pull-right">
						<i class="fa fa-bars" aria-hidden="true"></i>
					</span>
				</p>
				
			</div>

			<!--=====================================
			BUSCADOR
			======================================-->

			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 input-group" id="buscador">
				
				<input type="search" name="buscar" class="form-control" placeholder="Buscar...">

				<span class="input-group-btn">
					<a href="<?php echo $url; ?>buscador/1/recientes">
						<button class="btn btn-default backColor" type="submit">
							<i class="fa fa-search"></i>
							
						</button>
					</a>
				</span>
			</div>
		</div>

		<!--=====================================
			CARRITO DE COMPRAS
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">

				<a href="<?php echo $url; ?>carrito-de-compras">
					<button class="btn btn-default pull-left backColor">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</button>
				</a>	

				<p>TU CESTA <span class="cantidadCesta"></span> <br> USD $ <span class="sumaCesta"></span></p>

			</div>

		</div>

		<!--=====================================
		CATEGORIAS
		======================================-->

		<div class="col-xs-12 col backColor" id="categorias">

			<?php 

			$item=null;
			$valor=null;

			$categorias = ControladorProductos::ctrMostrarCategorias($item,$valor);


			foreach ($categorias as $key => $value) {

				echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
				<h4>
				<a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a>
				</h4>

				<hr>

				<ul>';

				$item = "id_categoria";

				$valor = $value["id"];

				$subcategorias = ControladorProductos::ctrMostrarSubCategorias($item,$valor);

				foreach ($subcategorias as $key => $value) {
					
					echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategoria">'.$value["subcategoria"].'</a></li>';

				}

				echo '</ul>
				</div>	';
			}

			?>


		</div>

	</div>
</header>

<!--=====================================
VENTANA MODAL PARA EL REGISTRO
======================================-->

<div class="modal fade modalFormulario" id="modalRegistro" role="dialog">
    <div class="modal-content modal-dialog">
    
      <!-- Modal content-->

        <div class="modal-body modalTitulo">
        	<h3 class="backColor">Registrarse</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <!--=====================================
        REGISTRO FACEBOOK
        ======================================-->
        <div class="col-sm-6 col-xs-12 facebook" id="btnFacebookRegistro">
        	
			<p>
				
				<i class="fa fa-facebook"></i>
				Registro con Facebook
			</p>

        </div>

         <!--=====================================
        REGISTRO GOOGLE
        ======================================-->
		<a href="<?php echo $rutaGoogle; ?>">
	         <div class="col-sm-6 col-xs-12 google" id="btnGoogleRegistro">
	        	
				<p>
					
					<i class="fa fa-google"></i>
					Registro con Google

				</p>

	        </div>
        </a>

         <!--=====================================
        REGISTRO DIRECTO
        ======================================-->

        <form method="post" onsubmit="return registroUsuario()">
        	
			<hr>
			 <div class="form-group">
              <label for="username"><span class="glyphicon glyphicon-user"></span> Usuario</label>
              <input type="text" class="form-control text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre completo" required>
            </div>

             <div class="form-group">
              <label for="email"><span class="glyphicon glyphicon-envelope"></span> Correo electronico</label>
              <input type="email" class="form-control" id="regEmail" name="regEmail" placeholder="Correo electronico" required>
            </div>

             <div class="form-group">
	              <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Contraseña</label>
	              <input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Ingrese contraseña">
            </div>

            <!--=====================================
        	https://www.iubenda.com/ CONDICIONES DE USO Y POLITICAS DE PRIVACIDAD
        	======================================-->
        	 <div class="checkbox">
              <label><input type="checkbox" value="" id="regPoliticas">Al registrarse, usted acepta nuestras condiciones y politicas de privacidad</label>
            </div>

            <?php 

            	$registro = new ControladorUsuarios();
            	$registro -> ctrRegistroUsuario();

             ?>

             <button type="submit" class="btn btn-default btn-block backColor btnIngreso"><span class="glyphicon glyphicon-off"></span> ENVIAR</button>

        </form>
        

        </div>
        <div class="modal-footer">
          
			<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
         Ya tienes una cuenta registrada?<br><strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>

        </div>
      
    </div>
  </div>



  <!--=====================================
VENTANA MODAL PARA EL INGRESO
======================================-->

<div class="modal fade modalFormulario" id="modalIngreso" role="dialog">
    <div class="modal-content modal-dialog">
    
      <!-- Modal content-->

        <div class="modal-body modalTitulo">
        	<h3 class="backColor">INGRESAR</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <!--=====================================
       INGRESO FACEBOOK
        ======================================-->
        <div class="col-sm-6 col-xs-12 facebook" id="btnFacebookRegistro">
        	
			<p>
				
				<i class="fa fa-facebook"></i>
				Ingreso con Facebook
			</p>

        </div>

         <!--=====================================
        INGRESO GOOGLE
        ======================================-->

        <a href="<?php echo $rutaGoogle; ?>">

	         <div class="col-sm-6 col-xs-12 google" id="btnGoogleRegistro">
	        	
				<p>
					
					<i class="fa fa-google"></i>
					Ingreso con Google

				</p>

	        </div>

        </a>

         <!--=====================================
        REGISTRO DIRECTO
        ======================================-->

        <form method="post">
        	
			<hr>

             <div class="form-group">
              <label for="email"><span class="glyphicon glyphicon-envelope"></span> Correo electronico</label>
              <input type="email" class="form-control" id="ingEmail" name="ingEmail" placeholder="Correo electronico" required>
            </div>

             <div class="form-group">
	              <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Contraseña</label>
	              <input type="password" class="form-control" id="ingPassword" name="ingPassword" placeholder="Ingrese contraseña">
            </div>

            <?php 

            	$ingreso = new ControladorUsuarios();
            	$ingreso -> ctrIngresoUsuario();

             ?>

             <button type="submit" class="btn btn-default btn-block backColor btnIngreso"><span class="glyphicon glyphicon-off"></span> ENVIAR</button>

             <br>

             <center>
             		
             		<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">Olvidaste tu contraseña?</a>

             </center>

        </form>
        

        </div>
        <div class="modal-footer">
          
			<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
         No tienes una cuenta registrada?<br><strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>
      
    </div>
  </div>


<!--=====================================
VENTANA MODAL PARA EL OLVIDO DE CONTRASEÑA
======================================-->

<div class="modal fade modalFormulario" id="modalPassword" role="dialog">
    <div class="modal-content modal-dialog">
    
      <!-- Modal content-->

        <div class="modal-body modalTitulo">
        	<h3 class="backColor">SOLICITUD DE NUEVA CONTRASEÑA</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        
         <!--=====================================
        OLVIDO CONTRASEÑA
        ======================================-->

        <form method="post">
        	
			<hr>

			<label class="text-muted">Escribe el correo electronico con el que te registraste y alli te enviaremos una nueva contraseña</label>

			<br>

             <div class="form-group">
              <label for="email"><span class="glyphicon glyphicon-envelope"></span> Correo electronico</label>
              <input type="email" class="form-control" id="passEmail" name="passEmail" placeholder="Correo electronico" required>
            </div>

            <?php 

            	$ingreso = new ControladorUsuarios();
            	$ingreso -> ctrOlvidoPassword();

             ?>

             <button type="submit" class="btn btn-default btn-block backColor"><span class="glyphicon glyphicon-off"></span> ENVIAR</button>


        </form>
        

        </div>
        <div class="modal-footer">
          
			<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
         No tienes una cuenta registrada?<br><strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>
      
    </div>
  </div>



