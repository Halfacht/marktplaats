<template>
  <form @keydown="form.errors.clear($event.target.name)">
    <slot></slot>
  </form>
</template>

<script>
export default {
  props: ["form"],
};
</script>