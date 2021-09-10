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

				<!--=====================================
				ITEM 1
				======================================-->
				
				<div class="row itemCarrito">
					
					<div class="col-sm-1 col-xs-12">
						
						<br>
						<center>
							
							<button class="btn btn-default backColor"><i class="fa fa-times"></i></button>

						</center>

					</div>

					<div class="col-sm-1 col-xs-12">
						
						<figure >
							<img src="http://localhost/backend/vistas/img/productos/cursos/curso02.jpg" class="img-thumbnail">
						</figure>

					</div>

					<div class="col-sm-4 col-xs-12">
						
						<br>

						<p class="tituloCarritoCompra text-left">Aprende JavaScript desde Cero ejemplo</p>

					</div>

					<div class="col-md-2 col-sm-3 col-xs-8">
						
						<br>

						<p class="tituloCarritoCompra text-center">USD $<span>10</span></p>

					</div>

					<div class="col-md-2 col-sm-3 col-xs-8">

						<br>
							
							<div class="col-xs-8">

								<center>
							
									<input type="number" name="" class="form-control text-center" min="1" value="1" readonly>

								</center>	

							</div>	

					</div>

					<div class="col-md-2 col-sm-3 col-xs-8">
						
						<br>

						<p>

							<strong>USD $<span>10</span></strong>

						</p>

					</div>

				</div>
				 <hr>

				<!--=====================================
				ITEM 2
				======================================-->

				<div class="row itemCarrito">
					
					<div class="col-sm-1 col-xs-12">
						
						<br>
						<center>
							
							<button class="btn btn-default backColor"><i class="fa fa-times"></i></button>

						</center>

					</div>

					<div class="col-sm-1 col-xs-12">
						
						<figure >
							<img src="http://localhost/backend/vistas/img/productos/ropa/ropa04.jpg" class="img-thumbnail">
						</figure>

					</div>

					<div class="col-sm-4 col-xs-12">
						
						<br>

						<p class="tituloCarritoCompra text-left">Vestido Jean</p>

					</div>

					<div class="col-md-2 col-sm-3 col-xs-8">
						
						<br>

						<p class="tituloCarritoCompra text-center">USD $<span>11</span></p>

					</div>

					<div class="col-md-2 col-sm-3 col-xs-8">

						<br>
							
							<div class="col-xs-8">

								<center>
							
									<input type="number" name="" class="form-control text-center" min="1" value="1">

								</center>	

							</div>	

					</div>

					<div class="col-md-2 col-sm-3 col-xs-8">
						
						<br>

						<p>

							<strong>USD $<span>10</span></strong>
							
						</p>

					</div>

				</div>

				<hr>

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
							
						<h4 class="sumaTotal">
							
							<strong>USD $<span>21</span></strong>

						</h4>

					</div>	

				</div>

			</div>

		</div>
		
	</div>
</div>
