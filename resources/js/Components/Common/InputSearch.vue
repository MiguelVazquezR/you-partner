<template>
	<fieldset class="w-full space-y-1 dark:text-gray-100">
		<div class="relative">
			<span class="absolute inset-y-0 left-0 flex items-center pl-2">
				<button type="button" title="Buscar" class="p-1 focus:outline-none focus:ring">
					<i class="fa-solid fa-magnifying-glass text-gray-500"></i>
				</button>
			</span>
			<Input type="search" name="text" placeholder="Buscar..." class="py-2 pl-10 text-sm rounded-md w-full" />
		</div>
	</fieldset>
</template>

<script>
import Input from "@/Jetstream/Input.vue";

export default {
    components: {
        Input
    }
}
</script>