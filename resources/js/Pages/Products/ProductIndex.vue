<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import ProductCard from '../../Widgets/Product/ProductCard.vue';
import DonationHero from '../../Widgets/Donation/DonationHero.vue';

export default {
    components: {
        MainLayout,
        Head,
        Link,
        ProductCard,
        DonationHero
    },
    props: {
        products: {
            required: true,
            type: Array,
        },
        featured: {
            required: true,
            type: Array
        },
        charity: {
            required: true,
            type: Object
        }
    },
    computed: {
        amountRaised() {
            return (this.charity.TotalDonated / 100).toFixed(2);
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
        <DonationHero :title="'Together we have raised £' + amountRaised" :subtitle="'for ' + charity.name" buttonLabel="Learn more"></DonationHero>
        <h1>Products</h1>
        <Link :href="route('example1')">Go to page 1</Link>

        <h3>Featured products</h3>
        <div class="row">
            <div v-for="product in featured" :key="product.id" class="col-12 col-md-4">
                <ProductCard :product="product" :donation="charity.donation_percentage"/>
            </div>
        </div>
        
        <hr>
        <h3>All products</h3>
        <div class="row">
            <div v-for="product in products" :key="product.id" class="col-12 col-md-4">
                <ProductCard :product="product" :donation="charity.donation_percentage"/>
            </div>
        </div>
    </MainLayout>
</template>
