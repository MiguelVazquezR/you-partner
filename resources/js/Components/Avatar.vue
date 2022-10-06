<template>
  <div class="flex items-center ml-2">
    <div class="flex items-center py-2">
    <Link href="/profile/1">
      <img
        class="mr-2 w-8 h-8 rounded-full ring-1 ring-offset-2 ring-indigo-400 hover:cursor-pointer"
        :src="user.profile_photo_url"
        :alt="user.name"
      />
        </Link>
      <div class="flex flex-col">
        <p class="text-gray-600 font-semibold text-xs truncate">{{ user.name }}</p>
        <small v-if="secondary_info" class="text-xs text-gray-400">{{ secondary_info }}</small>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  props: {
    user: Object,
    secondary_info: {
        type: String,
        default: null
    },
  },
  components:{
    Link,
  }
};
</script>