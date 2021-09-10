use ecommerce;

select * from slide;

select * from productos;

create table plantilla
(
	id int not null primary key AUTO_INCREMENT,
	barraSuperior text,
	textoColor text,
	colorFondo text,
	colorTexto text,
	redesSociales text,
	logo text,
	icono text,
	fecha TIMESTAMP
);

create table categoria
(
	id int not null primary key AUTO_INCREMENT,
	categoria text not null,
	ruta text not null,
	fecha TIMESTAMP
);

create table subcategoria
(
	id int not null primary key AUTO_INCREMENT,
	subcategoria text not null,
	id_categoria int not null references categoria(id),
	ruta text not null,
	fecha TIMESTAMP
);

create table slide
(

	id int not null primary key auto_increment,
	imgFondo text,
	tipoSlide text,
	imgProducto text,
	estiloImgProducto text,
	estiloTextoSlide text,
	titulo1 text,
	titulo2 text,
	tirulo3 text,
	boton text,
	url text,
	fecha TIMESTAMP
);

create table productos
(
	id int not null primary key auto_increment, 
	id_categoria int not null references categoria(id),
	id_subcategoria int not null references subcategoria(id),
	tipo_producto text not null,
	ruta text not null,
	titulo text not null,
	titular text not null,
	descripion text ,
	detalles text,
	precio float,
	portada text,
	vistas int not null,
	ventas int not null,
	vistasGratis int not null,
	ventasGratis int not null,
	ofertadoPorCategoria int,
	ofertaPorSubcategoria int,
	oferta int,
	precioOferta float,
	descuentoOferta int,
	imgOferta text,
	finOferta datetime,
	nuevo int,
	peso float,
	entrega float,
	fecha timestamp
);

create table banner
(
	id int not null primary key auto_increment,
    ruta text not null,
    img text not null,
    titulo1 text,
    titulo2 text,
    titulo3 text,
    estilo text,
    fecha timestamp
);

create table deseos(
	id int not null primary key auto_increment,
	id_usuario int not null,
	id_producto int not null,
	fecha timestamp
);

create table comercio(
	id int not null primary key auto_increment,
	impuesto float not null,
	envioNacional float not null,
	envioInternacional float not null,
    tasaMinimaNal float not null,
    tasaMinimaInt float not null
);


DELETE from deseos where id=4;

select * from productos where id=402;
select * from banner;

delete from banner where id = 3;

 insert into banner values ('','sin-categoria','vistas/img/banner/default.jpg','{"texto":"OFERTAS ESPECIALES","color":"#0ff"}','{"texto":"50% off","color":"#fff"}','{"texto":"Termina el 31 de Octubre","color":"#0ff"}','textDer','');


SELECT * from productos where precio=0 order by id desc limit 4;



SELECT * from productos where titulo like '%vestido%' order by id asc limit 1, 12;