<?php

	$servidor = Ruta::ctrRutaServidor();
	$url = Ruta::ctrRuta();

?> 
 
<!--=====================================
BREADCRUMB CARRITO DE COMPRAS
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
TABLA CARRITO DE COMPRAS
======================================-->

<div class="container-fluid">
	<div class="container">
	
		<div class="panel panel-default">

			<!--=====================================
			CABEZERA CARRITO DE COMPRAS
			======================================-->

			<div class="panel-heading cabeceraCarrito">

				<div class="col-md-6 col-sm-7 col-xs-12 text-center">
					
					<h3><small>PRODUCTO</small></h3>

				</div>


				<div class="col-md-2 col-sm-1 col-xs-0 text-center">
					
					<h3><small>PRECIO</small></h3>

				</div>

				<div class="col-sm-2 col-xs-0 text-center">
					
					<h3><small>CANTIDAD</small></h3>

				</div>
				

				<div class="col-sm-2 col-xs-0 text-center">
					
					<h3><small>SUBTOTAL</small></h3>

				</div>

			</div>

			<!--=====================================
			CUERPO DE CARRITO DE COMPRAS
			======================================-->

			<div class="panel-body cuerpoCarrito">
				
			

			</div>


			<!--=====================================
				SUMA TOTAL DE LOS PRODUCTOS
			======================================-->
			
			<div class="panel-body sumaCarrito">
				
				<div class="col-md-4 col-sm-6 col-xs-12 pull-right well">
					
					<div class="col-xs-6">
						
						<h4>TOTAL:</h4>

					</div>

					<div class="col-xs-6">
							
						<h4 class="sumaSubTotal">
							
							<strong>USD $<span>21</span></strong>

						</h4>

					</div>	

				</div>

			</div>

			<!--=====================================
				BOTON CHECKOUT
			======================================-->
			<div class="panel-heading cabezeraCheckout">

 				<?php
					if(isset($_SESSION["validarSession"])){
						if($_SESSION["validarSession"] == "ok"){

							echo '<a class="btnCheckout" href="#modalCheckout" data-toggle="modal" idUsuario="'.$_SESSION["id"].'"><button class="btn btn-default backColor btn-lg pull-right">Realizar Pago</button></a>';

						}
					}else{

						echo '<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default backColor btn-lg pull-right">Realizar Pago</button></a>';
						
					}
				 ?>

			</div>

		</div>
		
	</div>
</div>

<!--=====================================
VENTANA MODAL CHECKOUT
======================================-->

<div id="modalCheckout" class="modal fade modalFormulario" role="dialog">

	<div class="modal-content modal-dialog">

		<div class="modal-body modalTitulo">

			<h3 class="backColor">Realizar Pago</h3>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="contenidoCheckout">

				<?php
				
					$respuesta = ControladorCarrito::ctrMostrarTarifas();

					echo '<input type="hidden" id="tasaImpuesto" value="'.$respuesta["impuesto"].'">
					<input type="hidden" id="envioNacional" value="'.$respuesta["envioNacional"].'">
					<input type="hidden" id="envioInternacional" value="'.$respuesta["envioInternacional"].'">
					<input type="hidden" id="tasaMinimaNal" value="'.$respuesta["tasaMinimaNal"].'">
					<input type="hidden" id="tasaMinimaInt" value="'.$respuesta["tasaMinimaInt"].'">
					<input type="hidden" id="tasaPais" value="'.$respuesta["pais"].'">';
				?>

				<div class="formEnvio row">

					<h4 class="text-center well text-muted text-uppercase">
						Información de envio
					</h4>

					<div class="seleccionePais col-xs-12">

						<select name="seleccionarPais" id="seleccionarPais" class="form-control">
							<option value="">Seleccione el pais</option>
						</select>

					</div>

				</div>

				<br>

				<div class="formPago row">

					<h4 class="text-center well text-muted text-uppercase">Elige la forma de pago</h4>

					<figure class="col-xs-6">
						<center>
							<input id="checkPaypal" type="radio" name="pago" value="paypal" checked>
						</center>

						<img src="<?php echo $url;?>vista/img/plantilla/paypal.jpg" alt="paypal" class="img-thumbnail">

					</figure>

					<figure class="col-xs-6">
						<center>
							<input id="checkPayu" type="radio" name="pago" value="payu">
						</center>

						<img src="<?php echo $url;?>vista/img/plantilla/payu.jpg" alt="paypal" class="img-thumbnail">

					</figure>

				</div>

				<br>

				<div class="listaProductos row">

					<h4 class="text-center well text-muted text-uppercase">
						Productos a comprar
					</h4>

					<table class="table table-striped tablaProductos">

						<thead>

							<tr>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>

							</tr>
						</thead>
						<tbody>

						</tbody>

					</table>

					<div class="col-sm-6 col-xs-12 pull-right">

						<table class="table table-striped tablaTasas">

							<tbody>

								<tr>
									<td>SubTotal</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorSubTotal" valor="0">0</span></td>
								</tr>

								<tr>
									<td>Envio</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalEnvio" valor="0">0</span></td>
								</tr>

								<tr>
									<td>Impuesto</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalImpuesto" valor="0">0</span></td>
								</tr>

								<tr>
									<td><strong>Total</strong></td>
									<td><strong><span class="cambioDivisa">USD</span> $<span class="valorTotalCompra" valor="0">0</span></strong></td>
								</tr>

							</tbody>

						</table>

						<div class="divisa">

							<select class="form-control" name="divisa" id="cambiarDivisa">
								
							</select>

							<br>

						</div>

					</div>	
					
					<div class="clearfix"></div>

					<button class="btn btn-block btn-lg btn-default backColor btnPagar">Pagar</button>

				</div>

			</div>

		</div>

		<div class="modal-footer"></div>

	</div>

</div>
