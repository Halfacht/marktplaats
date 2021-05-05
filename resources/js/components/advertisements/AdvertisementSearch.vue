<template>
  <div class="row row-cols-md-auto g-3 mb-3">
    <div class="col-12">
      <div class="form-floating">
        <input
          id="search"
          :value="search"
          class="form-control"
          type="text"
          @input="$emit('update:search', $event.target.value)"
        />
        <label for="search">Search</label>
      </div>
    </div>
    <div class="col-12">
      <div class="form-floating">
        <input
          id="postcode"
          :value="postcode"
          class="form-control"
          type="text"
          @input="update('update:postcode', $event.target.value)"
        />
        <label for="postcode">Postcode</label>
      </div>
    </div>
    <div class="col-12">
      <div class="form-floating">
        <input
          id="distance"
          :value="distance"
          class="form-control"
          type="text"
          @input="update('update:distance', $event.target.value)"
        />
        <label for="distance">Max Distance</label>
      </div>
    </div>
    <div class="col">
      <button class="btn btn-info" @click="$emit('search')">Search</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    search: String,
    postcode: String,
    distance: String,
  },

  emits: ["update:search", "update:postcode", "update:distance", "search"],

  methods: {
    update(event, value) {
      let newValue = value.replace(/\D/g, "");
      this.$emit(event, newValue);
    },
  },
};
</script>