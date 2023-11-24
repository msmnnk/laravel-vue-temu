<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import axios from 'axios';
import Swal from 'sweetalert2';
import { onMounted } from 'vue';
 
export default {
    components: {
        MainLayout,
        Head,
        Link
    },
 
    props: {
        charities: {
            type: Object
        }
    },
 
    data() {
        return {
            newProduct: {
                title: '',
                description: '',
                category: '',
                stock: 0,
                price: 0
            }
        }
    },
 
    methods: {
        submitForm() {
            const url = route('api.products.create');
            axios.post(url, this.newProduct)
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Product created'
                }).then(r => {
                    debugger;
                    router.visit(route('products.show', response.data))
                });
            })
            .catch(error=>{
                Swal.fire({
                    icon: 'success',
                    title: 'Something to fix',
                    text: error.response.data.message,
                    icon: 'error'
                });
            });
        }
    }
}
</script>
 
<template>
    <Head title="Admin Dashboard" />
 
    <MainLayout>
        <h1>Admin dashboard</h1>
        <div class="container mt-5">
            <h2>Add New Product</h2>
            <form @submit.prevent="submitForm()">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input v-model="newProduct.title" type="text" class="form-control" id="title" placeholder="Enter product title"
                        required>
                </div>
 
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea v-model="newProduct.description" class="form-control" id="description" rows="3"
                        placeholder="Enter product description" required></textarea>
                </div>
 
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input v-model="newProduct.category" type="text" class="form-control" id="category"
                        placeholder="Enter product category" required>
                </div>
 
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input v-model="newProduct.stock" type="number" class="form-control" id="stock" placeholder="Enter product stock"
                        required>
                </div>
 
                <div class="form-group">
                    <label for="price">Price:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">£</span>
                        </div>
                        <input v-model="newProduct.price" type="number" class="form-control" id="price"
                            placeholder="Enter product price" required>
                    </div>
                </div>
 
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
 
        <table class="table table-striped mt-3" v-if="charities.length">
            <thead>
                <tr>
                    <th scope="col">Charity</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Raised</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="charity in charities">
                    <td>{{ charity.name }}</td>
                    <td>{{ charity.description }}</td>
                    <td>{{ new Date(charity.created_at).toLocaleString() }}</td>
                    <td>£{{ charity.TotalDonated }}</td>
                </tr>
            </tbody>
        </table>
    </MainLayout>
</template>
 
<style scoped></style>