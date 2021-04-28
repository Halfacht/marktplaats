<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 v-if="id">Update Advertisement</h1>
        <h1 v-else>Create New Advertisement</h1>
      </div>
    </div>

    <success-message :message="form.successMessage"></success-message>

    <form-component :form="form" class="col g-3">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input
          class="form-control"
          :class="{ 'is-invalid': form.errors.get('title') }"
          name="title"
          id="title"
          type="text"
          v-model="form.data.title"
        />
        <form-error :error="form.errors.get('title')"></form-error>
      </div>

      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea
          class="form-control"
          :class="{ 'is-invalid': form.errors.get('content') }"
          name="content"
          id="content"
          v-model="form.data.content"
        ></textarea>
        <form-error :error="form.errors.get('content')"></form-error>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input
          class="form-control"
          :class="{ 'is-invalid': form.errors.get('price') }"
          name="price"
          id="price"
          type="text"
          v-model="form.data.price"
        />
        <form-error :error="form.errors.get('price')"></form-error>
      </div>

      <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select
          class="form-control"
          :class="{ 'is-invalid': form.errors.get('category_id') }"
          name="category_id"
          id="category_id"
          v-model="form.data.category_id"
        >
          <option disabled value="">Select a category</option>
          <option v-for="category in categories" :value="category.id">
            {{ category.name }}
          </option>
        </select>
        <form-error :error="form.errors.get('category_id')"></form-error>
      </div>

      <button
        :disabled="form.isDisabled()"
        class="btn btn-success"
        @click.prevent="submit"
      >
        {{ id ? "Update Advertisement" : "Add Advertisement" }}
      </button>
    </form-component>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import SuccessMessage from "../../components/parts/SuccessMessage.vue";
import FormComponent from "../../components/parts/FormComponent";
import FormError from "../../components/parts/FormError";
import { DEFAULT_DATA } from "../../classes/models/Advertisement";

export default {
  components: { SuccessMessage, FormComponent, FormError },

  props: ["id"],

 

  computed: {
    ...mapGetters(["userAdvertisementById", "categories"]),

    form() {
      return this.id
        ? new Form(this.userAdvertisementById(this.id))
        : new Form(DEFAULT_DATA);
    },
  },

  methods: {
    submit() {
      this.id ? this.update() : this.store();
    },
    store() {
      this.form.action("storeAdvertisement");
    },
    update() {
      this.form.action("updateAdvertisement");
    },
  },
};
</script>