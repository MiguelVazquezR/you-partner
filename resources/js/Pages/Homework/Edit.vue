<template>
  <AppLayout title="Crear Tarea">
    <div class="px-8 mt-3">
      <JetValidationErrors />
      <div class="flex items-center">
        <Link :href="route('homeworks.index')" class="flex items-center text-indigo-600">
        <i class="fas fa-long-arrow-alt-left text-lg"></i>
        <span class="ml-2">Atrás</span>
        </Link>
        <p class="text-xl text-indigo-600 ml-6 font-semibold">
          Editar tarea {{ this.form.id }}
        </p>
      </div>
      <div class="grid grid-cols-2 gap-x-3">
        <div class="mt-3">
          <Label value="Título" />
          <Input v-model="form.title" type="text" class="w-full" />
        </div>
        <div class="mt-3">
          <Label value="Prioridad" />
          <select v-model="form.priority" class="input w-full">
            <option value="" selected>-- Seleccione --</option>
            <option value="Normal">Normal</option>
            <option value="Urgente">Urgente</option>
          </select>
        </div>
        <div class="mt-3">
          <Label value="Descripción" />
          <textarea v-model="form.description" class="input w-full" rows="3"></textarea>
        </div>
        <div class="mt-3">
          <Label value="Materia" />
          <select v-model="form.school_subject_id" class="input w-full">
            <option value="" selected>-- Seleccione --</option>
            <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
              {{ subject.name }}
            </option>
          </select>
        </div>
        <div class="mt-3">
          <Label value="Fecha de entrega" />
          <Input v-model="form.delivery_date" type="date" class="w-full" />
        </div>
        <div class="mt-3">
          <Label value="Archivo" />
          <InputFile class="w-full" />
        </div>
      </div>
      <div>
          <button @click="destroy" class="btn-danger mr-3">
            Eliminar
          </button>
          <button @click="update" class="btn-primary">
            Actualizar
          </button>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Input from "@/Jetstream/Input.vue";
import InputFile from "@/Components/Common/InputFile.vue";
import Label from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import moment from 'moment';

export default {
  data(){
    return {
      form: this.homework,
    }
  },
  components: {
    AppLayout,
    Input,
    InputFile,
    Label,
    JetValidationErrors,
    Link,
  },

  props: {
    subjects: Array,
    homework: Object,
  },
  methods: {
    update() {
      this.$inertia.put(this.route('homeworks.update', this.form), this.homework)
    },
    destroy() {
      this.$inertia.delete(this.route('homeworks.destroy', this.homework))
    },
    deliveryDate(){
        return moment(this.form.delivery_date).format("YYYY-MM-DD")
    }
  }
};
</script>
