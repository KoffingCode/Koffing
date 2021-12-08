<template>
	<div class="TurnView">
		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="type" class="col-sm-2 col-form-label">Tipo: </label>
					<div class="col-sm-10">
						<select v-model="data.type" class="form-select" aria-label="Default select example" id="type">
							<option value="laboral">Laboral</option>
							<option value="inactivo">Inactivo</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row mb-3">
					<label for="date" class="col-sm-2 col-form-label">Fecha: </label>
					<div class="col-sm-10">
						<input v-model="data.date" class="form-control" type="date" id="start" name="trip-start"
                            min="2021-12-03" max="2024-12-31">
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="startingHour" class="col-sm-2 col-form-label">Hora de inicio </label>
					<div class="col-sm-10">
                        <input v-model="data.startingHour" class="form-control" type="time" id="appt" name="appt" step="2"
                            min="08:00" max="18:00" required>

					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row mb-3">
					<label for="endingHour" class="col-sm-2 col-form-label">Hora Fin</label>
					<div class="col-sm-10">
						<input v-model="data.endingHour" class="form-control" type="time" id="appt" name="appt" step="2"
                            min="08:00" max="18:00" required>
					</div>
				</div>
			</div>
		</div>

		<Verificar @mouseover="send=false" :errors="errors" :enviado="send"/>

		<div class="row mt-1">
			<div class="col-12 d-flex justify-content-center">
				<div class="mb-3">
					<button @click="sendTurnData" :class="stateButton()">
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
							<th scope="col">Tipo</th>
							<th scope="col">Fecha</th>
							<th scope="col">Hora Incio</th>
							<th scope="col">Hora Fin</th>
							<th scope="col">Opciones</th>
						</tr>
					</thead>
					<transition-group name="list" tag="tbody">
						<tr v-for="(item,ind) of fullData.filter(x=>filterData(x,filter))" 
							@mouseover="selection(ind)" name="list" :key="ind">
							<th scope="row">{{item.id}}</th>
							<td>{{item.type}}</td>
							<td>{{item.date}}</td>
							<td>{{item.startingHour}}</td>
							<td>{{item.endingHour}}</td>

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
//import Verificar from '@/components/Verificar.vue';
import Turn from '@/model/Turn';
import Modal from '@/components/Modal.vue'
import Verificar from '@/components/Verificar.vue';

export default {
	name: "Create",
	components: {
		Modal,
		Verificar
	},
	created() {
		this.getTurnsData();
	},
	data() {
		return {
			fullData: [],
			data: {},
			errors: [],
			filter: "",
			btnText: "",
			send: false,
			selected: -1,
			update: false,
			idToUpdate: "",
			status: ""
		}
	},
	methods:{
		getTurnsData(){
			this.status = "sending";
			this.axios.get(`/turns`).then((response) => {
				console.log(response.data);
				this.fullData = response.data;
				this.status = "finish";
			}).catch((error) => {
				console.log(error);
				this.status = "finish";
			})
		},
		sendTurnData(){
			if(this.check()){
				this.status = "sending";
				let turn = new Turn(this.data);
				console.log(turn);
				this.send = false;

				if(this.update === false){
					this.axios.post(`turn`,turn)
					.then(response => {
						this.okMessage("Turno almacenado correctamente");
						console.log(response.data);
						this.fullData.push(this.data);
						this.data = {};
						this.status = "ok";
					}).catch(error => {
						console.log(error.data);
						this.status = "finish";
					});
				}else{
					this.axios.put(`turn/${this.idToUpdate}`,turn)
					.then(response => {
						this.okMessage("Turno actualizado correctamente");
						this.update = false;
						console.log(response.data);
						let newObj = this.fullData.find(x => x.id == this.idToUpdate);
						let indObj = this.fullData.indexOf(newObj);
						this.fullData[indObj] = Object.assign({}, this.data);
						this.data = {};
						this.status = "ok";
					}).catch(error => {
						console.log(error.data);
						this.status = "finish";
					});
				}
				console.log(this.data);
			}
		},
		deleteRow(id){
			console.log(id);
			this.$swal.fire({
				title: '¿Desea eliminar este Turno?',
				icon: 'question',
				showDenyButton: true,
				confirmButtonText: 'SI',
				denyButtonText: `NO`,
			}).then((result) => {
				if (result.isConfirmed) {
					this.status = "sending";
					this.axios.delete(`turn/${id}`)
					.then(response => {
						console.log(response.data);
						this.fullData.splice(this.fullData.indexOf(this.fullData.find(x=>x.id == id)),1);
						this.status = "finish";
					}).catch(error => {
						console.log(error.data);
						this.status = "finish";
					});
				} else if (result.isDenied) {
					//this.$swal.fire('Changes are not saved', '', 'info')
				}
			})
		},
		check(){
			this.errors = [];
			if(this.data.type == undefined){
				this.errors.push("El tipo de turno es requerido");
			}
			if(this.data.date == undefined){
				this.errors.push("La fecha del turno es requerido");
			}
			if(this.data.startingHour == undefined){
				this.errors.push("La Hora de inicio es requerida");
			}
			if(this.data.endingHour == undefined){
				this.errors.push("La Hora de Fin es requerida");
			}
			if (this.errors.length > 0) {
				return false;
			}
			console.log(this.errors);
			return true;
		
	
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
			return this.update === false ? "Almacenar Turno":"Guardar Cambios";
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