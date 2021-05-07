<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Price</th>
              <th>Created At</th>
			  <th>Place On Top</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="advertisement in userAdvertisements.items">
              <th>{{ advertisement.id }}</th>
              <td>{{ advertisement.title }}</td>
              <td>€ {{ advertisement.price }}</td>
              <td>{{ advertisement.createdAt }}</td>
			  <td>
				  <button class="btn btn-primary" @click="top(advertisement)">To Top</button>
			  </td>
              <td>
                <router-link
                  :to="{
                    name: 'advertisements.edit',
                    params: { id: advertisement.id },
                  }"
                  class="btn btn-warning"
                >
                  Edit
                </router-link>
              </td>
              <td>
                <button class="btn btn-danger" @click="remove(advertisement)">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>


<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["userAdvertisements"]),
  },

  methods: {
    remove(advertisement) {
      if (
        confirm(`Are you sure you want to delete: "${advertisement.title}"`)
      ) {
        this.$store.dispatch("deleteAdvertisement", advertisement.id);
      }
    },
	top(advertisement) {
		if (
        confirm(`Place your advertisement (${advertisement.title}) back to the top of the search results. After confirming you will be charged for an amount of 10 euros`)
      ) {
        this.$store.dispatch("topAdvertisement", advertisement.id);
      }
	}
  },
};
</script>