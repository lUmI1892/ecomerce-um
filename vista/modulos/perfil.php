<!--=====================================
VALIDAR SESSION
======================================-->

<?php 

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

if (!isset($_SESSION["validarSession"])) {

	echo '<script>
	window.location = "'.$url.'"
	</script>';

}

?>

 <!--=====================================
BREADCRUMB ONFOPRODUCTOS
======================================-->

<div class="container-fluid">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb lead fondoBreadcrumb">
				<li><a href="<?php echo $url; ?>">Inicio</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>
			</ul>
		</div>
	</div>
</div>

<!--=====================================
SESSION PERFIL
======================================-->
<div class="container-fluid">
	
	<div class="container">
		
		<ul class="nav nav-tabs">

			<li class="active">

				<a class="nav-link active" data-toggle="tab" href="#compras">
					<i class="fa fa-list-ul"></i> Mis compras
				</a>

			</li>

			<li>

				<a class="nav-link" data-toggle="tab" href="#deseos">
					<i class="fa fa-gift"></i> Mi lista de deseos
				</a>

			</li>
			<li>

				<a class="nav-link" data-toggle="tab" href="#perfil">
					<i class="fa fa-user"></i> Editar perfil
				</a>

			</li>

			<li>

				<a href="<?php echo $url; ?>ofertas">
					<i class="fa fa-star"></i> Ver ofertas
				</a>

			</li>

		</ul>

		<!-- Tab panes -->
		<div class="tab-content">

		<!--=====================================
		PESTAÑA COMPRAS
		======================================-->

		<div class="tab-pane fade in active" id="compras">
			<br>

			<div class="panel-group">

				<?php 

				$item = "id_usuario";
				$valor = $_SESSION["id"];

				$compras = ControladorUsuarios::ctrMostrarCompras($item,$valor);

				if (!$compras) {

					echo '<div class="col-xs-12 text-center error404">

					<h1><small>¡Oops!</small></h1>

					<h2>Aún no tienes compras realizadas en esta tienda</h2>

					</div>';

				}else{

					foreach ($compras as $key => $value) {

						$ordenar = "id";
						$item = "id";
						$valor = $value["id_producto"];

						$productos = ControladorProductos::ctrListarProductos($ordenar,$item,$valor);

						foreach ($productos as $key => $value2) {

							echo '<div class="panel panel-default">

							<div class="panel-body">

							<div class="col-md-2 col-sm-6 col-xs-12">

							<figure>
							<img class="img-thumbnail" src="'.$servidor.$value2["portada"].'">
							</figure>

							</div>
							<div class="col-sm-6 col-xs-12">

							<h1>'.$value2["titulo"].'</h1>

							<p>'.$value2["titular"].'</p>';

							if ($value2["tipo_producto"] == "virtual") {

								echo '<a href=""><button class="btn btn-default pull-left">Ir al curso</button></a>';

							}else{

								echo '<h6>Proceso de entrega: '.$value2["entrega"].' días hábiles</h6>';

								if ($value["envio"] == 0) {

									echo '<div class="progress">

									<div class="progress-bar progress-bar-info" role="progressbar" style="width:33.33%">
									<i class="fa fa-check"></i> Despachado
									</div>

									<div class="progress-bar progress-bar-default" role="progressbar" style="width:33.33%">
									<i class="fa fa-clock-o"></i> Enviado
									</div>

									<div class="progress-bar progress-bar-success" role="progressbar" style="width:33.33%">
									<i class="fa fa-clock-o"></i> Entregado
									</div>

									</div>';

								}

							}

							echo '<h4 class="pull-right"><small>Comprado el '.substr($value["fecha"],0,-8).'</small></h4>

							</div>

							<div class="col-md-4 col-xs-12">';

							$datos = array("idUsuario"=>$_SESSION["id"],
								"idProducto"=>$value2["id"]);

							$comentario = ControladorUsuarios::ctrMostrarComentariosPerfil($datos);


							echo '<div class="pull-right">

							<a href="#modalComentarios" class="calificarProducto" data-toggle="modal" idComentario="'.$comentario["id"].'"><button class="btn btn-default backColor">Calificar producto</button></a>

							</div>

							<br>
							<br>

							<div class="pull-right">

							<h3 class="text-right">';

							if ($comentario["calificacion"] == 0  && $comentario["comentario"] == "") {

								echo '<i class="fa fa-star-o text-success" aria-hidden="true"></i>
								<i class="fa fa-star-o text-success" aria-hidden="true"></i>
								<i class="fa fa-star-o text-success" aria-hidden="true"></i>
								<i class="fa fa-star-o text-success" aria-hidden="true"></i>
								<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

							}else{

								switch ($comentario["calificacion"]) {
									case 0.5:

									echo '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

									break;
									case 1.0:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

									break;
									case 1.5:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

									break;
									case 2.0:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

									break;
									case 2.5:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

									break;
									case 3.0:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

									break;
									case 3.5:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

									break;
									case 4.0:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-o text-success" aria-hidden="true"></i>';

									break;
									case 4.5:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>';

									break;
									case 5.0:

									echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>
									<i class="fa fa-star text-success" aria-hidden="true"></i>';

									break;

								}

							}

							echo '</h3>

							<p class="panel panel-default" style="padding:5px">
							<small>
							'.$comentario["comentario"].'
							</small>
							</p>

							</div>

							</div>

							</div>

							</div>';

						}

						
					}

				}

				?>

			</div>



		</div>
		  <!--=====================================
		PESTAÑA DESEOS
		======================================-->
		<div class="tab-pane fade container" id="deseos">

			<?php 

			$item = $_SESSION["id"];

			$deseos = ControladorUsuarios::ctrMostrarDeseo($item);

				//var_dump($deseos);

			if (!$deseos) {
				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center error404">
				<h1><small>¡Oops!</small></h1>
				<h2>Aún no tiene productos en su lista de deseos</h2>
				</div>';
			}else{

				foreach ($deseos as $key => $value1) {
					$ordenar = "id";
					$valor = $value1["id_producto"];
					$item = "id";

					$productos = ControladorProductos::ctrListarProductos($ordenar,$item,$valor);

					echo '<ul class="grid0">';

					foreach ($productos as $key => $value) {

						echo '<li class="col-md-3 col-sm-6 col-xs-12">
						<figure>
						<a href="'.$url.$value["ruta"].'" class="pixelProducto">
						<img src="'.$servidor.''.$value["portada"].'" class="img-responsive">
						</a>
						</figure>
						<h4>
						<small>
						<a href="'.$url.$value["ruta"].'" class="pixelProducto">
						'.$value["titulo"].'
						<br>
						<span style="color:rgba(0,0,0,0)">-</span>';

						if ($value["nuevo"] != 0) {
							echo '<span class="label label-warning fontSize">Nuevo</span> ';
						}

						if ($value["oferta"] != 0) {
							echo '<span class="label label-warning fontSize">'.$value["descuentoOferta"].'% off</span>';
						}

						echo '</a>
						</small>
						</h4>
						<div class="col-xs-6 precio">';

						if ($value["precio"] == 0) {

							echo '<h2 style="margin-top:-10px"><small>GRATIS</small></h2>';

						}else{

							if ($value["oferta"]!=0) {

								echo '<h2 style="margin-top:-10px">
								<small>
								<strong class="oferta" style="font-size:12px">USD $'.$value["precio"].'</strong>
								</small>
								<small>$'.$value["precioOferta"].'</small>
								</h2>';

							}else{

								echo '<h2 style="margin-top:-10px">
								<small>USD '."$".$value["precio"].'</small>
								</h2>';

							}



						}


						echo '</div>
						<div class="col-xs-6 enlaces">

						<div class="btn-group pull-right">
						<button type="button" class="btn btn-danger btn-xs quitarDeseo" idDeseo="'.$value1["id"].'" data-toggle="tooltip" title="Quitar de mi lista de deseos">
						<i class="fa fa-heart" aria-hidden="true"></i>
						</button>';

						if ($value["tipo_producto"] == "virtual" && $value["precio" !=0]) {

							if ($value["oferta"]!=0) {

								echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo_producto"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								</button>';

							}else{

								echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo_producto"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								</button>';

							}

						}

						echo '<a href="'.$url.$value["ruta"].'" class="pixelProducto">

						<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
						<i class="fa fa-eye" aria-hidden="true"></i>
						</button>

						</a>
						</div>
						</div>

						</li>';

					}

					echo '</ul>';
				}

			}

			?>
			

		</div>

		  <!--=====================================
		PESTAÑA PERFIL
		======================================-->
		<div class="tab-pane fade container" id="perfil">

			<div class="row">
				
				<form method="post" enctype="multipart/form-data">
					
					<div class="col-md-3 col-xs-12 text-center">
						<br>
						<figure id="imgPerfil">
							
							<?php 

							echo '<input type="hidden" value="'.$_SESSION["id"].'" name="idUsuario" id="idUsuario">
							<input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario" id="passUsuario">
							<input type="hidden" value="'.$_SESSION["foto"].'" name="fotoUsuario" id="fotoUsuario">
							<input type="hidden" value="'.$_SESSION["modo"].'" name="modoUsuario" id="modoUsuario">';

							if ($_SESSION["modo"] == "directo") {

								if ($_SESSION["foto"] != "") {

									echo '<img src="'.$url.$_SESSION["foto"].'" class="img-thumbnail">';

								}else{

									echo '<img src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" class="img-thumbnail">';

								}



							}else{

								echo '<img src="'.$_SESSION["foto"].'" class="img-thumbnail">';

							}

							?>

						</figure>

						<br>

						<?php 

						if ($_SESSION["modo"] == "directo") {

							echo '<button type="button" class="btn btn-default" id="btnCambiarFoto">

							Cambiar foto de perfil

							</button>';

						}

						?>

						<div id="subirImagen">

							<input type="file" class="form-control" id="datosImagen" name="datosImagen">

							<img class="previsualizar">


						</div>
						

					</div>

					<div class="col-md-9 col-sm-8 col-xs-12">
						
						<?php 
						

						if ($_SESSION["modo"] != "directo") {

							echo '<br><label class="control-label text-muted text-uppercase">Nombre:</label>
							<div class="input-group">

							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control" value="'.$_SESSION["nombre"].'" readonly>

							</div>
							<br>
							<label class="control-label text-muted text-uppercase">Correo electronico:</label>
							<div class="input-group">

							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							<input type="text" class="form-control" value="'.$_SESSION["email"].'" readonly>

							</div>
							<br>
							<label class="control-label text-muted text-uppercase">Modo de registro en el sistema:</label>
							<div class="input-group">

							<span class="input-group-addon"><i class="fa fa-'.$_SESSION["modo"].'"></i></span>
							<input type="text" class="form-control text-uppercase" value="'.$_SESSION["modo"].'" readonly>

							</div>
							<br>';

						}else{

							echo '<br><label class="control-label text-muted text-uppercase" for="editarNombre">Nombre:</label>
							<div class="input-group">

							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control" id="editarNombre" name="editarNombre" value="'.$_SESSION["nombre"].'">

							</div>
							<br>
							<label class="control-label text-muted text-uppercase" for="editarEmail">Cambiar correo electronico:</label>
							<div class="input-group">

							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							<input type="text" class="form-control" id="editarEmail" name="editarEmail" value="'.$_SESSION["email"].'">

							</div>
							<br>
							<label class="control-label text-muted text-uppercase" for="editarPassword">Cambiar contraseña:</label>
							<div class="input-group">

							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							<input type="password" class="form-control" id="editarPassword" name="editarPassword" placeholder="Escriba la nueva contraseña">

							</div>
							<br>
							<button type="submit" class="btn btn-default backColor btn-md pull-left">Actualizar Datos</button>';

						}

						?>

					</div>

					<?php 

					$actualizarPerfil = new ControladorUsuarios();
					$actualizarPerfil->ctrActualizarPerfil();

					?>

				</form>

				<button class="btn btn-danger btn-md pull-right" id="eliminarUsuario">Elminar cuenta</button>

				<?php 

					$borrarUsuario = new ControladorUsuarios();
					$borrarUsuario->ctrEliminarUsuario();

				?>

			</div>	

		</div>
	</div>

</div>

</div>

<!--=====================================
VENTANA MODAL PARA COMENTARIOS
======================================-->

<div class="modal fade modalFormulario" id="modalComentarios" role="dialog">
	
	<div class="modal-content modal-dialog">
		
		<div class="modal-body modalTitulo">
			
			<h3 class="backColor">Calificar este producto</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<form method="post" onsubmit="return validarComentario()">

				<input type="hidden" value="" id="idComentario" name="idComentario">
				
				<h1 class="text-center" id="estrellas">
					
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>

				</h1>

				<div class="form-group text-center">
					
					<label class="radio-inline"><input type="radio" name="puntaje" value="0.5">0.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="1">1</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="1.5">1.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="2">2</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="2.5">2.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="3">3</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="3.5">3.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="4">4</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="4.5">4.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="5" checked>5</label>

				</div>

				<div class="form-group">
					
					<label for="comment" class="text-muted">
						Tu opinión acerca de este producto: <span><small>(máximo 300 caracteres)</small></span>
					</label>

					<textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea>

					<br>

					<input type="submit" class="btn btn-default backColor btn-block" value="Enviar">

					

				</div>

				<?php 

				$actualizarComentario = new ControladorUsuarios();
				$actualizarComentario->ctrActualizarComentario();

				?>

			</form>

		</div>

		<div class="modal-footer">
			
			

		</div>

	</div>

</div>


