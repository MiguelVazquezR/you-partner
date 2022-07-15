<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'w-full font-thin uppercase flex items-center p-4 my-1 transition-colors duration-200 justify-start text-blue-500 bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 dark:from-gray-700 dark:to-gray-800'
        : 'w-full font-thin uppercase text-gray-500 dark:text-gray-200 flex items-center p-4 my-1 transition-colors duration-200 justify-start hover:text-blue-500';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
