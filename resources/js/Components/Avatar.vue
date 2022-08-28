<template>
  <div class="flex items-center ml-2">
    <div class="flex items-center py-2">
      <img
        class="mr-2 w-8 h-8 rounded-full ring-1 ring-offset-2 ring-indigo-400"
        :src="user.profile_photo_url"
        :alt="user.name"
      />
      <div class="flex flex-col">
        <p class="text-gray-600 font-semibold text-xs">{{ user.name }}</p>
        <small v-if="secondary_info" class="text-xs text-gray-400">{{ secondary_info }}</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: Object,
    secondary_info: {
        type: String,
        default: null
    },
  },
};
</script>