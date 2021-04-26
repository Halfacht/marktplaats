<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Home Page</h1>
      </div>
    </div>

    <advertisements></advertisements>
  </div>
</template>

<script>
import advertisements from "../components/advertisements/Advertisements";

export default {
  components: { advertisements },
};
</script>