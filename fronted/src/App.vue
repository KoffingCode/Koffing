<template>
	<div v-if="!adminCookieIsActive() && !waiterCookieIsActive()">       
		<NavBar class="container-fluid" :route="ruta"/>	
		<div class="container ">
			<div  class="col-12 mt-5 d-flex justify-content-center">
				<img alt="logo" src="./assets/logo2.png">
			</div>
            <div class="row mt-3">
                <div class="col d-flex justify-content-center">
                    <label for="name" class="col-sm-2 col-form-label">Email: </label>
                    <input v-model="email" type="text" id="name">
                </div>
            </div>
            <div class="row mt-3 ">
                <div class="col d-flex justify-content-center">
                    <label for="surname" class="col-sm-2 col-form-label">Contraseña: </label>
                    <input v-model="password" type="password" id="surname">
                </div>
            </div>
        </div>
		<div class="row mt-3">
			<div class="col-12 d-flex justify-content-center">
				<button @click="login" class="btn btn-primary">Iniciar sesión</button>
			</div>
		</div>
	</div>
	<div v-else>       
		<div v-if="adminCookieIsActive()">
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
			bcrypt: require('bcryptjs'),
			ck: require('vue-cookies'),
			rutasAdmin:[
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
				}
			],
			rutasMesero:[]
		}
	},
	methods: {
		check() {
			return true;
		},
		login() {
			//let a = this.bcrypt.hashSync("123");
			//console.log(a);
			if(this.check()){
				this.status = "loging";
				let passwordHash = this.bcrypt.hashSync(this.password);
				let user = new User(this.username, this.email, passwordHash, this.role);
				Facade.login(
					user,
					response => {
						//console.log(response.data.password, passwordHash);
						this.bcrypt.compare(this.password, response.data.password).then(res => {
							if (res) {
								console.log("login correcto");
								this.user_id = response.data.id;
								this.email = response.data.email;
								this.username = response.data.username;
								this.password = "";
								this.role = response.data.role;
								this.status = "loged";
								if (this.role === "admin") {
									this.createCookie("admin_session", this.username, this.email);
								}
								else {
									this.rutasMesero = [
										{
											"name":"Consultas",
											"url":{
												patch:"/mesero/consultas",
												name:"Consultas",
												params: {
													docWaiter:this.user_id
												}
											}
										}
									]
									this.createCookie("waiter_session", this.username, this.email);
								}
								this.$router.push('/');
							}
							else {
								this.$swal.fire({
									position: 'center',
									icon: 'error',
									title: "Email o contraseña incorrectos",
									showConfirmButton: false,
									timer: 1500
								});
							}
						});
					}, error => {
						console.log(error);
						this.status = "fail";
					}
				);
			}
		},
		createCookie(role, data1, data2) {
			let hash = this.bcrypt.hashSync(data1+data2);
			this.ck.set(role,hash,60*15);
		},
		adminCookieIsActive() {
			return (this.ck.isKey("admin_session") ? true : false);
		},
		waiterCookieIsActive() {
			return (this.ck.isKey("waiter_session") ? true : false);
		},
	}
	
}


// Respecto a la autenticación propongo la siguiente estrategia para cuando empecemos :
// -Asignar al nav las rutas de manera dinamica según el role que se consulta en el login 
// En las vistas se verifica la cookie de sesion para saber si redirecciona al login o muestra la vista determinaqda
// Cada ves que se verifique qu la cookie aun existe se crea nuevamente para conserver la sesión
// La contraseña se puede cifrar en el frontend o en el backend con Bcript
// Al igual que la verificación de su Hash
</script>

<style scoped>
    input#name, input#surname{
        width: 40%;
    }

</style>