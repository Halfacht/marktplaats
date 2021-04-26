<template>
  <advertisement-list-item
    v-for="advertisement in advertisements.items"
    :advertisement="advertisement"
  ></advertisement-list-item>
</template>

<script>
import { mapGetters } from "vuex";
import AdvertisementListItem from "./AdvertisementListItem.vue";

export default {
  components: { AdvertisementListItem },

  computed: {
    ...mapGetters(["advertisements"]),
  },

  created() {
    this.$store.dispatch("getAdvertisements");
  },
};
</script>