<template>
    <Head title="Edit product" />
    <MainLayout>
        <h1>
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
                                    <input :disabled="networking" type="text" class="form-control" id="title-input" v-model="model.title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="desc-input" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea :disabled="networking" rows="4" class="form-control" id="desc-input" v-model="model.description"></textarea>
                                </div>
                            </div>
                            <button :disabled="submitDisabled" type="submit" class="btn" :class="submitDisabled ? 'btn-outline-secondary' : 'btn-primary'">
                                {{
                                    networking ? 'Saving...' : 'Save edit'
                                }}
                            </button>
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
            errors: {}
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
        },

        'model.description'() {
            this.setDirty(true);
        }
    },

    methods: {
        setDirty(isDirty) {
            this.dirty = isDirty;
        },
        
        save() {
            this.networking = true;
            axios.patch(route('api.products.update', this.model), this.model)
                .then(this.onSaved)
                .catch(this.onSaveError)
        },

        onSaved() {
            this.onSaveComplete();
        },

        onSaveError(error) {
            this.errors = error.response.data.errors;
            alert(error.response.data.message);

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