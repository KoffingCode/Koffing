<template>
	<div class="TableView">
		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="number" class="col-sm-2 col-form-label">Número: </label>
					<div class="col-sm-10">
						<input v-model="data.number" type="number" class="form-control" id="number">
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
						<input v-model="data.capacity" type="number" class="form-control" id="capacity">
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
						<select v-model="data.turn" class="form-select" aria-label="Default select example" id="type">
							<option value="1">...</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-12">
				<div class="mb-3">
					<button @click="sendTableData" :class="stateButton()">{{txtButton()}}</button>
				</div>
			</div>
		</div>


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
							<div v-show="ind == selected">
								<button class="btn btn-info btn-sm mx-1">V</button>
								<button @click="updateRow(item)" class="btn btn-warning btn-sm mx-1">M</button>
								<button @click="deleteRow(item.id)" class="btn btn-danger btn-sm mx-1">E</button>
							</div>
						</td>
					</tr>
				</transition-group>
			</table>
		</div>

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
//import Verificar from '@/components/Verificar.vue';
//import Table from '@/model/Table';
import Modal from '@/components/Modal.vue'

export default {
	name: "Create",
	components: {
		Modal
	},
	created() {
		this.getTablesData(),
		this.getTurnsData()
	},
	data() {
		return {
			fullData: [],
			turnsData: [],
			data: {},
			filter: "",
			btnText: "Registrar",
			send: false,
			selected: -1,
			update: false,
			apiUrl: "http://127.0.0.1:8000/api/"
		};
	},
	methods:{
		getTablesData(){
			this.axios.get(`${this.apiUrl}tables`).then((response) => {
				console.log(response.data);
				this.fullData = response.data;
			}).catch((error) => {
				console.log(error)
			})
		},
		getTurnsData(){

		},
		sendTableData(){

			if(this.update === false){
				this.$swal.fire(
					'Good job!',
					'You clicked the button!',
					'success'
				);
			}else{
				this.update = false;
			}
			console.log(this.data);
		},
		filterData(x,filter){
			return JSON.stringify(Object.values(x)).toLowerCase().includes(filter.toLowerCase());
		},
		selection(ind){
			this.selected = ind;
		},
		deleteRow(id){
			console.log(id);
			this.$swal.fire({
				title: '¿Desea eliminar este registro?',
				showDenyButton: true,
				confirmButtonText: 'SI',
				denyButtonText: `NO`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
				this.$swal.fire('Saved!', '', 'success')
				} else if (result.isDenied) {
				this.$swal.fire('Changes are not saved', '', 'info')
				}
			})
		},
		updateRow(item){
			//this.data.type = "Estandar";
			this.data = item;
			console.log(item);
			this.update = true;
		},
		check(){

		},
		stateButton(){
			return this.update === false ? "form-control btn btn-primary":"form-control btn btn-success";
		},
		txtButton(){
			return this.update === false ? "Registrar":"Actualizar";
		}
	}
}
</script>


<style scoped>

.anchura {
	width: 150px;
}

.contenido{
	height: 30em;
	overflow-y: auto;
}

.header{
	position:sticky;
	top: 0;
	background-color: rgba(19, 24, 27, 0.8) !important;
	color:white;
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