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
				}
			],
			rutasMesero:[]
		}
	},
}


// Respecto a la autenticación propongo la siguiente estrategia para cuando empecemos :
// -Asignar al nav las rutas de manera dinamica según el rol que se consulta en el login 
// En las vistas se verifica la cookie de sesion para saber si redirecciona al login o muestra la vista determinaqda
// Cada interaccion en la bd se valida desde el backend segun el rol del id que esta en la cookie
</script>

