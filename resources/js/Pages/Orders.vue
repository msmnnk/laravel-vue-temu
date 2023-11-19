<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import DonationHero from '../Widgets/Donation/DonationHero.vue';

export default {
    components: {
    MainLayout,
    Head,
    Link,
    DonationHero
},

    props: {
        orders: {
            required: true,
            type: Array
        }
    },
    setup(props) {
        onMounted(() => {
            // Logic to be executed when the component is mounted
            console.log(props.orders);
        });

        return { props }
    },
    methods: {
        toPounds(price) {
            return (price / 100).toFixed(2);
        }
    },
    computed: {
        total() {
            var sum = 0;
            this.props.orders.forEach(order => {
                sum += order.donation;
            });
            return this.toPounds(sum);
        }
    }
}
</script>

<template>
    <Head title="Checkout" />
    <MainLayout>
        <DonationHero :title="'You have donated £' + total " subtitle="thank you:)" buttonLabel="Learn more"/>

        <h1>Orders</h1>
        <table class="table table-striped" v-if="orders.length" v-for="order in orders">
            <thead>
                <tr>
                    <th scope="col">Order ID: {{ order.id }}</th>
                    <th scope="col">Placed: {{ order.created_at }}</th>
                    <th scope="col">Total: {{ toPounds(order.total) }}</th>
                    <th scope="col">Donated: {{ toPounds(order.donation) }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in order.order_items">
                    <img :src="item.product.images[0].url" class="img-thumbnail" />
                    <td>{{ item.product.title }}</td>
                    <td/>
                    <td/>
                </tr>
            </tbody>
        </table>
        <h4 v-else>You have not placed an order</h4>
    </MainLayout>
</template>

<style scoped>
.img-thumbnail {
    max-width: 50px;
}
</style>