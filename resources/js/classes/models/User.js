import Model from './Model';

export const DEFAULT_DATA = {
	id: null,
	name: '',
	postcode: {},
}

export default class User extends Model {
	constructor(user = DEFAULT_DATA) {
		super(user);
	}
}