//import Verificar from '@/components/Verificar.vue';
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
		this.getTablesData(),
		this.getTurnsData()
	},
	data() {
		return {
			fullData: [],
			turnsData: [],
			data: {},
			errors: [],
			filter: "",
			btnText: "",
			send: false,
			selected: -1,
			update: false,
			idToUpdate: "",
			apiUrl: "http://127.0.0.1:8000/api/",
			options: {
						headers: {
							'Content-Type': 'application/json'
						}
					}
		}
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
			if(this.check()){
				let table = new Table(this.data);
				this.send = false;

				if(this.update === false){
					this.axios.post(`${this.apiUrl}table`,table,this.options)
					.then(response => {
						this.send = true;
						console.log(response.data);
						this.fullData.push(this.data);
						this.data = {};
					}).catch(error => {
						console.log(error.data);
					});
				}else{
					this.axios.put(`${this.apiUrl}table/${this.idToUpdate}`,table,this.options)
					.then(response => {
						this.send = true;
						this.update = false;
						console.log(response.data);
						let newObj = this.fullData.find(x => x.id == this.idToUpdate);
						let indObj = this.fullData.indexOf(newObj);
						this.fullData[indObj] = Object.assign({}, this.data);
						this.data = {};
					}).catch(error => {
						console.log(error.data);
					});
				}
				console.log(this.data);
			}
		},
		deleteRow(id){
			console.log(id);
			this.$swal.fire({
				title: '¿Desea eliminar este registro?',
				showDenyButton: true,
				confirmButtonText: 'SI',
				denyButtonText: `NO`,
			}).then((result) => {
				if (result.isConfirmed) {
					this.axios.delete(`${this.apiUrl}table/${id}`)
					.then(response => {
						console.log(response.data);
						this.fullData.splice(this.fullData.indexOf(this.fullData.find(x=>x.id == id)),1);
					}).catch(error => {
						console.log(error.data);
					});
				} else if (result.isDenied) {
				this.$swal.fire('Changes are not saved', '', 'info')
				}
			})
		},
		check(){
			this.errors = [];
			
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
			return this.update === false ? "form-control btn btn-primary":"form-control btn btn-success";
		},
		txtButton(){
			return this.update === false ? "Almacenar Mesa":"Guardar Cambios";
		}
	}
}