<template>
    <div class="flex items-center ml-2">
        <div class="flex items-center">
            <img class="mr-2 w-8 h-8 rounded-full ring-1 ring-offset-2 ring-indigo-400"
                :src="user.profile_photo_url" :alt="user.name">
            <p class="text-gray-600 font-semibold text-xs">{{ user.name }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: Object
    }
}
</script>