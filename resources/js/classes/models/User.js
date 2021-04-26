const DEFAULT_DATA = {
	id: null,
	name: '',
	postcode: {},
}

export default class User {
	constructor(user = DEFAULT_DATA) {
		Object.assign(this, user)
	}
}