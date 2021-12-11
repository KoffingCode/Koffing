export default class Waiter {
    constructor(data) {
        this.user_id = data.user_id;
        this.name = data.name;
        this.surname = data.surname;
        this.documentType = data.documentType;
        this.document = data.document;
        this.address = data.address;
        this.neighbourhood = data.neighbourhood;
        this.city = data.city;
        this.phone = data.phone;
        this.academicLevel = data.academicLevel;
    }
}