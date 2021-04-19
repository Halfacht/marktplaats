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
        return new Promise((resolve, reject) => {
            this.isValidated();
            this.isSubmitting = true;

            store.dispatch(action, this.data)
                .then((response) => {
                    this.onSuccess(response);
                    resolve(response);
                })
                .catch((error) => {
                    this.onFail(error);
                });
        });
    }

    onSuccess(response) {
        this.successMessage = response.data.message;
        this.isSubmitting = false;

        this.errors.clear();
        this.reset();
    }

    onFail(error) {
        this.isSubmitting = false;

        this.errors.record(error.response.data.errors);
    }

    reset() {
        this.data = this.originalData;
    }

    isValidated(validated = true) {
        this.wasValidated = validated;
    }
}
