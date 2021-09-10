<!--=====================================
SLIDESHOW
======================================-->

<div class="container-fluid" id="slide">
	<div class="row">
		
		<!--=====================================
		DIAPOSITIVAS
		======================================-->

		<ul>

			<?php 

			$servidor = Ruta::ctrRutaServidor();

			$slide = ControladorSlide::ctrMostrarSlide();

			foreach ($slide as $key => $value) {

				$estiloImgProducto =json_decode($value["estiloImgProducto"],true);

				$estiloTextoSlide =json_decode($value["estiloTextoSlide"],true);

				$titulo1 = json_decode($value["titulo1"],true);

				$titulo2 = json_decode($value["titulo2"],true);

				$titulo3 = json_decode($value["tirulo3"],true);

				

				echo '	<li>
							<img src="'.$servidor.$value["imgFondo"].'">

							<div class="slideOpciones '.$value["tipoSlide"].'">

							<img class="imgProducto" src="'.$servidor.$value["imgProducto"].'" style="top:'.$estiloImgProducto["top"].'; right:'.$estiloImgProducto["right"].';width:'.$estiloImgProducto["width"].';left:'.$estiloImgProducto["left"].'">

								<div class="textosSlide" style="top:'.$estiloTextoSlide["top"].'; left:'.$estiloTextoSlide["left"].'; width:'.$estiloTextoSlide["width"].';right:'.$estiloTextoSlide["right"].'">

									<h1 style="color:'.$titulo1["color"].'">'.$titulo1["text"].'</h1>

									<h2 style="color:'.$titulo2["color"].'">'.$titulo2["text"].'</h2>

									<h3 style="color:'.$titulo3["color"].'">L'.$titulo3["text"].'</h3>

									<a href="'.$value["url"].'">

										'.$value["boton"].'

									</a>

								</div>

							</div>
				</li>';
			}

			?>	
			

		</ul>

		<!--=====================================
			PAGUINACION
			======================================-->

			<ol id="paguinacion">

				<?php 

					for ($i=1; $i <= count($slide) ; $i++) { 
						
						echo '<li item="'.$i.'"><span class="fa fa-circle"></span></li>';
					}					

				 ?>
			</ol>

		<!--=====================================
			FLECHAS
			======================================-->

			<div class="flechas" id="retroceder"><span class="fa fa-chevron-left"></span></div>

			<div class="flechas" id="avanzar"><span class="fa fa-chevron-right"></span></div>

		</div>
	</div>

	<center>
		<button id="btnSlide" class="backColor">
			<i class="fa fa-angle-up"></i>
		</button>
	</center>