export default class Turn {
	constructor(data) {
		this.id_mesero = data.id_mesero;
		this.type = data.type;
		this.date = data.date;
		this.startingHour = data.startingHour;
		this.endingHour = data.endingHour;
	}
}