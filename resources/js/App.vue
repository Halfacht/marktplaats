<template>
    <navigation></navigation>

    <router-view></router-view>
</template>

<script>
import Navigation from "./components/navigation.vue";

export default {
    components: {Navigation},

    computed: {
        store() { // @todo: remove for production
            return this.$store.state;
        }
    },

    created() {
        this.$store.dispatch("getBlogs");
        this.$store.dispatch("getCategories");
    },
};
</script>
