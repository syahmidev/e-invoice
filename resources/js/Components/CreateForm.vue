<template>
    <form @submit.prevent="createInvoice">
        <!-- Invoice Information Section -->
        <FormHeader title="Invoice Information" description="Please Fill Up Invoice Information."></FormHeader>
        <div class="mt-6 space-y-6">
            <InvoiceInformation :form="form"></InvoiceInformation>
        </div>

        <!-- Seller Information Section -->
        <hr class="h-px my-8 bg-gray-300 border-0 dark:bg-gray-700">
        <FormHeader title="Seller Information" description="Please Fill Up Seller Information."></FormHeader>
        <div class="mt-6 space-y-6">
            <SellerInformation :form="form"></SellerInformation>
        </div>

        <!-- Buyer Information Section -->
        <hr class="h-px my-8 bg-gray-300 border-0 dark:bg-gray-700">
        <FormHeader title="Buyer Information" description="Please Fill Up Buyer Information."></FormHeader>
        <div class="mt-6 space-y-6">
            <BuyerInformation :form="form"></BuyerInformation>
        </div>

        <!-- Items Information Section -->
        <hr class="h-px my-8 bg-gray-300 border-0 dark:bg-gray-700">
        <FormHeader title="Items Information" description="Please Fill Up Items Information."></FormHeader>
        <div class="mt-6 space-y-6">
            <ItemsInformation :form="form" @add-item="addItem" @delete-item="deleteItem"></ItemsInformation>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-center gap-4 mt-6">
            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

            <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0"
            >
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
            </Transition>
        </div>
    </form>
</template>

<script setup>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import FormHeader from './FormHeader.vue';
    import InvoiceInformation from './InvoiceInformation.vue';
    import SellerInformation from './SellerInformation.vue';
    import BuyerInformation from './BuyerInformation.vue';
    import ItemsInformation from './ItemsInformation.vue';
    import { useForm } from '@inertiajs/vue3';
    import { reactive } from 'vue';

    const form = reactive(useForm({
        serial_no: '',
        invoice_date: '',
        order_number: '',
        currency: 'MYR',
        notes: '',
        due_date: '',
        status: '',
        seller_name: '',
        seller_phone: '',
        seller_address: '',
        seller_business_id: '',
        seller_code: '',
        buyer_name: '',
        buyer_phone: '',
        buyer_address: '',
        buyer_business_id: '',
        buyer_code: '',
        items: [
            {
                name: '',
                description: '',
                unit: '',
                quantity: '',
                price: '',
                discount: '',
            }
        ],
    }));

    const createInvoice = () => {
        form.post(route('invoices.submit'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
            onError: () => {
                if (form.errors.serial_no) {
                    form.reset('serial_no');
                }
                if (form.errors.invoice_date) {
                    form.reset('invoice_date');
                }
                if (form.errors.order_number) {
                    form.reset('order_number');
                }
                if (form.errors.currency) {
                    form.reset('currency');
                }
                if (form.errors.notes) {
                    form.reset('notes');
                }
                if (form.errors.due_date) {
                    form.reset('due_date');
                }
                if (form.errors.status) {
                    form.reset('status');
                }
            },
        });
    };

    const addItem = () => {
        form.items.push({
            name: '',
            description: '',
            unit: '',
            quantity: '',
            price: '',
            discount: '',
        });
    };

    const deleteItem = (index) => {
        form.items.splice(index, 1);
    };
</script>
