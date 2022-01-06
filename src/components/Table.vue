<template>
	<div class="contenido table-responsive">
		<table  class="table table-striped table-dark text-center">
			<thead class="header">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Email</th>
					<th scope="col">Opciones</th>
				</tr>
			</thead>
			<transition-group name="list" tag="tbody">
				<tr v-for="(item,ind) of fullData.filter(x=>filtrar(x,filter))" @mouseover="selection(ind)" name="list" :key="ind">
					<th scope="row">{{item.id}}</th>
					<td>{{item.nombre}}</td>
					<td>{{item.apellido}}</td>
					<td>{{item.email}}</td>
					<td class="anchura">
						<div v-show="ind == selected">
							<button class="btn btn-info btn-sm mx-1">V</button>
							<button class="btn btn-warning btn-sm mx-1">M</button>
							<button @click="eliminar(item)" class="btn btn-danger btn-sm mx-1">E</button>
						</div>
					</td>
				</tr>
			</transition-group>
		</table>
	</div>
</template>

<script>
export default {
	name: 'Table',
	props: {
		fullData:Array,
		filter:String
	},
	emits: ['eliminar'],
	data(){
		return {
			selected: -1
		}
	},
	methods: {
		filtrar(x,filter){
			return JSON.stringify(Object.values(x)).toLowerCase().includes(filter.toLowerCase());
		},
		selection(ind){
			this.selected = ind;
		},
		eliminar(x){
			this.$emit('eliminar',x);
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