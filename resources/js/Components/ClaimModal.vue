<template>
  <div class="container mt-2">
    <h1 class="text-justify text-red-500 font-bold text-xs">
      Antes de iniciar el reclamo, asegúrate de tener evidencias y explica bien
      tu inconformidad para poder evaluar con más rapidéz tu caso. Si nos
      percatamos de que la/el colaborador(a) hizo bien su trabajo pero quieres
      sacar ventaja, se te pondrá un punto malo. Al acumular 3 puntos malos, se
      suspenderá tu cuenta permanentemente.
      <a
        :href="route('terms-of-service')"
        target="_blank"
        class="text-blue-400 hover:text-blue-300"
      >
        Ver condiciones de reembolsos
      </a>
    </h1>
  </div>

  <div
    class="
      container
      flex flex-col
      w-full
      px-2
      mt-2
      rounded-md
      divide-gray-400
      dark:bg-gray-900 dark:text-gray-100
    "
  >
    <Avatar :user="collaborator" secondary_info="Colaborador" />

    <div class="p-2 text-center border-b">
      <textarea
        class="input !h-28 w-full"
        placeholder="Escribe un comentario"
      ></textarea>
    </div>
    <div class="text-right mt-3">
      <button class="btn-primary mr-2">Enviar</button>
      <button @click="$emit('cancel')" class="btn-secondary">Cancelar</button>
    </div>
  </div>
</template>

<script>
import Avatar from "@/Components/Avatar.vue";
import FileUploader from "@/Components/Common/FileUploader.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  data() {
    return {};
  },
  components: {
    Avatar,
    FileUploader,
    Link,
  },
  props: {
    collaborator: Object
  },
};
</script>
