export const DEFAULT_DATA = {
	current_page: 1,
	last_page: null,
	per_page: 10,
}

export default class Paginator {
	constructor(data = DEFAULT_DATA) {
		let acc = {}
		for (const property in DEFAULT_DATA) {
			acc[property] = data[property];
		}

		Object.assign(this, acc);
	}

	get queryString() {
		return `page=${this.current_page}&per_page=${this.per_page}`; 
	}
}