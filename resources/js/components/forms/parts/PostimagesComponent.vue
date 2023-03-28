<template>
    <div class="mb-4">

        <label class="block font-medium mb-2">Images (up to 8)</label>

        <input @change="handleFileChange" type="file" accept="image/*" multiple>

        <div class="flex flex-wrap -mx-4 mt-2">

            <div v-for="(image, index) in selectedImages" :key="index" class="relative w-24 h-24 overflow-hidden border border-gray-300 rounded-lg shadow-sm mx-4 my-2">

                <img :src="image.url" class="object-cover w-full h-full">

                <button class="absolute top-0 right-0 px-2 py-1 bg-red-600 text-white text-xs font-medium rounded-bl-lg focus:outline-none" @click="deleteImage(index)">X</button>

            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, watchEffect } from 'vue';

const emit = defineEmits(['update:selectedImages']);

const selectedImages = ref([]);

const handleFileChange = (event) => {
    const files = event.target.files;
    const fileList = Array.from(files);
    selectedImages.value = fileList;
    console.log(selectedImages.value);
};

const deleteImage = (index) => {
    selectedImages.value.splice(index, 1);
};

watchEffect(() => {
    // Emit the selected images to the parent component whenever the selected images change
    emit('update:selectedImages', selectedImages.value);
});
</script>
