<template>
	<div v-if="user_id === ''">       
		<NavBar class="container-fluid" :route="ruta"/>	
		<div class="container col-6">
			<div class="row mt-3">
				<div class="row mb-3">
					<label for="name" class="col-sm-2 col-form-label">Email: </label>
					<div class="col-sm-10">
						<input v-model="email" type="text" class="form-controle" id="name">
					</div>
				</div>
			</div>

			<div class="row mt-3">
				<div class="row mb-3">
					<label for="surname" class="col-sm-2 col-form-label">Contraseña: </label>
					<div class="col-sm-10">
						<input v-model="password" type="password" class="form-controle" id="surname">
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-12 d-flex justify-content-center">
				<button @click="login" class="btn btn-light">Iniciar sesión</button>
			</div>
		</div>
	</div>
	<div v-else>       
		<div v-if="role === 1">
			<NavBar class="container-fluid" :routes="rutasAdmin"/>	
			<div class="container justify-content-center">
				<router-view/>
			</div>
		</div>
		<div v-else>
			<NavBar class="container-fluid" :routes="rutasMesero"/>	
			<div class="container justify-content-center">
				<router-view/>
			</div>
		</div>
	</div>
</template>

<script>
import NavBar from "./components/NavBar.vue"
import User from '@/model/User.js';
import Facade from '@/utils/Facade';

export default {
	name: "App",
	components: {
		NavBar
	},
	data() {
		return {
			user_id: "",
			email: "",
			username: "",
			password : "",
			role: "",
			waiterDoc: "",
			status: "",
			ruta: "/Usuario/1/edit",
			facade: new Facade(),
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
					"name":"Meseros",
					"url":"/admin/meseros"
				}/*,
				
				}*/
			],
			rutasMesero:[
				{
					"name": "Meseros",
					"url":{
						patch:"/mesero/consultas",
						name:"Consultas",
						params: {
							docWaiter:this.waiterDoc
						}
					}
				}
			]
		}
	},
	methods: {
		check() {
			return true;
		},
		login() {
			if(this.check()){
				this.status = "loging";
				let user = new User(this.username, this.email, this.password, this.role);
				Facade.login(
					user,
					response => {
						this.user_id = response.data.id;
						this.email = response.data.email;
						this.username = response.data.username;
						this.password = response.data.password;
						this.role = response.data.role;
						this.status = "loged";
						console.log(this.user_id, this.email, this.username, this.password, this.role);
						console.log(response.data);
					}, error => {
						console.log(error);
						this.status = "fail";
					}
				);
			}
		}
	}
	
}


// Respecto a la autenticación propongo la siguiente estrategia para cuando empecemos :
// -Asignar al nav las rutas de manera dinamica según el role que se consulta en el login 
// En las vistas se verifica la cookie de sesion para saber si redirecciona al login o muestra la vista determinaqda
// Cada ves que se verifique qu la cookie aun existe se crea nuevamente para conserver la sesión
// La contraseña se puede cifrar en el frontend o en el backend con Bcript
// Al igual que la verificación de su Hash
</script>

