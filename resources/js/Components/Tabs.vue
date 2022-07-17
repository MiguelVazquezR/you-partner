<template>
  <div class="flex items-center dark:bg-gray-800 dark:text-gray-100">
    <Link
      v-for="(tab, key) in tabs"
      :key="key"
      :href="route(tab.url)"
      :class="route().current(tab.url) ? 'border-indigo-400 text-indigo-400' : ''"
      class="px-5 py-1 border-b-2 dark:border-gray-700"
      v-html="tab.label"
    />
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  props: {
    tabs: Array,
  },
};
</script>
