<script setup>
import SideModal from "@/Jetstream/SideModal.vue";

const emit = defineEmits(["close"]);

defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  maxWidth: {
    type: String,
    default: "sm",
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
  <SideModal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close"
  >
    <div class="px-3 py-2">
      <div class="flex justify-end">
        <button
          class="
            ml-auto
            text-gray-400
            hover:text-red-400 hover:bg-gray-200
            w-8
            h-8
            rounded-full
            transition-colors
            duration-200
          "
        >
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="text-lg">
        <slot name="title" />
      </div>

      <div class="mt-4">
        <slot name="content" />
      </div>
    </div>
  </SideModal>
</template>
