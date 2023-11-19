<template>
    <div class="card mb-5">
        <img class="card-img-top" :src="thumbnail" alt="Product thumbnail" @click="showCard">
        <div class="card-body">
            <h5 class="card-title" @click="showCard">
                {{ product.title }}
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
                {{ product.category }}
            </h6>
            <p class="card-text">
                {{ product.description }}
            </p>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Stock: </strong>{{ product.stock }}</li>
                <li class="list-group-item"><strong>Price: </strong>£{{ price }}</li>
                <li class="list-group-item">Buying this will donate £{{ donation }} to charity</li>
            </ul>
            <button v-if="product.stock > 0" class="btn btn-primary mb-3" @click="addToCart(product)">Add to cart</button>
            <div v-else>Out of stock</div>
        </div>
    </div>
</template>

<style scoped>
.card {
    min-height: 300px;
    height: 90%;
}

.card-title:hover,
.card-img-top:hover {
    cursor: pointer;
}
</style>

<script>
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref, onMounted, computed } from 'vue';
export default {
    emits: ['addedToCheckout'],
    props: {
        product: {
            required: true,
            type: Object
        },
        donation: {
            required: true,
            type: Number
        }
    },
    setup(props) {
        onMounted(() => {
            // Logic to be executed when the component is mounted
            console.log(props.product);
        });

        return {
            props
        }
    },
    methods: {
        showCard() {
            // take us to the product page 
            router.visit(route('products.show', this.product));
        },
        addToCart(product) {
            Swal.fire({
                title: 'Adding ' + product.title + ' to cart',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            axios.post(route('api.orderitems.create', product))
                .then(response => {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Added ' + product.title + ' to cart!',
                    });
                    console.log(response.data);
                    this.$emit('addedToCheckout', response.data);
                })
                .catch(error => {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'An unexpected error occured. Please try again.',
                    });
                    console.log(error);
                })
        },
    },
    computed: {
        thumbnail() {
            if (this.product.images) {
                return this.product.images[0].url;
            } else {
                return 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png';
            }
        },

        price() {
            return (this.product.price / 100).toFixed(2);
        },

        donation() {
            return ((this.product.price * (this.donation / 100)) / 100).toFixed(2);
        }
    }
}
</script>