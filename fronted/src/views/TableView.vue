<template>
	<div class="TableView">
		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="number" class="col-sm-2 col-form-label">Número: </label>
					<div class="col-sm-10">
						<input @click="setNumberTable" v-model="data.number" type="number" class="form-control" id="number">
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="row mb-3">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Estado: </label>
					<div class="col-sm-10">
						<select v-model="data.state" class="form-select" aria-label="Default select example" id="inputEmail3">
							<option value="free">Disponible</option>
							<option value="reserved">Reservada</option>
							<option value="occupied">Ocupada</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="capacity" class="col-sm-2 col-form-label">Capacidad: </label>
					<div class="col-sm-10">
						<input @input="data.capacity = parseInt(data.capacity) <= 1 ? 2 : data.capacity" 
						v-model="data.capacity" type="number" class="form-control" id="capacity">
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="row mb-3">
					<label for="type" class="col-sm-2 col-form-label">Tipo: </label>
					<div class="col-sm-10">
						<select v-model="data.type" class="form-select" aria-label="Default select example" id="type" >
							<option value="estandar">Estandar</option>
							<option value="barra">Barra</option>
							<option value="exterior">Exterior</option>
							<option value="infantil">Infantil</option>
							<option value="familiar">Familiar</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="type" class="col-sm-2 col-form-label">Turno: </label>
					<div class="col-sm-10">
						<select v-model="data.turn_id" class="form-select" aria-label="Default select example" id="type">
							<option v-for="(item,k) in turnsData" :key="k" :value="item.id">
								{{item.label}}
							</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<Verificar @mouseover="send=false" :errors="errors" :enviado="send"/>

		<div class="row mt-1">
			<div class="col-12 d-flex justify-content-center">
				<div class="mb-3">
					<button @click="sendTableData" :class="stateButton()">
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
							<th scope="col">#</th>
							<th scope="col">Estado</th>
							<th scope="col">Capacidad</th>
							<th scope="col">Tipo</th>
							<th scope="col">Turno</th>
							<th scope="col">Opciones</th>
						</tr>
					</thead>
					<transition-group name="list" tag="tbody">
						<tr v-for="(item,ind) of fullData.filter(x=>filterData(x,filter))" 
							@mouseover="selection(ind)" name="list" :key="ind">
							
							<th scope="row">{{item.number}}</th>
							<td>{{item.state}}</td>
							<td>{{item.capacity}}</td>
							<td>{{item.type}}</td>
							<td>{{item.turn_id}}</td>

							<td class="anchura">
								<transition name="fade">
								<div v-show="ind == selected">
									<button @click="updateRow(item)" class="btn btn-warning btn-sm mx-1"><i class="bi bi-pencil-square"></i></button>
									<button @click="deleteRow(item.id)" class="btn btn-danger btn-sm mx-1"><i class="bi bi-trash-fill"></i></button>
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
import Table from '@/model/Table';
import Modal from '@/components/Modal.vue'
import Verificar from '@/components/Verificar.vue';

export default {
	name: "Create",
	components: {
		Modal,
		Verificar
	},
	created() {
		this.getTablesData();
		this.getTurnsData();
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
			facade: new Facade()
		}
	},
	methods:{
		getTablesData(){
			this.status = "sending";
			this.facade.getTablesData(
				response =>{
					console.log(response.data);
					this.fullData = response.data;
					this.status = "finish";
				},
				error =>{
					console.log(error);
					this.status = "finish";
				}
			)
		},
		getTurnsData(){


			this.turnsData = [
				{
					id:1,
					label: "Fecha - Inicio - Fin"
				},
				{
					id:2,
					label: "Fecha - Inicio - Fin"
				}
			]
		},
		sendTableData(){
			if(this.check()){
				this.status = "sending";
				let table = new Table(this.data);
				this.send = false;

				if(this.update === false){
					this.facade.storeTable(
						table,
						response =>{
							this.okMessage("Mesa almacenada correctamente");
							console.log(response.data);
							this.fullData.push(this.data);
							this.data = {};
							this.status = "ok";
						},
						error =>{
							console.log(error.data);
							this.status = "finish";
						}
					);
				}else{
					this.facade.updateTable(
						table,
						this.idToUpdate,
						response =>{
							this.okMessage("Mesa actualizada correctamente");
							this.update = false;
							console.log(response.data);
							let newObj = this.fullData.find(x => x.id == this.idToUpdate);
							let indObj = this.fullData.indexOf(newObj);
							this.fullData[indObj] = Object.assign({}, this.data);
							this.data = {};
							this.status = "ok";
						},
						error =>{
							console.log(error.data);
							this.status = "finish";
						}
					);
				}
			}
		},
		deleteRow(id){
			console.log(id);
			this.$swal.fire({
				title: '¿Desea eliminar este registro?',
				icon: 'question',
				showDenyButton: true,
				confirmButtonText: 'SI',
				denyButtonText: `NO`,
			}).then((result) => {
				if (result.isConfirmed) {
					this.status = "sending";
					this.facade.deleteTable(
						id,
						response =>{
							console.log(response.data);
							this.fullData.splice(this.fullData.indexOf(this.fullData.find(x=>x.id == id)),1);
							this.status = "finish";
						},
						error =>{
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
			if(this.numbersTables.includes(this.data.number) && this.update === false){
				this.errors.push("Esta mesa ya se ha almacenado antes");
			}
			if(this.data.number == undefined || this.data.number === ""){
				this.errors.push("El numero de mesa requerido");
			}
			if(this.data.state == undefined){
				this.errors.push("El estado de la mesa requerido");
			}
			if(this.data.capacity == undefined || this.data.capacity === ""){
				this.errors.push("El tamaño de la mesa requerido");
			}
			if(this.data.type == undefined){
				this.errors.push("El tipo de mesa requerido");
			}
			if(this.data.turn_id == undefined){
				this.errors.push("El turno en que se atiende la mesa es requerido");
			}
			if (this.errors.length > 0) {
				return false;
			}
			console.log(this.errors);
			return true;
		},
		setNumberTable(){
			let max = 1;
			this.fullData .forEach(item =>{
				this.numbersTables.push(parseInt(item.number));
			});
			this.numbersTables.forEach(item =>{
				if(item>max){
					max = item;
				}
			});
			this.data.number = max + 1;
		},
		okMessage(text){
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
			return this.update === false ? "Almacenar Mesa":"Guardar Cambios";
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