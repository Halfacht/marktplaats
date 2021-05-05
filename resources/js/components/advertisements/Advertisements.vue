<template>
  <advertisements-filter v-model="options.filter"></advertisements-filter>
  <advertisement-search
  	v-model:search="options.search"
    v-model:postcode="options.fromPostcode"
    v-model:distance="options.maxDistance"
    @search="search"
  ></advertisement-search>
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
import AdvertisementSearch from "./AdvertisementSearch.vue";
import AdvertisementPages from "../parts/Pages.vue";

export default {
  components: {
    AdvertisementListItem,
    AdvertisementsFilter,
    AdvertisementPages,
    AdvertisementSearch,
  },

  data() {
    return {
      options: {
        filter: [],
		search: '',
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