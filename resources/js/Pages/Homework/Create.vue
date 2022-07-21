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
          Crear nueva tarea
        </p>
      </div>
      <div class="grid grid-cols-2 gap-x-3">
        <div class="mt-3">
          <Label value="Título" />
          <Input v-model="homework.title" type="text" class="w-full" />
        </div>
        <div class="mt-3">
          <Label value="Prioridad" />
          <select v-model="homework.priority" class="input w-full">
            <option value="" selected>-- Seleccione --</option>
            <option value="Normal">Normal</option>
            <option value="Urgente">Urgente</option>
          </select>
        </div>
        <div class="mt-3">
          <Label value="Descripción" />
          <textarea v-model="homework.description" class="input w-full" rows="3"></textarea>
        </div>
        <div class="mt-3">
          <Label value="Materia" />
          <select v-model="homework.school_subject_id" class="input w-full">
            <option value="" selected>-- Seleccione --</option>
            <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
              {{ subject.name }}
            </option>
          </select>
        </div>
        <div class="mt-3">
          <Label value="Fecha de entrega" />
          <Input v-model="homework.delivery_date" type="date" class="w-full" />
        </div>
        <div class="mt-3">
          <Label value="Archivo" />
          <InputFile class="w-full" />
        </div>
      </div>
      <button @click="store" class="btn-primary">
        Crear
      </button>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Input from "@/Jetstream/Input.vue";
import InputFile from "@/Components/Common/InputFile.vue";
import Label from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue"

export default {
  data(){
    return {
      homework: {
        title: "",
        description: "",
        delivery_date: "",
        priority: "",
        user_id: this.$page.props.user.id,
        school_subject_id: "",
      }
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
  },
  methods: {
    store() {
      this.$inertia.post(this.route('homeworks.store'), this.homework)
    },
  }
};
</script>
