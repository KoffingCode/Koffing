<template>

	<div class="container-fluid ">      
		<NavBar class="container-fluid" :routes="rutasAdmin"/>	
		<div class="container justify-content-center">
			<router-view/>
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
			user_id: "1",
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
        width: 30%;
    }

</style>