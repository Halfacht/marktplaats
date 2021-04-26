import moment from "moment";

const defaultData = {
	title: '',
	content: '',
	price: 0,
	sort_date: Date.now(),
	user: {},
	category: ''
}

export default class Advertisement {
	constructor(advertisement = defaultData) {
		Object.assign(this, advertisement)
	}

	get momentAgo() {
        return moment(this.created_at).fromNow();
    }
}