const defaultData = {
	id: null,
	name: '',
	postcode: {},
}

export default class User {
	constructor(user = defaultData) {
		Object.assign(this, user)
	}
}