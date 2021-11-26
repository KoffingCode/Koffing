<template>
	<div>       
		<NavBar class="container-fluid" :routes="rutas"/>	
		<div class="container justify-content-center">
			<router-view/>
		</div>
	</div>
</template>

<script>
import NavBar from "./components/NavBar.vue"

export default {
	name: "App",
	components: {
		NavBar
	},
	data() {
		return {
			ruta: "/Usuario/1/edit",
			rutas:[
				{
					"name":"Home",
					"url":"/"
				},
				{
					"name":"Actualizar",
					"url":"/Usuario/1/edit"
				},
				{
					"name":"Crear",
					"url":"/Usuario/Create"
				}
			]
		}
	},
}


// Respecto a la autenticación propongo la siguiente estrategia para cuando empecemos :
// -Asignar al nav las rutas de manera dinamica según el rol que se consulta en el login 
// En las vistas se verifica la cookie de sesion para saber si redirecciona al login o muestra la vista determinaqda
// Cada interaccion en la bd se valida desde el backend segun el rol del id que esta en la cookie
</script>

