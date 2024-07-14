<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
</script>

<template>
    <Head title="Invoices" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoices</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Link :href="route('invoices.create')">
                        <SecondaryButton>
                            Create Invoice
                        </SecondaryButton>
                    </Link>

                    <div class="p-6 text-gray-900">You're in invoice page!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
