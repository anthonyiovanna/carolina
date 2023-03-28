<template>

    <!-- CREAT POST FORM -->
    <div class="grid min-h-screen place-items-center">

        <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">

            <h1 class="text-xl font-semibold">Hello there {{ user.username }}, <span class="font-normal">please fill in your information to create a post.</span></h1>

            <form class="mt-6">

                <!-- CATEGORIES COMPONENT -->
                <categories-component
                    @update-selected-values="setCategories($event)"
                    :categories="categories"
                    :subcategories="subcategories"
                    :subsubcategories="subsubcategories">
                </categories-component>


                <!-- TITLE -->
                <label for="title" class="block mt-4 text-xs font-semibold text-gray-600 uppercase">Post Title:</label>

                <input v-model="title"
                       id="title"
                       type="text"
                       name="title"
                       placeholder="John"
                       class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                       required />
                <!-- TITLE -->

                <!-- PRICE -->
                <label for="price" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Price</label>

                <input v-model="price"
                       @blur="formatPrice"
                       id="price"
                       type="text"
                       name="price"
                       class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                />
                <!-- PRICE -->

                <!-- DESCRIPTION -->
                <label for="description" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Post Details</label>

                <textarea
                    v-model="description"
                    id="description"
                    name="description"
                    class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                ></textarea>
                <!-- DESCRIPTION -->

                <!-- POST IMAGES -->
<!--                <post-images-component-->
<!--                    v-model="images">-->
<!--                </post-images-component>-->
                <!-- POST IMAGES -->


                <button @click.prevent="handleSubmit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Next
                </button>
            </form>
        </div>
    </div>

</template>

<script setup>

import CategoriesComponent from "./parts/CategoriesComponent.vue";
import PostImagesComponent from "./parts/PostImagesComponent.vue";
import {ref} from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    categories: {
        type: Array,
        required: true
    },
    subcategories: {
        type: Array,
        required: true
    },
    subsubcategories: {
        type: Array,
        required: true
    },

});

const title = ref('');
const description = ref('');
const category_id = ref('');
const subcategory_id = ref('');
const subsubcategory_id = ref('');
const price = ref(0);
//const images = ref([]);

const setCategories = (catgeories) => {
    category_id.value = catgeories.category_id;
    subcategory_id.value = catgeories.subcategory_id;
    subsubcategory_id.value = catgeories.subsubcategory_id;
}

const formatPrice = () => {
    // Format the price as US currency
    const formattedPrice = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }).format(price.value);

    // Update the price ref with the unformatted value
    price.value = formattedPrice;
};

const handleSubmit = () => {
    // Send the form data to the review method in the PostsController
    axios.post('/posts/review', {
        title: title.value,
        category_id: category_id.value,
        subcategory_id: subcategory_id.value,
        subsubcategory_id: subsubcategory_id.value,
        price: price.value,
        description: description.value,
        //images: this.images,
    })
        .then(response => {
            // Redirect the user to the review page
            window.location.href = response.data.redirect_url;
        })
        .catch(error => {
            console.log(error);
        });
}

const updateImages = (images) => {
    images.value = images;
}
</script>

<style scoped>

</style>
