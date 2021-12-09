<template>
	<div>       
		<NavBar class="container-fluid" :routes="rutasAdmin"/>	
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
			rutasAdmin:[
				{
					"name":"Home",
					"url":{
						path: "/",
						name: 'Home',
						params: {
							test: 'hello there',
							test2: 'dfdf' 
						},
					},
				},
				{
					"name":"Turnos",
					"url":"/admin/turnos"
				},
				{
					"name":"Mesas",
					"url":"/admin/mesas"
				},
				{
					"name":"Consultas",
					"url":{
						patch:"/mesero/consultas",
						name:"Consultas",
						params: {
							docWaiter:"1234"
						}
					}
				},
				{
					"name":"Acerca de ",
					"url":"/admin/acerca"
				}
			],
			rutasMesero:[]
		}
	},
}


// Respecto a la autenticación propongo la siguiente estrategia para cuando empecemos :
// -Asignar al nav las rutas de manera dinamica según el rol que se consulta en el login 
// En las vistas se verifica la cookie de sesion para saber si redirecciona al login o muestra la vista determinaqda
// Cada ves que se verifique qu la cookie aun existe se crea nuevamente para conserver la sesión
// La contraseña se puede cifrar en el frontend o en el backend con Bcript
// Al igual que la verificación de su Hash
</script>

