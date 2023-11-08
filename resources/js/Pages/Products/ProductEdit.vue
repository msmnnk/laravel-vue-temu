<template>
    <Head title="Edit product" />
    <MainLayout>
        <h1 class="">
            Edit product details
        </h1>

        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="save">
                            <div class="row mb-3">
                                <label for="title-input" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input 
                                        v-model="model.title"
                                        :disabled="networking"
                                        :class="{'is-invalid': errors.title}" 
                                        type="text" 
                                        class="form-control" 
                                        id="title-input">

                                        <div v-for="error in errors.title" class="invalid-feedback" :key="error">
                                            {{ error }}
                                        </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="desc-input" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea 
                                        v-model="model.description"
                                        :class="{'is-invalid': errors.description}" 
                                        :disabled="networking" 
                                        rows="4" 
                                        class="form-control" 
                                        id="desc-input" />

                                    <div v-for="error in errors.description" class="invalid-feedback" :key="error">
                                        {{ error }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="offset-sm-2 col-sm-10">
                                    <button :disabled="submitDisabled" type="submit" class="btn" :class="submitDisabled ? 'btn-outline-secondary' : 'btn-primary'">
                                        {{
                                            networking ? 'Saving...' : 'Save edit'
                                        }}
                                    </button>

                                    <Link class="btn btn-link float-end" :href="route('products.show', product)">Cancel</Link>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>


    </MainLayout>
</template>

<script>

import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'

export default {
    components: {
        MainLayout,
        Head,
        Link
    },

    data() {
        return {
            model: {...this.product},
            networking: false,
            dirty: false,
            errors: this.resetErrors(),
            errorMessage: ''
        }
    },

    computed: {
        clean() {
            return !this.dirty;
        },

        submitDisabled() {
            return this.networking || this.clean;
        }
    },

    watch: {
        'model.title': function() {
            this.setDirty(true);
            delete this.errors['title'];
        },

        'model.description'() {
            this.setDirty(true);
            delete this.errors['description'];
        }
    },

    methods: {

        resetErrors() {
            return {};
        },

        setDirty(isDirty) {
            this.dirty = isDirty;
            this.errorMessage = '';
        },
        
        save() {
            this.networking = true;
            axios.patch(route('api.products.update', this.model), this.model)
                .then(this.onSaved)
                .catch(error => this.onSaveError(error))
        },

        onSaved() {
            this.errors = this.resetErrors();
            this.onSaveComplete();
        },

        onSaveError(error) {
            this.errors = error.response.data.errors;
            this.errorMessage = error.response.data.message;
            this.onSaveComplete();
        },

        onSaveComplete() {
            this.networking = false;
            this.setDirty(false);
        }

    },

    props: {
        product: {
            required: true,
            type: Object
        }
    }
}

</script>