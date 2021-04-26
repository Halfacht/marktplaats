<template>
  <div class="row mb-3">
    <div class="col-8 card p-2">
      <a class="h4">{{ advertisement.title }}</a>
      <p>{{ short(advertisement.content) }}</p>
    </div>
    <div class="col card p-2">
      <p class="fw-bold">€ {{ advertisement.price }}</p>
      <p>{{ advertisement.momentAgo }}</p>
    </div>
    <div class="col card p-2">
      <p class="fw-bold">{{ advertisement.owner?.name }}</p>
      <p>{{ advertisement.owner?.town }}</p>
	  <p v-if="advertisement.owner?.distance">{{ advertisement.owner.distance}} km</p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["advertisement"],

  methods: {
    short(content) {
      return content.substring(0, 100);
    },
  },
};
</script>