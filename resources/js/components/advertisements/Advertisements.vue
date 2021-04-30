<template>
  <advertisements-filter v-model="options.filter"></advertisements-filter>
  <advertisement-distance-search
    v-model:postcode="options.postcode"
    v-model:distance="options.distance"
    @search="search"
  ></advertisement-distance-search>
  <advertisement-list-item
    v-for="advertisement in advertisements.items"
    :advertisement="advertisement"
  ></advertisement-list-item>
  <advertisement-pages></advertisement-pages>
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
        postcode: null,
        distance: null,
      },
    };
  },

  computed: {
    ...mapGetters(["advertisements", "paginator"]),
  },

  methods: {
    search() {},
  },

  created() {
    this.$store.dispatch("getAdvertisements");
  },

  watch: {
    "options.filter": function (newValue, oldValue) {
      this.$store.dispatch("getAdvertisements", this.options);
    },
  },
};
</script>