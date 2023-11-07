<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import ProductCard from '../../Widgets/Product/ProductCard.vue';

export default {
    components: {
        MainLayout,
        Head,
        Link,
        ProductCard
    },

    props: {
        products: {
            required: true,
            type: Array,
        },
        featured: {
            required: true,
            type: Array
        }
    },

    data() {
        return {
        }
    }
}

</script>

<template>
    <Head title="Example page title" />

    <MainLayout>
        <h1>Products</h1>
        <Link :href="route('example1')">Go to page 1</Link>

        <h3>Featured products</h3>
        
        <div class="row">
            <div v-for="product in featured" :key="product.id" class="col-12 col-md-4">
                <ProductCard :product="product"/>
            </div>
        </div>
            
        <hr>
        <div class="row">
            <div v-for="product in products" :key="product.id" class="col-12 col-md-3">
                <ProductCard :product="product"/>
            </div>
        </div>
    </MainLayout>
</template>
