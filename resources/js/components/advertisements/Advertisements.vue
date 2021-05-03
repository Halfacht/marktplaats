<template>
  <advertisements-filter v-model="options.filter"></advertisements-filter>
  <advertisement-distance-search
    v-model:postcode="options.fromPostcode"
    v-model:distance="options.maxDistance"
    @search="search"
  ></advertisement-distance-search>
  <advertisement-list-item
    v-for="advertisement in advertisements.items"
    :advertisement="advertisement"
  ></advertisement-list-item>
  <advertisement-pages @changePage="getAdvertisements"></advertisement-pages>
</template>

<script>
import { mapGetters } from "vuex";
import AdvertisementListItem from "./AdvertisementListItem.vue";
import AdvertisementsFilter from "./AdvertisementsFilter.vue";
import AdvertisementDistanceSearch from "./AdvertisementDistanceSearch.vue";
import AdvertisementPages from "../parts/Pages.vue";

export default {
  components: {
    AdvertisementListItem,
    AdvertisementsFilter,
    AdvertisementPages,
    AdvertisementDistanceSearch,
  },

  data() {
    return {
      options: {
        filter: [],
        fromPostcode: null,
        maxDistance: null,
      },
    };
  },

  computed: {
    ...mapGetters(["advertisements", "paginator"]),
  },

  methods: {
    search() {
		this.$store.dispatch("resetPaginator");
		this.getAdvertisements();
	},
	getAdvertisements() {
		this.$store.dispatch("getAdvertisements", this.options);
	},
  },

  created() {
    this.getAdvertisements();
  },

  watch: {
    "options.filter": function (newValue, oldValue) {
      this.search();
    },
  },
};
</script>