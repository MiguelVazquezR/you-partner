<template>
  <div
    class="
      container
      flex flex-col
      w-full
      p-2
      pb-0
      mx-auto
      divide-y
      rounded-md
      divide-gray-400
      dark:bg-gray-900 dark:text-gray-100
    "
  >
    <div class="flex justify-around items-center px-3 py-1">
      <Avatar :user="homework.approved_collaboration.user" />
      <RatingStars />
    </div>
    <div class="p-4 space-y-2 text-sm dark:text-gray-400">
      <div class="grid grid-cols-2">
        <div class="col-start-1 mx-5">
          <p class="my-1">{{ "Fecha limite de entrega" }}</p>
          <p class="my-1">{{ "Empezado el" }}</p>
          <p class="my-1">{{ "Entregado el" }}</p>
          <p class="my-1">{{ "Costo" }}</p>
        </div>
        <div class="col-start-2 mx-5">
          <p class="my-1 font-semibold">{{ "30 sep., 2022" }}</p>
          <p class="my-1 font-semibold">{{ "26 sep., 2022" }}</p>
          <p class="my-1 font-semibold">{{ "29 sep., 2022" }}</p>
          <p class="my-1 font-semibold">{{ "$300.00" }}</p>
        </div>
      </div>
      <textarea
        class="input !h-28 w-full"
        placeholder="Escribe un comentario"
      ></textarea>
    </div>
    <div class="text-right pt-3">
      <button class="btn-primary mr-2">Puntuar</button>
      <button class="btn-secondary">Cancelar</button>
    </div>
  </div>
</template>


<script>
import Avatar from "@/Components/Avatar.vue";
import RatingStars from "@/Components/RatingStars.vue";

export default {
  data() {
    return {};
  },
  components: {
    Avatar,
    RatingStars,
  },
  props: {
    homework: Object,
  },
};
</script>
