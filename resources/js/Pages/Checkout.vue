<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted } from 'vue';

export default {
    components: {
        MainLayout,
        Head,
        Link
    },

    props: {
        orderItems: {
            required: true,
            type: Array
        }
    },

    setup(props) {
        onMounted(() => {
            // Logic to be executed when the component is mounted
            console.log(props.orderItems);
        });

        return {
            props
        }
    },

    data() {
        return {
            refOrderItems: [...this.orderItems]
        }
    },

    methods: {
        remove(item) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(route('api.orderitems.delete', item))
                        .then(response => {
                            this.refOrderItems = response.data;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            })
        },
        price(price) {
            return (price / 100).toFixed(2);
        },
        checkout() {
            Swal.fire({
                title: 'Checking out your order',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            axios.post(route('api.checkout'))
                .then(response => {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'We recieved your order!'
                    }).then(r => {
                        window.location.href = route('orders');
                    });

                })
                .catch(error => {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'An unexpected error occured. Please try again.',
                    });
                    console.log(error);
                });
        }
    },
    computed: {
        total() {
            var sum = 0;
            this.refOrderItems.forEach(order => {
                sum += order.product.price;
            });
            return this.price(sum);
        }
    }
}
</script>

<template>
    <Head title="Checkout" />

    <MainLayout>
        <h1>Checkout</h1>
        <table class="table table-striped" v-if="refOrderItems.length">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in refOrderItems">
                    <td>
                        <img class="img-thumbnail" :src="item.product.images[0].url" alt="Product thumbnail">
                    </td>
                    <td>{{ item.product.title }}</td>
                    <td>£{{ price(item.product.price) }}</td>
                    <td><button class="btn btn-danger" @click="remove(item)">Remove</button></td>
                </tr>
                <tr>
                    <td />
                    <td />
                    <td><strong>Total: </strong>£{{ total }}</td>
                    <td><button class="btn btn-primary" @click="checkout()">Checkout</button></td>
                </tr>
            </tbody>
        </table>
        <h4 v-else>Your cart is empty :(</h4>
    </MainLayout>
</template>

<style scoped>
.img-thumbnail {
    max-width: 50px;
}
</style>