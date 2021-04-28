export default class Model {
	constructor(object) {
		Object.assign(this, object)
	}

	exists() {
		return !!this.id;
	}

	hasId(id) {
		if (typeof id === 'string') {
            id = parseInt(id)
        }
		
		return this.id === id;
	}
}