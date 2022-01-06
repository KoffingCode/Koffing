<template>
	<div class="Create">
		<div class="my-2">
			<label for="server">Nombre:</label>
			<input type="text" class="form-control" id="nombre" v-model = "datos.nombre">
		</div>
		<div class="my-2">
			<label for="apellido">Apellido:</label>
			<input type="text" class="form-control" id="apellido" v-model = "datos.apellido">
		</div>
		<div class="my-2">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" v-model = "datos.email">
		</div>

		<Verificar :errors="errors" :enviado="enviado"/>

		<div class="my-3">
			<button @click = "postRequest" class="form-control btn btn-primary">Registrar</button>
		</div>

		<div class="col-4">
			<input v-model = "filter" class="form-control" type="text" id="filter" placeholder="Fitrar..." >
		</div>

		<Table :filter="filter" :fullData="fullData" @eliminar="eliminar"/>

	</div>

</template>

<script>
import Verificar from '@/components/Verificar.vue';
import Table from '@/components/Table.vue';
import Usuario from '@/model/Usuario';

//import useVuelidate from '@vuelidate/core'
//import { required, email } from '@vuelidate/validators'

export default {
	name: "Create",
	components: {
		Verificar,
		Table
	},
	created() {

		var bcrypt = require('bcryptjs');
		var salt = bcrypt.genSaltSync(10);
		var hash = bcrypt.hashSync("cdcb", salt);
		console.log(hash);

		//this.$router.push('/Usuario/1/edit');

		let ck = require('vue-cookies');
		ck.set("prueba","1484362313","60s");
		console.log(ck.get("prueba"));

		//https://ed.team/blog/que-es-y-como-utilizar-localstorage-y-sessionstorage

		this.getRequest();

	},
	data() {
		return {
			errors: [],
			fullData: [],
			enviado: false,
			nombre: "",
			apellido: "",
			email: "",
			api: "http://127.0.0.1:8000/api/usuario",
			idUser: this.$route.params.id,
			usuario: Object(),
			datos: {},
			filter: ""
		};
	},
	methods:{
		postRequest(){
			let usuario = new Usuario(this.datos);
			console.log(usuario);
			if(this.check()){
				this.enviado = false;
				const options = {
					headers: {
						'Content-Type': 'application/json'
					}
				};
				this.axios.post(this.api,usuario,options)
				.then(response => {
					this.enviado = true;
					console.log(response.data);
				}).catch(error => {
					console.log(error.data);
				});
			}
		},
		getRequest(){
			this.axios.get(`${this.api}`).then((response) => {
				console.log(response.data);
				this.fullData = response.data;
				this.$swal.fire(
					'Good job!',
					'You clicked the button!',
					'success'
				);
			}).catch((error) => {
				console.log(error)
			})
		},
		check(){
			this.errors = [];
			
			if(this.datos.nombre == undefined){
				this.errors.push("El nombre es requerido");
			}
			if(this.datos.apellido == undefined){
				this.errors.push("El apellido es requerido");
			}
			if(this.datos.email == undefined){
				this.errors.push("El email es requerido");
			}
			if (this.errors.length > 0) {
				return false;
			}
			console.log(this.errors);
			return true;
		},
		eliminar(x){
			console.log(x);
		}
	}
}
</script>

