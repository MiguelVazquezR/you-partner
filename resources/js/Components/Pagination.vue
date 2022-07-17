<template>
  <nav
    aria-label="Pagination"
    class="
      inline-flex
      -space-x-px
      rounded-md
      shadow-sm
      dark:bg-gray-800 dark:text-gray-100
      mb-2
    "
  >
    <template v-for="(link, key) in pagination.links">
      <div
        :key="key"
        v-if="link.url == null"
        class="
          inline-flex
          items-center
          px-3
          py-2
          text-sm
          border
          text-gray-400
          dark:border-gray-700
        "
        v-html="link.label"
      ></div>
      <Link
        :key="'link-' + key"
        v-else
        :href="link.url"
        class="
          inline-flex
          items-center
          px-3
          py-2
          text-sm
          font-semibold
          border
          dark:border-gray-700"
		  :class="link.active ? 'bg-indigo-200 text-gray-900 dark:bg-indigo-200 dark:text-gray-900' : ''"
        v-html="link.label" />
    </template>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  props: {
    pagination: Object,
  },
};
</script>

<style>
</style>