import axios from 'axios'

export default class Facade {
	static getTablesData(processThen,processCatch){
		axios.get(`/tables`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static storeTable(table,processThen,processCatch){
		axios.post(`table`,table).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static updateTable(table,id,processThen,processCatch){
		axios.put(`table/${id}`,table).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static deleteTable(id,processThen,processCatch){
		axios.put(`table/${id}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static getTurnsFromWaiter(document,processThen,processCatch){
		axios.get(`querysWaiter/turns/${document}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}

	static getTablesFromTurn(id,processThen,processCatch){
		axios.get(`querysWaiter/tables/${id}`).then((response) => {
			processThen(response);
		}).catch((error) => {
			processCatch(error);
		})
	}
}