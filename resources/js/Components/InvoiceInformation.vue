<template>
    <div>
        <InputLabel for="serial_no" value="Serial Number" />

        <TextInput
            id="serial_no"
            v-model="form.serial_no"
            type="text"
            class="mt-1 block w-full"
            autocomplete="serial_no"
        />

        <InputError :message="form.errors.serial_no" class="mt-2" />
    </div>

    <div>
        <InputLabel for="invoice_date" value="Invoice Date" />

        <TextInput
            id="invoice_date"
            v-model="form.invoice_date"
            type="date"
            class="mt-1 block w-full"
            autocomplete="invoice_date"
        />

        <InputError :message="form.errors.invoice_date" class="mt-2" />
    </div>

    <div>
        <InputLabel for="order_number" value="Order Number" />

        <TextInput
            id="order_number"
            v-model="form.order_number"
            type="text"
            class="mt-1 block w-full"
            autocomplete="order_number"
        />

        <InputError :message="form.errors.order_number" class="mt-2" />
    </div>

    <div>
        <InputLabel for="currency" value="Currency" />

        <TextInput
            id="currency"
            v-model="form.currency"
            type="text"
            class="mt-1 block w-full"
            autocomplete="currency"
            readonly
            disabled
        />

        <InputError :message="form.errors.currency" class="mt-2" />
    </div>

    <div>
        <InputLabel for="notes" value="Notes" />

        <TextInput
            id="notes"
            v-model="form.notes"
            type="text"
            class="mt-1 block w-full"
            autocomplete="notes"
        />

        <InputError :message="form.errors.notes" class="mt-2" />
    </div>

    <div>
        <InputLabel for="due_date" value="Due Date" />

        <TextInput
            id="due_date"
            v-model="form.due_date"
            type="date"
            class="mt-1 block w-full"
            autocomplete="due_date"
        />

        <InputError :message="form.errors.due_date" class="mt-2" />
    </div>

    <div>
        <InputLabel for="status" value="Status" />

        <Dropdown v-model="form.status" class="mt-1 block w-full" required>
            <template #trigger>
                <div class="p-2 border rounded cursor-pointer">
                    {{ form.status ? form.status : 'Select a status' }}
                </div>
            </template>
            <template #content="{ selectOption }">
                <div class="py-1">
                    <div v-for="(name, index) in status" :key="index" @click="selectOption(name)" class="p-2 cursor-pointer hover:bg-gray-200">{{ name }}</div>
                </div>
            </template>
        </Dropdown>

        <InputError :message="form.errors.status" class="mt-2" />
    </div>
</template>

<script setup>
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import { usePage } from '@inertiajs/vue3';

    const status = usePage().props.status;

    defineProps({
        form: {
            type: Object,
        }
    });
</script>
