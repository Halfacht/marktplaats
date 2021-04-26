<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 v-if="id">Update Advertisement</h1>
        <h1 v-else>Create New Advertisement</h1>
      </div>
    </div>

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
          v-model="form.data.category"
        >
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
        Add Advertisement
      </button>
    </form-component>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import SuccessMessage from "../../components/parts/SuccessMessage.vue";
import defaultData from "../../classes/models/Advertisement";
import FormComponent from "../../components/parts/FormComponent";

export default {
  components: { SuccessMessage, FormComponent },

  props: ["id"],

  data() {
    return {
      form: new Form(defaultData),
    };
  },

  computed: {
    ...mapGetters(["categories"]),
  },

  methods: {
    submit() {
      this.form.action("addAdvertisement");
    },
  },

  created() {
    this.$store.dispatch("getCategories")
  },
};
</script>