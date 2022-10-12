<template>
  <JetValidationErrors />
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
      <RatingStars @selected="form.stars = $event" />
    </div>
    <div class="p-4 space-y-2 text-sm dark:text-gray-400">
      <div class="grid grid-cols-2">
        <div class="mx-5">
          <p class="my-1">Fecha limite de entrega</p>
          <p class="my-1">Empezado el</p>
          <p class="my-1">Entregado el</p>
          <p class="my-1">Costo</p>
        </div>
        <div class="mx-5">
          <p class="my-1 font-semibold">{{ homework.limit_date }}</p>
          <p class="my-1 font-semibold">
            {{ homework.approved_collaboration.approved_at.special }}
          </p>
          <p class="my-1 font-semibold">
            {{ homework.approved_collaboration.completed_date }}
          </p>
          <p class="my-1 font-semibold">
            ${{ homework.approved_collaboration.price }}
          </p>
        </div>
      </div>
      <textarea
        v-model="form.comments"
        class="input !h-28 w-full"
        placeholder="Escribe un comentario"
      ></textarea>
    </div>
    <div class="text-right pt-3">
      <button @click="rate" v-if="!form.processing" class="btn-primary mr-2">
        Calificar
      </button>
      <button v-else class="btn-primary mr-2" disabled>
        Calificando...
        <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
      </button>
      <button @click="$emit('cancel')" class="btn-secondary">Cancelar</button>
    </div>
  </div>
</template>


<script>
import Avatar from "@/Components/Avatar.vue";
import RatingStars from "@/Components/RatingStars.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    const form = useForm({
      stars: 0,
      comments: "",
      collaboration_id: this.homework.approved_collaboration.id,
    });

    return { form };
  },
  components: {
    Avatar,
    RatingStars,
    JetValidationErrors,
  },
  props: {
    homework: Object,
  },
  methods: {
    rate() {
      this.form.post(route('rates.store'), {
        onSuccess: () => this.$emit('cancel'),
      });
    },
  },
};
</script>
