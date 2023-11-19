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
            <button class="btn btn-primary mb-3" @click="addToCart(product)">Add to cart</button>
        </div>
    </div>
</template>

<style scoped>
.card {
    min-height: 300px;
    height: 90%;
}

.card-title:hover, .card-img-top:hover {
    cursor: pointer;
}
</style>

<script>
import { router } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
export default {
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
            axios.post(route('api.orderitems.create', product))
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                })
        }
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