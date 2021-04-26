import Errors from "./Errors.js";
import store from "../../store";

export default class Form {
    constructor(data) {
        this.errors = new Errors();

        this.originalData = data;
        this.data = data;

        this.successMessage = '';
        this.isSubmitting = false;
        this.wasValidated = false;
    }

    action(action) {
            this.isValidated();
            this.isSubmitting = true;

            store.dispatch(action, this.data, this.onSuccess(), this.onFail());
    }

    onSuccess(response) {
        console.log('succes', response)
        this.successMessage = response.data.message;
        this.isSubmitting = false;

        this.errors.clear();
        this.reset();
    }

    onFail(error) {
        console.log('error', error);
        this.isSubmitting = false;

        this.errors.record(error.response.data.errors);
    }

    reset() {
        this.data = this.originalData;
    }

    isValidated(validated = true) {
        this.wasValidated = validated;
    }

	isDisabled() {
		return this.errors.hasErrors() || this.isSubmitting;
	}
}
