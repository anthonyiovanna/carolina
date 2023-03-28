<template>



        <div>

            <label for="category_id" class="block mt-4 text-xs font-semibold text-gray-600 uppercase">Category</label>


            <select v-model="selectedCategory" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" name="category_id" required>

                <option value="">-- Select Category --</option>

                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>

            </select>
        </div>

        <div class="flex  gap-1 mt-4">

            <div class="w-1/2">

                <label for="subcategory_id" class="block mt-4 text-xs font-semibold text-gray-600 uppercase">Subcategory</label>

                <div class="col-md-6">

                    <select v-model="selectedSubcategory" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" name="subcategory_id" required>

                        <option value="">-- Select Subcategory --</option>

                        <option v-for="subcategory in filteredSubcategories" :key="subcategory.id" :value="subcategory.id">{{ subcategory.name }}</option>

                    </select>
                </div>
            </div>


            <div class="w-1/2">

                <label for="subsubcategory_id" class="block mt-4 text-xs font-semibold text-gray-600 uppercase">Subsubcategory</label>

                <div class="col-md-6">

                    <select v-model="selectedSubsubcategory" @change="onSubsubcategoryChange" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" name="subsubcategory_id" required>

                        <option value="">-- Select Subsubcategory --</option>

                        <option v-for="subsubcategory in filteredSubsubcategories" :key="subsubcategory.id" :value="subsubcategory.id">{{ subsubcategory.name }}</option>

                   </select>
                </div>
            </div>
        </div>

</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
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

const emits = defineEmits(['updateSelectedValues']);

const selectedCategory = ref('');
const selectedSubcategory = ref('');
const selectedSubsubcategory = ref('');

const filteredSubcategories = computed(() => {
    if (selectedCategory.value) {
        return props.subcategories.filter(subcategory => subcategory.category_id === selectedCategory.value);
    } else {
        return [];
    }
});

const filteredSubsubcategories = computed(() => {
    if (selectedSubcategory.value) {
        return props.subsubcategories.filter(subsubcategory => subsubcategory.subcategory_id === selectedSubcategory.value);
    } else {
        return [];
    }
});

const onSubsubcategoryChange = () => {
    // Emit the custom event with the selected values
    const payload = {
        category_id: selectedCategory.value,
        subcategory_id: selectedSubcategory.value,
        subsubcategory_id: selectedSubsubcategory.value,
    };
    emits('updateSelectedValues', payload);
};

</script>


