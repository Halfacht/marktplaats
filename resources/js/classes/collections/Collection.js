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

	byId(id) {

		let item = this.items.find(x => x.id === id);
		console.log('item', item);
		return item;
	}

	keyOfId(id) {
		return this.items.findIndex(x => x.id === id);
	}

	isEmpty() {
		return this.items.length <= 0;
	}
}