<template>
    <header>
        <h2 class="text-lg font-medium text-gray-900">{{ props.title }}</h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ props.description }}
        </p>
    </header>
</template>

<script setup>
    const props = defineProps({
        title: {
            type: String,
            default: null,
        },
        description: {
            type: String,
            default: null,
        }
    });
</script>
