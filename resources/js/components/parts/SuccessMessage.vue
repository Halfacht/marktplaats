<template>
    <div v-show="message" class="row justify-content-center my-3">
        <div class="col-6 border rounded text-success text-center p-3">
            <span class="fw-bold">{{ message }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['message']
}
</script>
