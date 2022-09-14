<template>
  <i
    v-if="!collaboration"
    class="fa-solid fa-bullseye text-red-300"
    title="Sin colaboración"
  ></i>
  <i
    v-else-if="collaboration.completed_date"
    class="fa-solid fa-check text-green-300"
    title="Terminado"
  ></i>
  <i v-else class="fa-solid fa-spinner text-yellow-300" title="En proceso"></i>
</template>

<script>
export default {
  props: {
    collaboration: Object,
  },
};
</script>