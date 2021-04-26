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

	delete() {
		delete this.items[this.keyOfId(id)];
	}

	keyOfId(id) {
		return this.items.findIndex(x => x.id === id);
	}
}