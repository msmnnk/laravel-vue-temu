<template>
    <div class="card mb-5" @click="showCard">
        <div class="card-body">
            <h5 class="card-title">
                {{ product.title }}
            </h5>

            <p class="card-text">
                {{ product.description }}
            </p>
        </div>
    </div>
</template>

<style scoped>
    .card {
        min-height: 300px;
    }

    .card:hover {
        cursor: pointer;
    }
</style>

<script>
import { router } from '@inertiajs/vue3';
export default {
    props: {
        product: {
            required: true,
            type: Object
        }
    },

    methods: {
        showCard() {
            // take us to the product page 
            router.visit(route('products.show', this.product));
        }
    }
}
</script>