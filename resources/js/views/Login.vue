<template>
  <div class="container">
    <div class="row">
      <form-component :form="form" class="col g-3">
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

        <button
          :disabled="formDisabled"
          class="btn btn-success"
          @click.prevent="login"
        >
          Login
        </button>
      </form-component>
    </div>
  </div>
</template>

<script>
import FormError from "../components/parts/FormError";
import FormComponent from "../components/parts/FormComponent";

export default {
  components: { FormComponent, FormError },

  data() {
    return {
      form: new Form({
        email: "alwin@mail.com", // @todo: make empty string after testing
        password: "testtest",
      }),
    };
  },

  computed: {
    formDisabled() {
      return this.form.errors.hasErrors() || this.form.isSubmitting;
    },
  },

  methods: {
    login() {
      this.form.action("login");
    },
  },
};
</script>
