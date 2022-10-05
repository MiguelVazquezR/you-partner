<template>
  <div
    class="
      flex flex-col
      w-full
      mx-auto
      divide-y
      px-4
      rounded-md
      divide-gray-400
      bg-white-600
      text-gray-600
    "
  >
    <div class="flex justify-between">
      <Avatar :user="homework_owner" />
      <Avatar :user="$page.props.user" />
    </div>
    <div class="p-2">
      <div class="mt-2">
        <Label value="Costo ($MXN)" />
        <Input v-model="form.price" type="number" class="w-full" />
      </div>
      <div class="mt-2">
        <Label value="Fecha promesa de entrega" />
        <Input v-model="form.promise_date" type="date" class="w-full" />
      </div>
      <textarea
        class="input !h-24 w-full mt-3"
        placeholder="Escribe un comentario (opcional)"
      ></textarea>
    </div>
    <div class="text-right">
      <button class="btn-primary mr-2 mt-3">Aplicar</button>
      <button class="btn-secondary" @click="$emit('cancel')">Cancelar</button>
    </div>
  </div>
</template>


<script>
import Avatar from "@/Components/Avatar.vue";
import Input from "@/Jetstream/Input.vue";
import Label from "@/Jetstream/Label.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  data() {
    const form = useForm({
      price: null,
      promise_date: null,
    });

    return {form};
  },
  components: {
    Avatar,
    Input,
    Label,
  },
  props: {
    homework_owner: Object,
  },
};
</script>
