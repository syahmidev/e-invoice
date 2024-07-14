<template>
    <div>
        <InputLabel for="seller_name" value="Name" />

        <TextInput
            id="seller_name"
            v-model="form.seller_name"
            type="text"
            class="mt-1 block w-full"
            autocomplete="seller_name"
        />

        <InputError :message="form.errors.seller_name" class="mt-2" />
    </div>

    <div>
        <InputLabel for="seller_phone" value="Phone" />

        <TextInput
            id="seller_phone"
            v-model="form.seller_phone"
            type="text"
            class="mt-1 block w-full"
            autocomplete="seller_phone"
        />

        <InputError :message="form.errors.seller_phone" class="mt-2" />
    </div>

    <div>
        <InputLabel for="seller_address" value="Address" />

        <TextInput
            id="seller_address"
            v-model="form.seller_address"
            type="text"
            class="mt-1 block w-full"
            autocomplete="seller_address"
        />

        <InputError :message="form.errors.seller_address" class="mt-2" />
    </div>

    <div>
        <InputLabel for="seller_business_id" value="Business ID" />

        <TextInput
            id="seller_business_id"
            v-model="form.seller_business_id"
            type="text"
            class="mt-1 block w-full"
            autocomplete="seller_business_id"
        />

        <InputError :message="form.errors.seller_business_id" class="mt-2" />
    </div>

    <div>
        <InputLabel for="seller_code" value="Code" />

        <TextInput
            id="seller_code"
            v-model="form.seller_code"
            type="text"
            class="mt-1 block w-full"
            autocomplete="seller_code"
        />

        <InputError :message="form.errors.seller_code" class="mt-2" />
    </div>
</template>

<script setup>
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';

    defineProps({
        form: {
            type: Object,
        }
    });
</script>
