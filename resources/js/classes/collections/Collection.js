export default class Collection {
	constructor(items = []) {
		this.items = items;
	}

	add(item) {
		this.items.push(item);
	}

	update(id, item) {
		this.items[this.keyOfId(id)] = item;
	}

	delete(id) {	
		this.items.splice(this.keyOfId(id), 1);
	}

	byId(id) {
		return this.items.find(x => x.id === id);
	}

	keyOfId(id) {
		return this.items.findIndex(x => x.id === id);
	}

	isEmpty() {
		return this.items.length <= 0;
	}
}