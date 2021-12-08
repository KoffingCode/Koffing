export default class Turn {
	constructor(data) {
		this.type = data.type;
		this.date = data.date;
		this.startingHour = data.startingHour;
		this.endingHour = data.endingHour;
	}
}