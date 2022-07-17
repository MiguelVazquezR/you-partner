<template>
  <AppLayout title="Crear Tarea">
    <div class="px-8 mt-3">
      <div class="flex items-center">
        <Link
          :href="route('homework.index')"
          class="flex items-center text-indigo-600"
        >
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
          <Input type="text" class="w-full" />
        </div>
        <div class="mt-3">
          <Label value="Prioridad" />
          <select class="input w-full">
            <option value="" selected>-- Seleccione --</option>
            <option value="Normal">Normal</option>
            <option value="Urgente">Urgente</option>
          </select>
        </div>
        <div class="mt-3">
          <Label value="Descripción" />
          <textarea class="input w-full" rows="3"></textarea>
        </div>
        <div class="mt-3">
          <Label value="Materia" />
          <select class="input w-full">
            <option value="" selected>-- Seleccione --</option>
            <option
              v-for="subject in subjects"
              :key="subject.id"
              value="subject.id"
            >
              {{ subject.name }}
            </option>
          </select>
        </div>
        <div class="mt-3">
          <Label value="Fecha de entrega" />
          <Input type="date" class="w-full" />
        </div>
        <div class="mt-3">
          <Label value="Archivo" />
          <InputFile class="w-full" />
        </div>
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

export default {
  components: {
    AppLayout,
    Input,
    InputFile,
    Label,
    Link,
  },

  props: {
    subjects: Array,
  },
};
</script>
