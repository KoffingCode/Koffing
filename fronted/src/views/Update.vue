<template>
	<div class="Update">
		<div class="form-group row">
			<div class="col">
				<label for="server">Nombre:</label>
				<input type="text" class="form-control" id="nombre" v-model = "nombre">
			</div>
		</div>
		<div class="form-group row">
			<div class="col">
				<label for="apellido">Apellido:</label>
				<input type="text" class="form-control" id="apellido" v-model = "apellido">
			</div>
		</div>
		<div class="form-group row">
			<div class="col">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email" v-model = "email">
			</div>
		</div>

		<Verificar :errors="errors" :enviado="enviado"/>

		<div class="form-group row">
			<div class="col">
				<button @click = "putRequest" class="form-control btn btn-primary">Registrar</button>
			</div>
		</div>
	</div>
</template>

<script>
import Verificar from '@/components/Verificar.vue';
import Usuario from '../model/Usuario';

export default {
	name: "Update",
	components: {
		Verificar
	},
	created() {
		this.getRequest();
	},
	data() {
		return {
			errors: [],
			enviado: false,
			nombre: "",
			apellido: "",
			email: "",
			api: "http://127.0.0.1:8000/api/usuario",
			idUser: this.$route.params.id,
		};
	},
	methods:{
		putRequest(){
			let data = {
				nombre: this.nombre,
				apellido: this.apellido,
				email: this.email
			};

			if(this.check()){
				this.enviado = false;
				const options = {
					headers: {
						'Content-Type': 'application/json'
					}
				};
				this.axios.put(`${this.api}/${this.idUser}`,data,options)
				.then(response => {
					this.enviado = true;
					console.log(response.data);
				}).catch(error => {
					console.log(error.data);
				});
			}
		},
		getRequest(){
			

			this.axios.get(`${this.api}/${this.idUser}`).then((response) => {
				console.log(response.data);
				new Usuario(response.data);
				this.nombre = response.data.nombre;
				this.apellido = response.data.apellido;
				this.email = response.data.email;
			}).catch((error) => {
				console.log(error)
			})
		},
		check(){
			this.errors = [];
			if(this.nombre == ""){
				this.errors.push("El nombre es requerido");
			}
			if(this.apellido == ""){
				this.errors.push("El apellido es requerido");
			}
			if(this.email == ""){
				this.errors.push("El email es requerido");
			}
			if (this.errors.length > 0) {
				return false;
			}
			return true;
		}
	}
}
</script>
