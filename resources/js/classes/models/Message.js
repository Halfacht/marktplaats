import moment from "moment";
import Model from "./Model";
import User from "./User";

export const DEFAULT_DATA = {
	content: '',
	created_at: '',
	receiver: new User(),
	sender: new User(),
}

export default class Message extends Model {
	constructor(message = DEFAULT_DATA) {
		super(message);
	}

	get momentAgo() {
        return moment(this.created_at).fromNow();
    }

	get createdAt() {
		return moment(this.created_at).format('D MMM YYYY - H:i');
	}
}