<script setup>
import Modal from "./Modal.vue";

const emit = defineEmits(["close"]);

defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  maxWidth: {
    type: String,
    default: "2xl",
  },
  closeable: {
    type: Boolean,
    default: true,
  },
});

const close = () => {
  emit("close");
};
</script>

<template>
  <Modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close"
  >
    <div class="px-6 py-4 dark:bg-slate-900">
      <div class="text-lg flex justify-between">
        <slot name="title" />
        <button
          @click="close"
          class="
            ml-auto
            text-gray-400
            hover:text-red-400 hover:bg-gray-200
            dark:text-gray-500
            dark:hover:text-red-700 dark:hover:bg-slate-800
            w-8
            h-8
            flex
            items-center
            justify-center
            rounded-full
            transition-colors
            duration-200
          "
        >
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="mt-4">
        <slot name="content" />
      </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right dark:bg-slate-700">
      <slot name="footer" />
    </div>
  </Modal>
</template>
