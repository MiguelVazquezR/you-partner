<template>
	<nav aria-label="breadcrumb" class="w-full p-4 dark:bg-gray-800 dark:text-gray-100">
		<ol class="flex h-8 space-x-2 dark:text-gray-100">
			<li class="flex items-center space-x-1">
				<span v-if="index > 0" class="dark:text-gray-400">/</span>
                <Link v-for="(index, link) in links" :key="index" :href="link.url" :class="link.url == null ? 'cursor-default hover:no-underline' : '' " class="flex items-center px-1 capitalize hover:underline">
                    {{ link.name }}
                </Link>
			</li>
		</ol>
	</nav>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    props: {
        links: Array
    }
}
</script>

<style>

</style>