
export const DEFAULT_DATA = {
	current_page: 1,
	last_page: null,
	per_page: 10,
}

export default class Paginator {
	constructor(data = DEFAULT_DATA) {		
		this.update(data);		
	}

	update(data) {
		for (const property in DEFAULT_DATA) {
			this[property] = data[property];
		}
	}

	queryString(page = this.current_page) {
		return `page=${page}&per_page=${this.per_page}`; 
	}

	hasNext() {
		return this.last_page > this.current_page;
	}

	hasPrevious() {
		return this.current_page > 1;
	}

	next() {
		if (this.hasNext()) {
			this.current_page++;
		}
	}

	previous() {
		if (this.hasPrevious()) {
			this.current_page--;
		}
	}
}