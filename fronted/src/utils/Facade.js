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
		axios.delete(`table/${id}`).then((response) => {
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

	// Obtener datos basicos de cada turno
	static getTurnsFromTable(processThen,processCatch){
		axios.get(`turnos`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}
	// T U R N O S
	// Obtener todos los turnos
	static getTurnsData(processThen,processCatch){
		axios.get(`/turns`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Almacenar Turno
	static storeTurn(turn,processThen,processCatch){
		axios.post(`turn`,turn).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Actualizar Turno
	static updateTurn(turn,id,processThen,processCatch){
		axios.put(`turn/${id}`,turn).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// Eliminar Turno
	static deleteTurn(id,processThen,processCatch){
		axios.delete(`turn/${id}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// M E S E R O S
	static getWaiters(processThen,processCatch){
		axios.get(`/waiters`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static storeWaiter(waiter,processThen,processCatch){
		axios.post(`/waiters`,waiter).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static updateWaiter(waiter,id,processThen,processCatch) {
		axios.put(`/waiters/${id}`,waiter).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static deleteWaiter(id,processThen,processCatch) {
		axios.delete(`/waiters/${id}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	// U S U A R I O S
	static login(user,processThen,processCatch) {
		axios.post(`/user`,user).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static registerUser(user, processThen, processCatch) {
		axios.post(`/users`,user).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}
}