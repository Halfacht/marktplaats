import moment from "moment";
import Model from "./Model";

export const DEFAULT_DATA = {
	title: '',
	content: '',
	price: 0,
	sort_date: Date.now(),
	user: {},
	category: '',
	category_id: null,
}

export default class Advertisement extends Model {
	constructor(advertisement = DEFAULT_DATA) {
		super(advertisement);
	}

	get momentAgo() {
        return moment(this.created_at).fromNow();
    }

	get createdAt() {
		return moment(this.created_at).format('D MMM YYYY');
	}
}