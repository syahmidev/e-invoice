<template>
    <div>
        <SecondaryButtonVue @click="$emit('add-item')" class="mb-6">Add Item</SecondaryButtonVue>
        <div v-for="(item, index) in form.items" :key="index" class="space-y-6">
            <hr v-if="index > 0" class="h-px my-8 bg-gray-300 border-0 dark:bg-gray-700">
            <p class="mt-1 text-base text-gray-700 underline">
                Item {{ index + 1 }}
            </p>
            <div>
                <InputLabel :for="'item.name.' + index" value="Name" />
                <TextInput
                    :id="'item.name.' + index"
                    v-model="item.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="item.name"
                />
            </div>

            <div>
                <InputLabel :for="'item.description.' + index" value="Description" />
                <TextInput
                    :id="'item.description.' + index"
                    v-model="item.description"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="item.description"
                />
            </div>

            <div>
                <InputLabel :for="'item.unit.' + index" value="Unit" />
                <TextInput
                    :id="'item.unit.' + index"
                    v-model="item.unit"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="item.unit"
                />
            </div>

            <div>
                <InputLabel :for="'item.quantity.' + index" value="Quantity" />
                <TextInput
                    :id="'item.quantity.' + index"
                    v-model="item.quantity"
                    type="number"
                    class="mt-1 block w-full"
                    autocomplete="item.quantity"
                />
            </div>

            <div>
                <InputLabel :for="'item.price.' + index" value="Price" />
                <TextInput
                    :id="'item.price.' + index"
                    v-model="item.price"
                    type="number"
                    class="mt-1 block w-full"
                    autocomplete="item.price"
                />
            </div>

            <div>
                <InputLabel :for="'item.discount.' + index" value="Discount" />
                <TextInput
                    :id="'item.discount.' + index"
                    v-model="item.discount"
                    type="number"
                    class="mt-1 block w-full"
                    autocomplete="item.discount"
                />
            </div>

            <SecondaryButtonVue v-if="index > 0" @click="$emit('delete-item', index)" class="text-red-600">Delete</SecondaryButtonVue>
        </div>
    </div>
</template>

<script setup>
    import { defineProps } from 'vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import SecondaryButtonVue from './SecondaryButton.vue';

    defineProps({
        form: {
            type: Object,
            required: true
        }
    });
</script>
