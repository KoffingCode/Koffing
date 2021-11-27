export default class Usuario {
	constructor(data) {
		this.id = data.id;
		this.number = data.number;
		this.capacity = data.capacity;
		this.state = data.state;
		this.type = data.type;
		this.turn = data.turn;
	}
}