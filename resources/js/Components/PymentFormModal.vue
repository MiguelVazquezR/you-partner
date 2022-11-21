<template>
  <ValidationErrors />
  <form
    @submit.prevent="sendHomework"
    class="
      container
      flex flex-col
      w-full
      mx-auto
      px-4
      rounded-md
      bg-white-600
      text-gray-600
    "
  >
    <div class="mt-3">
      <Label value="Numero de tarjeta" class="mb-1" />
      <Input v-model="form.bank_number" type="text" class="w-full" required />
    </div>
    <div class="mt-3">
      <Label value="Nombre de banco" class="mb-1" />
      <Input v-model="form.bank_name" type="text" class="w-full" required />
    </div>
    <p class="mt-3 px-2">
      Recuerda que la plataforma retiene un {{ collaboration.tax }}% de tu pago
      por el uso de la misma (pago neto: ${{ total }}).
    </p>
    <div class="text-right mt-3">
      <button class="btn-primary mx-2" v-if="!form.processing">
        Enviar
      </button>
      <button class="btn-primary mr-2" disabled v-else>
        Cargando...
        <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
      </button>
      <button type="button" class="btn-secondary mx-2" @click="$emit('cancel')">
        Cancelar
      </button>
    </div>
  </form>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import ValidationErrors from "@/Jetstream/ValidationErrors.vue";
import Label from "@/Jetstream/Label.vue";
import Input from "@/Jetstream/Input.vue";

export default {
  data() {
    const form = useForm({
      completed_comments: null,
      resources: null,
      collaboration_id: this.collaboration.id,
    });

    return { form };
  },
  emits: ["cancel"],
  components: {
    ValidationErrors,
    Label,
    Input,
  },
  props: {
    collaboration: Object,
  },
  computed: {
    total() {
      return this.collaboration.price * ((100 - this.collaboration.tax) / 100);
    },
  },
  methods: {
    sendData() {
      this.form.post(route("collaborations.update-p"));
    },
  },
};
</script>
