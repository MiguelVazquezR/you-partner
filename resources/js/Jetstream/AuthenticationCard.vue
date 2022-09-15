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
