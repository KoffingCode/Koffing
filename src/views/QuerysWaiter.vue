<template>
	<div class="QuerysWaiter">

		<transition name="fade">
			<div v-if="currentWaiter!=null && currentDataUser!=null" class="WaiterData">
				<div class="card border-dark my-3" >
					<h4 class="card-header">Datos personales:</h4>
					<div class="card-body">
						<div class="row">
							<div class="col-3">
								<strong>Nombre: </strong>
							</div>
							<div class="col-3">
								{{currentWaiter.name}}
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<strong>Apellido: </strong>
							</div>
							<div class="col-3">
								{{currentWaiter.surname}}
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<strong>Documento: </strong>
							</div>
							<div class="col-3">
								{{currentWaiter.document}}
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<strong>Usuario: </strong>
							</div>
							<div class="col-3">
								{{currentDataUser.userName}}
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<strong>Correo: </strong>
							</div>
							<div class="col-3">
								{{currentDataUser.email}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</transition>

		<transition name="fade">
			<div v-if="turns.length>0" >
				<div class="row">
					<div class="col">
						<h4>Turnos asignados:</h4>
					</div>
				</div>
				<div class="col-4 mt-3">
					<input v-model = "filter" class="form-control" type="text" id="filter" placeholder="Fitrar..." >
				</div>
				<div class="contenido table-responsive">
					<table  class="table table-striped table-dark text-center">
						<thead class="header">
							<tr>
								<th scope="col">Tipo</th>
								<th scope="col">Fecha</th>
								<th scope="col">Hora Inicio</th>
								<th scope="col">Hora Fin</th>
								<th scope="col">Opciones</th>
							</tr>
						</thead>
						<transition-group name="list" tag="tbody">
							<tr v-for="(item,ind) of turns.filter(x=>filterData(x,filter))" 
								@mouseover="selection(ind)" name="list" :key="ind">
								
								<td>{{item.type}}</td>
								<td>{{item.date}}</td>
								<td>{{item.startingHour}}</td>
								<td>{{item.endingHour}}</td>

								<td class="anchura">
									<transition name="fade">
									<div v-show="ind == selected">
										<button @click="getTables(item.id,item.date)" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
											Mesas
										</button>
									</div>
									</transition>
								</td>
							</tr>
						</transition-group>
					</table>
				</div>
			</div>
			<div v-else >	
				<div class="row mt-1">
					<div class="col-12 d-flex justify-content-center">
						<div class="spinner-grow my-3" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</transition>

		<Modal idModal="exampleModal" :nameModal="currentDateTurn">
			<template v-slot:contenido >
				<transition name="fade">
					<div v-if="tables.length>0">
						<div class="col-4 mt-3">
							<input v-model = "filter" class="form-control" type="text" id="filter2" placeholder="Fitrar..." >
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
									</tr>
								</thead>
								<transition-group name="list" tag="tbody">
									<tr v-for="(item,ind) of tables.filter(x=>filterData(x,filter))" 
										@mouseover="selection(ind)" name="list" :key="ind">
										<th scope="row">{{item.number}}</th>
										<td>{{item.state}}</td>
										<td>{{item.capacity}}</td>
										<td>{{item.type}}</td>
										<td>{{item.turn_id}}</td>
									</tr>
								</transition-group>
							</table>
						</div>
					</div>
					<div v-else >
						<div class="row mt-1">
							<div class="col-12 d-flex justify-content-center">
								<div class="spinner-grow my-3" role="status">
									<span class="sr-only">Loading...</span>
								</div>
							</div>
						</div>
					</div>
				</transition>
			</template>
			<template v-slot:botones >
			</template>
		</Modal>
	</div>
</template>

<script>
import Facade from '@/utils/Facade';
import Modal from '@/components/Modal.vue'
//import Verificar from '@/components/Verificar.vue';

export default {
	name: 'QuerysWaiter',
	props: {
		docWaiter: String
	},
	components: {
		Modal,
		//Verificar
	},
	created() {
		console.log(this.docWaiter);
		this.getWaiter(this.docWaiter);
		
	},
	data() {
		return {
			currentWaiter: null,
			currentDateTurn: "",
			currentDataUser: null,
			turns: [],
			tables: [],
			filter: "",
			selected: -1
		}
	},
	methods: {
		async getWaiter(id){
			Facade.getDataFromWaiter(
				id,
				response =>{
					this.currentWaiter = response.data;
					if(this.currentWaiter != ""){
						this.getUser(this.currentWaiter.user_id);
						this.getTurns(this.currentWaiter.document);
					}else{
						console.log("No se encontro el waiter");
					}
				},
				error =>{
					console.log(error);
				}
			);
		},
		async getTurns(id){
			Facade.getTurnsFromWaiter(
				id,
				response =>{
					this.turns = response.data;
					console.log(this.turns);
					if(this.turns.length==0){
						this.$swal.fire({
							title: 'Advertencia',
							text: 'No hay turnos para este mesero',
							icon: 'warning',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Ok'
						});
					}
				},
				error =>{
					console.log(error);
				}
			);
		},
		async getUser(id){
			Facade.getUser(
				id,
				response =>{
					console.log(response.data);
					this.currentDataUser = response.data;
				},
				error =>{
					console.log(error);
				}
			);
		},
		getTables(id,dateTurn){
			this.currentDateTurn = `Mesas de turno ${dateTurn}`;
			this.tables= [];
			Facade.getTablesFromTurn(
				id,
				response =>{
					this.tables = response.data;
					console.log(this.tables);
					if(response.data.length == 0){
						this.$swal.fire({
							title: 'Advertencia',
							text: 'No hay mesas para este turno',
							icon: 'warning',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Ok'
						});
					}
				},
				error =>{
					console.log(error);
				}
			);
		},
		viewTable(id){
			console.log(id);
		},
		filterData(x,filter){
			return JSON.stringify(Object.values(x)).toLowerCase().includes(filter.toLowerCase());
		},
		selection(ind){
			this.selected = ind;
		},
	}
}
</script>

<style scoped>


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
	padding: 8px;
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