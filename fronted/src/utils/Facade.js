import axios from 'axios'

export default class Facade {
	constructor() {
	}

	getTablesData(processThen,processCatch){
		axios.get(`/tables`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	storeTable(table,processThen,processCatch){
		axios.post(`table`,table).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	updateTable(table,id,processThen,processCatch){
		axios.put(`table/${id}`,table).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	deleteTable(id,processThen,processCatch){
		axios.put(`table/${id}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	getWaiters(processThen,processCatch){
		axios.get(`/waiters`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	storeWaiter(waiter,processThen,processCatch){
		axios.post(`/waiters`,waiter).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	updateWaiter(waiter,id,processThen,processCatch) {
		axios.put(`/waiters/${id}`,waiter).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	deleteWaiter(id,processThen,processCatch) {
		axios.delete(`/waiters/${id}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}
}