<template>
    <div class="row mb-4">
        <div class="col">
            <p>Category Filters:</p>

            <div v-for="category in categories" class="form-check form-check-inline form-switch">
                <input
                    :id="category.name"
                    v-model="filter"
                    :value="category.id"
                    class="form-check-input"
                    type="checkbox"
                >
                <label :for="category.name" class="form-check-label">{{ category.name }}</label>
            </div>
            <div class="my-1">
                <button class="btn btn-outline-secondary" @click="clearFilter">X Clear filters</button>
            </div>
        </div>
    </div>

</template>

<script>
import {mapGetters} from "vuex";

export default {
    props: {
        modelValue: {
            type: Array,
            required: true,
        }
    },

    emits: ['update:modelValue'],

    data() {
        return {}
    },
    computed: {
        ...mapGetters(['categories']),

        filter: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        }
    },
    methods: {
        clearFilter() {
            this.filter = [];
        }
    },

}
</script>
