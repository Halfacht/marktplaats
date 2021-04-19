import Errors from "./Errors.js";
import Vue from "vue";

export default class Form {
    constructor(data) {
        this.errors = new Errors();

        this.originalData = data;
        this.successMessage = '';
        this.isSubmitting = false;
        this.wasValidated = false;

        // Data to properties
        for (let field in data) {
            this[field] = data[field];
        }
    }

    /**
     * Data Properties to data object
     *
     * @returns Object
     */
    data() {
        let data = new FormData();

        for (let key in this.originalData) {
            if (this[key]) {
                data.append(key, this[key])
            }
        }

        return data;
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = this.originalData[field];
        }
    }

    action(action) {
        return new Promise((resolve, reject) => {
            this.isValidated();
            this.isSubmitting = true;

            Vue.store.dispatch(action, this.data())
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

    isValidated(validated = true) {
        this.wasValidated = validated;
    }
}
