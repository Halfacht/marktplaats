<template>
  <div class="row">
    <div class="col">
      <p>
        <a
          :class="paginator.hasPrevious() ? 'text-success' : 'text-muted'"
          @click="previous()"
          >Previous</a
        >
        |
        <a
          :class="paginator.hasNext() ? 'text-success' : 'text-muted'"
          @click="next()"
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
	emits: ['changePage'],

  computed: {
    ...mapGetters(["paginator"]),
  },

  methods: {
    next() {
      if (this.paginator.hasNext()) {
		  this.paginator.next();
		  this.$emit('changePage');
      }
    },

    previous() {
      if (this.paginator.hasPrevious()) {
		  this.paginator.previous();
		  this.$emit('changePage');
      }
    },
  },
};
</script>