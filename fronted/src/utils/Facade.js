import axios from 'axios'

export default class Facade {

	// Obtener todas las mesas
	static getTablesData(processThen,processCatch){
		axios.get(`/tables`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Almacenar Mesa
	static storeTable(table,processThen,processCatch){
		axios.post(`table`,table).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Actualizar Mesa
	static updateTable(table,id,processThen,processCatch){
		axios.put(`table/${id}`,table).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Eliminar Mesa
	static deleteTable(id,processThen,processCatch){
		axios.put(`table/${id}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Obtener datos del mesero
	static getDataFromWaiter(document,processThen,processCatch){
		axios.get(`querysWaiter/waiter/${document}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Obtener los turnos asignados a un mesero
	static getTurnsFromWaiter(document,processThen,processCatch){
		axios.get(`querysWaiter/turns/${document}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Obtener las mesas que se atienden en cada turno
	static getTablesFromTurn(id,processThen,processCatch){
		axios.get(`querysWaiter/tables/${id}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}
}