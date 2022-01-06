<template>
	<div class="TableView">
		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="name" class="col-sm-2 col-form-label">Nombres: </label>
					<div class="col-sm-10">
						<input @click="setName" v-model="data.name" type="text" class="form-control" id="name">
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="row mb-3">
					<label for="surname" class="col-sm-2 col-form-label">Apellidos: </label>
					<div class="col-sm-10">
						<input @click="setSurname" v-model="data.surname" type="text" class="form-control" id="surname">
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-6">
				<div class="row">
					<label for="documentType" class="col-sm-2 col-form-label">Tipo de documento: </label>
					<div class="col-sm-10">
						<select v-model="data.documentType" class="form-select" aria-label="Default select example" id="documentType" >
							<option value="C.C">C.C.</option>
							<option value="T.I">T.I.</option>
							<option value="C.E">C.E.</option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="row">
					<label for="document" class="col-sm-2 col-form-label">Documento: </label>
					<div class="col-sm-10">
						<input @click="setDocument" v-model="data.document" type="text" class="form-control" id="document">
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="address" class="col-sm-2 col-form-label">Dirección: </label>
					<div class="col-sm-10">
						<input @click="setAddress" v-model="data.address" type="text" class="form-control" id="address">
					</div>
				</div>
			</div>

            <div class="col-6">
				<div class="row mb-3">
					<label for="neighbourhood" class="col-sm-2 col-form-label">Barrio: </label>
					<div class="col-sm-10">
						<input @click="setNeighbourhood" v-model="data.neighbourhood" type="text" class="form-control" id="neighbourhood">
					</div>
				</div>
			</div>
		</div>

        <div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="city" class="col-sm-2 col-form-label">Ciudad: </label>
					<div class="col-sm-10">
						<input @click="setCity" v-model="data.city" type="text" class="form-control" id="city">
					</div>
				</div>
			</div>

            <div class="col-6">
				<div class="row mb-3">
					<label for="phone" class="col-sm-2 col-form-label">Teléfono: </label>
					<div class="col-sm-10">
						<input @click="setPhone" v-model="data.phone" type="text" class="form-control" id="phone">
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-3">
            <div class="col-6">
				<div class="row mb-1">
					<label for="academicLevel" class="col-sm-2 col-form-label">Nivel académico: </label>
					<div class="col-sm-10">
						<input @click="setAcademicLevel" v-model="data.academicLevel" type="text" class="form-control" id="academicLevel">
					</div>
				</div>
			</div>
		</div>

		<Verificar @mouseover="send=false" :errors="errors" :enviado="send"/>

		<div class="row mt-1">
			<div class="col-12 d-flex justify-content-center">
				<div class="mb-3">
					<button @click="registerWaiterUser" :class="stateButton()">
						{{txtButton()}} 
						<i class="bi bi-save2-fill"></i>
					</button>
					<button v-if="update" @click="cancelUpdate" class="btn btn-danger px-5 mx-2">
						Cancelar Actualización 
						<i class="bi bi-x-square-fill"></i>
					</button>
				</div>
			</div>
		</div>

		<transition name="fade">	
		<div v-if="status=='sending'" class="row mt-1">
			<div class="col-12 d-flex justify-content-center">
				<div class="spinner-grow my-3" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
		</transition>

		<transition name="fade">
		<div v-if="update==false && fullData.length>0">
			<div class="col-4 mt-3">
				<input v-model = "filter" class="form-control" type="text" id="filter" placeholder="Fitrar..." >
			</div>
			<div class="contenido table-responsive">
				<table  class="table table-striped table-dark text-center">
					<thead class="header">
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nombres</th>
							<th scope="col">Apellidos</th>
							<th scope="col">Tipo Documento</th>
							<th scope="col">Documento</th>
							<th scope="col">Dirección</th>
							<th scope="col">Barrio</th>
							<th scope="col">Ciudad</th>
							<th scope="col">Teléfono</th>
							<th scope="col">Nivel Académico</th>
							<th scope="col">User_Id</th>
							<th scope="col">Opciones</th>
						</tr>
					</thead>
					<transition-group name="list" tag="tbody">
						<tr v-for="(item,ind) of fullData.filter(x=>filterData(x,filter))" 
							@mouseover="selection(ind)" name="list" :key="ind">
							
							<th scope="row">{{item.id}}</th>
							<td>{{item.name}}</td>
							<td>{{item.surname}}</td>
							<td>{{item.documentType}}</td>
							<td>{{item.document}}</td>
							<td>{{item.address}}</td>
							<td>{{item.neighbourhood}}</td>
							<td>{{item.city}}</td>
							<td>{{item.phone}}</td>
							<td>{{item.academicLevel}}</td>
							<td>{{item.user_id}}</td>

							<td class="anchura">
								<transition name="fade">
								<div v-show="ind == selected">
									<button @click="updateRow(item)" class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil-square"></i></button>
									<button @click="deleteRow(item.id, item.user_id)" class="btn btn-danger btn-sm mx-1"><i class="bi bi-trash-fill"></i></button>
								</div>
								</transition>
							</td>
						</tr>
					</transition-group>
				</table>
			</div>
		</div>
		</transition>

		<Modal idModal="exampleModal">
			<template v-slot:contenido >
				CONTENIDO DEL MODAL
			</template>
			<template v-slot:botones >
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</template>
		</Modal>
	</div>

</template>

<script>

import Facade from '@/utils/Facade';
import User from '@/model/User';
import Waiter from '@/model/Waiter';
import Modal from '@/components/Modal.vue'
import Verificar from '@/components/Verificar.vue';
//import CookieControl from '@/utils/CookieControl.js';

export default {
	name: "AdminWaiters",
	components: {
		Modal,
		Verificar
	},
	created() {
		//CookieControl.checkAdminCookieIsActive(this.getWaiters);
	},
	data() {
		return {
			fullData: [],
			turnsData: [],
			data: {},
			errors: [],
			numbersTables: [],
			filter: "",
			btnText: "",
			send: false,
			selected: -1,
			update: false,
			idToUpdate: "",
			status: "",
			facade: new Facade(),
			bcrypt: require('bcryptjs'),
			ck: require('vue-cookies')
		}
	},
	methods:{
		getWaiters(){
			this.status = "retrieving";
			Facade.getWaiters(
				response => {
					//console.log(response.data);
					this.fullData = response.data;
					this.status = "finish";
				},
				error => {
					console.log(error);
					this.status = "finish";
				}
			)
		},
		sendWaiterData(){
			if(this.check()){
				this.status = "sending";
				//this.data.user_id = 1;
				let waiter = new Waiter(this.data);
				this.send = false;

				if(this.update === false){
					Facade.storeWaiter(
						waiter,
						response => {
							this.okMessage("Mesero almacenado correctamente");
							console.log("MESERO",response.data);
							this.fullData.push(response.data);
							this.data = {};
							this.status = "ok";
						},
						error => {
							console.log(error.data);
							this.status = "finish";
						}
					);
				} else {
					Facade.updateWaiter(
						waiter,
						this.idToUpdate,
						response => {
							this.okMessage("Mesero actualizado correctamente");
							this.update = false;
							console.log(response.data);
							let newObj = this.fullData.find(x => x.id == this.idToUpdate);
							let indObj = this.fullData.indexOf(newObj);
							this.fullData[indObj] = Object.assign({}, this.data);
							this.data = {};
							this.status = "ok";
						},
						error => {
							console.log(error.data);
							this.status = "finish";
						}
					);
				}
			}
		},
		registerWaiterUser() {
			if(this.update === false){	
				var hash = this.bcrypt.hashSync("12345");
				let user = new User(`${this.data.name}.${this.data.document}`,
								`${this.data.name.split(" ")[0].toLowerCase()}.${this.data.document}@koffing.com`,
								hash,
								2);

				Facade.registerUser(
					user,
					response => {
						console.log("Usuario registrado exitosamente")
						console.log(response.data);
						this.data.user_id = response.data.id;
						console.log("USER_ID",this.data.user_id);
						this.sendWaiterData();
					},
					error => {
						console.log(error.data);
						console.log(this.data.user_id);
						this.status = "finish";
					}
				);
			}
			else {
				let waiter = new Waiter(this.data);
				Facade.updateWaiter(
					waiter,
					this.idToUpdate,
					response => {
						this.okMessage("Mesero actualizado correctamente");
						this.update = false;
						console.log(response.data);
						let newObj = this.fullData.find(x => x.id == this.idToUpdate);
						let indObj = this.fullData.indexOf(newObj);
						this.fullData[indObj] = Object.assign({}, this.data);
						this.data = {};
						this.status = "ok";
					},
					error => {
						console.log(error.data);
						this.status = "finish";
					}
				);
			}
		},
		deleteRow(id, user_id){
			console.log("ids a eliminar", id, user_id);
			this.$swal.fire({
				title: '¿Desea eliminar este mesero?',
				icon: 'question',
				showDenyButton: true,
				confirmButtonText: 'SI',
				denyButtonText: `NO`,
			}).then((result) => {
				if (result.isConfirmed) {
					this.status = "deleting";
					Facade.deleteWaiter(
						id,
						response => {
							console.log("mesero eliminado",response.data);
							this.fullData.splice(this.fullData.indexOf(this.fullData.find(x=>x.id == id)),1);
							this.status = "finish";
							Facade.deleteUser(
								user_id,
								response => {
									console.log("RESPONSE");
									console.log(user_id, response.data);
									this.status = "finish";
								},
								error => {
									console.log(error.data);
									this.status = "finish";
								}
							);
						},
						error => {
							console.log(error.data);
							this.status = "finish";
						}
					);
				} else if (result.isDenied) {
					//this.$swal.fire('Changes are not saved', '', 'info')
				}
			})
		},
		check(){
			this.errors = [];
			if(this.data.name == undefined || this.data.name == "") {
				this.errors.push("El nombre es requerido");
			}
			if(this.data.surname == undefined || this.data.surname == "") {
				this.errors.push("El apellido es requerido");
			}
			if(this.data.documentType == undefined || this.data.documentType == "") {
				this.errors.push("El tipo de documento es requerido");
			}
			if(this.data.document == undefined || this.data.document == "") {
				this.errors.push("El documento es requerido");
			}
			if(this.data.address == undefined || this.data.address == "") {
				this.errors.push("La dirección es requerida");
			}
			if(this.data.neighbourhood == undefined || this.data.neighbourhood == "") {
				this.erros.push("El barrio es requerido");
			}
			if(this.data.city == undefined || this.data.city == "") {
				this.errors.push("La ciudad es requerida");
			}
			if(this.data.phone == undefined || this.data.phone === "") {
				this.errors.push("El teléfono es requerido");
			}
			if(this.data.academicLevel == undefined || this.data.academicLevel === "") {
				this.errors.push("El nivel académico es requerido");
			}
			if (this.errors.length > 0) {
				return false;
			}
			console.log(this.errors);
			return true;
		},
		setName() {
			console.log(this.data);
		},
		okMessage(text) {
			this.$swal.fire({
				position: 'center',
				icon: 'success',
				title: text,
				showConfirmButton: false,
				timer: 1500
			});
		},
		checkNumber(number){
			console.log(number);
			if(parseInt(number) <= 0){
				this.data.capacity = 1;
			}
		},
		updateRow(item){
			this.data = Object.assign({}, item);
			this.update = true;
			this.idToUpdate = item.id;
		},
		cancelUpdate(){
			this.update = false;
			this.data = {};
		},
		filterData(x,filter){
			return JSON.stringify(Object.values(x)).toLowerCase().includes(filter.toLowerCase());
		},
		selection(ind){
			this.selected = ind;
		},
		stateButton(){
			return this.update === false ? "btn btn-primary px-5":"btn btn-success px-5 mx-2";
		},
		txtButton(){
			return this.update === false ? "Registrar Mesero":"Guardar Cambios";
		}
	}
}
</script>


<style scoped>

.anchura {
	width: 150px;
}

.contenido{
	height: 300px;
	overflow-y: auto;
}

.header{
	position:sticky;
	top: 0;
	background-color: rgba(19, 24, 27, 0.8) !important;
	color:white;
}

td{
	padding: 5px;
}


.fade-enter-active,
.fade-leave-active {
	transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
	opacity: 0;
}

.table-dark {
	--bs-table-bg: rgba(19, 24, 27, 0.8);
}

.list-enter-active, .list-leave-active {
	transition: all 1s;
}
.list-enter, .list-leave-to{
	opacity: 0;
	transform: translateX(30px);
}
.list-move {
	transition: transform 1s;
}
</style>