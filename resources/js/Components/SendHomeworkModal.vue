<template>
  <div
    class="
      container
      flex flex-col
      w-full
      mx-auto
      px-4
      divide-y
      rounded-md
      divide-gray-400
      bg-white-600
      text-gray-600
    "
  >
    <div class="px-4">
      <div class="flex justify-between">
        <Avatar :user="homework_owner" />
        <Avatar :user="$page.props.user" />
      </div>
    </div>
    <!-- <FileUploader /> -->
    <div class="p-3 text-center">
      <textarea
        class="input !h-28 w-3/4"
        placeholder="Escribe un comentario"
        required
      ></textarea>
      <input class="m-4" type="file" required />
    </div>
    <div class="text-right">
      <button class="btn-primary mx-2 my-4">Enviar</button>
      <button class="btn-secondary mx-2">Cancelar</button>
    </div>
  </div>
</template>


<script>
import Avatar from "@/Components/Avatar.vue";
import RatingStars from "@/Components/RatingStars.vue";
import FileUploader from "@/Components/Common/FileUploader.vue";

export default {
  data() {
    return {};
  },
  components: {
    Avatar,
    RatingStars,
    FileUploader,
  },
  props: {
    homework_owner: Object,
  },
};
</script>
