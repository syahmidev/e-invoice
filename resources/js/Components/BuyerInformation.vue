<template>
    <div>
        <InputLabel for="buyer_name" value="Name" />

        <TextInput
            id="buyer_name"
            v-model="form.buyer_name"
            type="text"
            class="mt-1 block w-full"
            autocomplete="buyer_name"
        />

        <InputError :message="form.errors.buyer_name" class="mt-2" />
    </div>

    <div>
        <InputLabel for="buyer_phone" value="Phone" />

        <TextInput
            id="buyer_phone"
            v-model="form.buyer_phone"
            type="text"
            class="mt-1 block w-full"
            autocomplete="buyer_phone"
        />

        <InputError :message="form.errors.buyer_phone" class="mt-2" />
    </div>

    <div>
        <InputLabel for="buyer_address" value="Address" />

        <TextInput
            id="buyer_address"
            v-model="form.buyer_address"
            type="text"
            class="mt-1 block w-full"
            autocomplete="buyer_address"
        />

        <InputError :message="form.errors.buyer_address" class="mt-2" />
    </div>

    <div>
        <InputLabel for="buyer_business_id" value="Business ID" />

        <TextInput
            id="buyer_business_id"
            v-model="form.buyer_business_id"
            type="text"
            class="mt-1 block w-full"
            autocomplete="buyer_business_id"
        />

        <InputError :message="form.errors.buyer_business_id" class="mt-2" />
    </div>

    <div>
        <InputLabel for="buyer_code" value="Code" />

        <TextInput
            id="buyer_code"
            v-model="form.buyer_code"
            type="text"
            class="mt-1 block w-full"
            autocomplete="buyer_code"
        />

        <InputError :message="form.errors.buyer_code" class="mt-2" />
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
