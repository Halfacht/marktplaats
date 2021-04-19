<template>
    <div v-if="error" class="invalid-feedback" v-text="error"></div>
</template>

<script>
export default {
    props: ['error']
}
</script>
