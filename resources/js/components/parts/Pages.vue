<template>
  <div class="row">
    <div class="col">
      <p>
        <a
          :class="paginator.hasPrevious() ? 'text-success' : 'text-muted'"
          @click="paginator.previous()"
          >Previous</a
        >
        |
        <a
          :class="paginator.hasNext() ? 'text-success' : 'text-muted'"
          @click="paginator.next()"
          >Next</a
        >
      </p>
      <p>Current Page: {{ paginator.current_page }}</p>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["paginator"]),
  },

  methods: {
    next() {
      if (this.paginator.hasNext()) {
      }
    },

    previous() {
      if (this.paginator.hasPrevious()) {
      }
    },
  },
};
</script>