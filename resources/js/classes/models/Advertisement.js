import moment from "moment";

export const DEFAULT_DATA = {
	title: '',
	content: '',
	price: 0,
	sort_date: Date.now(),
	user: {},
	category: '',
	category_id: null,
}

export default class Advertisement {
	constructor(advertisement = DEFAULT_DATA) {
		Object.assign(this, advertisement)
	}

	get momentAgo() {
        return moment(this.created_at).fromNow();
    }

	get createdAt() {
		return moment(this.created_at).format('D MMM YYYY');
	}
}