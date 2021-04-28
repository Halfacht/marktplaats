<template>
  <advertisements-filter v-model="filter"></advertisements-filter>
  <advertisement-list-item
    v-for="advertisement in advertisements.items"
    :advertisement="advertisement"
  ></advertisement-list-item>
</template>

<script>
import { mapGetters } from "vuex";
import AdvertisementListItem from "./AdvertisementListItem.vue";
import AdvertisementsFilter from "./AdvertisementsFilter.vue";

export default {
  components: { AdvertisementListItem, AdvertisementsFilter },

  data() {
    return {
      filter: [],
    };
  },

  computed: {
    ...mapGetters(["advertisements", "paginator"]),
  },

  created() {
    this.$store.dispatch("getAdvertisements");
  },

  watch: {
	  filter(newValue, oldValue) {
		  this.$store.dispatch("getAdvertisements", newValue);
	  }
  },

};
</script>