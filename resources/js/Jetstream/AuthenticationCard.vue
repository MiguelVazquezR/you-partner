<template>
  <div
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-200"
  >
    <div>
      <slot name="logo" />
    </div>

    <div class="relative mt-20">
      <div
        class="w-32 h-32 rounded-full bg-gray-300 opacity-90 absolute -top-16 right-0 border border-indigo-400"
      >
      </div>
      <div class="absolute -top-8 right-8">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-person text-gray-500" viewBox="0 0 16 16">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        </svg>
      </div>
      <div
        class="w-24 h-24 rounded-full bg-gray-300 opacity-90 absolute -top-20 right-24 border border-indigo-400"
      ></div>
      <div class="w-24 h-24 absolute -top-[8.3rem] right-[4.5rem]">
        <JetApplicationMark class="w-1/2" />
      </div>
      <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-400 shadow-md overflow-hidden sm:rounded-lg border-2 border-indigo-400"
      >
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";

export default {
  components: {
    JetApplicationMark,
  },
};
</script>
