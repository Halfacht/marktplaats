<template>
  <div class="container">
    <success-message :message="form.successMessage"></success-message>

    <div class="row">
      <form-component :form="form" class="col g-3">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input
            class="form-control"
            :class="{ 'is-invalid': form.errors.get('name') }"
            name="name"
            id="name"
            type="text"
            v-model="form.data.name"
          />
          <form-error :error="form.errors.get('name')"></form-error>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            class="form-control"
            :class="{ 'is-invalid': form.errors.get('email') }"
            name="email"
            id="email"
            type="email"
            v-model="form.data.email"
          />
          <form-error :error="form.errors.get('email')"></form-error>
        </div>

        <div class="mb-3">
          <label for="postcode" class="form-label">Postcode (4 numbers)</label>
          <input
            class="form-control"
            :class="{ 'is-invalid': form.errors.get('postcode') }"
            name="postcode"
            id="postcode"
            type="text"
            v-model="form.data.postcode"
          />
          <form-error :error="form.errors.get('password')"></form-error>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            class="form-control"
            :class="{ 'is-invalid': form.errors.get('password') }"
            name="password"
            id="password"
            type="password"
            v-model="form.data.password"
          />
          <form-error :error="form.errors.get('password')"></form-error>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label"
            >Password confirmation</label
          >
          <input
            class="form-control"
            :class="{ 'is-invalid': form.errors.get('password_confirmation') }"
            name="password_confirmation"
            id="password_confirmation"
            type="password"
            v-model="form.data.password_confirmation"
          />
          <form-error
            :error="form.errors.get('password_confirmation')"
          ></form-error>
        </div>

        <button
          class="btn btn-success"
          @click.prevent="register"
          :disabled="formDisabled"
        >
          Register
        </button>
      </form-component>
    </div>
  </div>
</template>

<script>
import SuccessMessage from "../components/parts/SuccessMessage.vue";
import FormError from "../components/parts/FormError";
import FormComponent from "../components/parts/FormComponent";


export default {
  components: { FormComponent, FormError, SuccessMessage },

  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        postcode: "",
        password: "",
        password_confirmation: "",
      }),
    };
  },

  computed: {
    formDisabled() {
      return this.form.errors.hasErrors() || this.form.isSubmitting;
    },
  },

  methods: {
    register() {
      this.form.action("register");
    },
  },
};
</script>
