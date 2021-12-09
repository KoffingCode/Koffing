<template>

<div class="acerca">
	<div  class="col-12 d-flex justify-content-center">
        <img alt="logo" src="../assets/K.png">
	</div>
	<div class="fuente justificacion">
		<p>La cadena de café restaurante Koffing es la mayor cadena de restaurantes de comida con temática 
			de pokemon del país. Se estima que atienden alrededor de 20.000 clientes en los restaurantes 
		y cerca de 10.000 domicilios diariamente, en las 20 sedes localizadas en las principales 
			ciudades del país, esto son más de 100.000 platos diarios.
		</p>
		<br>
	</div>
	<h2 class="color col-12 d-flex justify-content-center">Contexto</h2>
	<br>
	<div class="fuente justificacion" >
		<p>Después de varias reuniones iniciales entre los directivos y los administradores de la cadena 
			Koffing, se ha llegado a la siguiente descripción que  debe tener el software que mantendrá a 
			Koffing en la posición de liderazgo que tiene en  la actualidad. El sistema restaurante, este
			sistema permite la administración de la información general de cada café restaurante. sus funciones
			principales son:
		</p>
		<br>
		<b class="colorp">Registro y login del sistema:</b>
		<p>Permite el registro y login al sistema de acuerdo al rol, existen 2 roles: mesero, que consulta
		y registra ventas del café restaurante y el administrador, quien parametriza meseros, mesas, platos, 
		categorías de platos y gestiona los turnos de los meseros. El registro cuenta con el nombre de usuario,
		email y contraseña y para el login se le pide al usuario el nombre de usuario y el email.
		</p>
		<br>
		<b class="colorp">Parametrización de meseros:</b>
		<p>Permite la creación, modificación, eliminacion, y búsqueda de meseros, de cada mesero se registra: 
		Tipo de  documento, número de identificación, nombre, apellidos, sexo, teléfono fijo,  teléfono celular,
		fecha de nacimiento, emaill,  dirección, barrió, ciudad, nivel académico
		</p>
		<br>
		<b class="colorp">Parametrización de mesas:</b>
		<p> Permite la creación, modificación, eliminación, de las mesas del restaurante, de cada mesa se registra: 
			número de  mesa, capacidad.
		</p>
		<br>
		<b class="colorp">Parametrización de turnos: </b>
		<p>Permite el manejo de una agenda de turnos de los meseros,con creación, modificación , eliminación y búsqueda 
			de los turnos de los meseros, de cada turno se registra: identificador, tipo(laboral e inactivo), fecha, 
			hora inicio y hora fin.  
		</p>
		<br>
		<b class="colorp">Parametrización de platos: </b>
		<p>Permite la creación,  modificación, eliminación y búsqueda de los platos que se preparan en el restaurante,
			de cada categoría se registra: identificador, Nombre, Precio y descripción.
		</p>
		<br>
		<b class="colorp">Parametrización de Administradores: </b>
		<p>Permite la creación, modificación y eliminación y búsqueda de administradores de cada administrador se
		registra: Tipo de  documento, número de identificación, nombre, apellidos, sexo, teléfono fijo,  
		teléfono celular, fecha de nacimiento, emaill, dirección, barrió, ciudad, nivel académico y restaurante 
		asociado al que administra</p>
		<br>
		<b class="colorp">Parametrización de categorías: </b>
		<p>Permite la creación, modificación y eliminación y búsqueda de categorías de cada categoría se registra: 
			id, nombre y descripción.
		</p>
		<br>
		<b class="colorp">Registro de ventas:</b>
		<p>Permite el registro de las ventas en el café restaurante se registra: identificación, tipo de pago, 
		cliente, platos correspondiente a la venta y fecha.
		</p>
	</div>
	<br>
	<h2 class="color col-12 d-flex justify-content-center ">Diagrama entidad relacion</h2>
	<br>
	<div  class="col-12 d-flex justify-content-center">
        <img alt="logo" src="../assets/ER.png" class="img">
	</div>
</div>
</template>

<script>
</script>

<style scoped>
.fuente{
	font-size: 24px ;
}
.color{
	color:rgb(0, 183, 255);
}
.colorp{
	color:rgb(162, 135, 235);
}
.justificacion{
	text-align: justify
}
.img {
 max-width: 100%;
 max-height: 100%;
}

</style>
