export default class Usuario {
	constructor(data) {
		this.id = data.id;
		this.nombre = data.nombre;
		this.apellido = data.apellido;
		this.email = data.email;
	}
}