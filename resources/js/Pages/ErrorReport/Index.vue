<template>
  <AppLayout title="Errores y Sugerencias">
    <div class="px-8 mt-3">
      <div class="flex items-center">
        <Link :href="route('errors.index')" class="flex items-center text-indigo-600">
        <i class="fas fa-long-arrow-alt-left text-lg"></i>
        <span class="ml-2">Atrás</span>
        </Link>
        <p class="text-xl text-indigo-600 ml-6 font-semibold">
          Reportar error/Dejar sugerencia
        </p>
      </div>
      <form @submit.prevent="store" class="mt-6">
        <div class="lg:grid grid-cols-2 gap-x-3 section-container">
          <div class="mt-3">
            <Label value="Título" />
            <Input v-model="form.title" type="text" class="w-full" />
          </div>
          <div class="mt-3 col-span-2">
            <Label value="Descripción" />
            <textarea v-model="form.description" class="input w-full !h-20"></textarea>
          </div>
          <div class="mt-3 col-span-2 w-1/2 mx-auto">
            <Label value="Archivos evidencia" />
            <FileUploader @input="form.resources = $event.target.files" />
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
          </div>
        </div>
        <button type="submit" v-if="!form.processing" class="btn-primary mt-4">
          Crear
        </button>
        <p v-else class="text-sm text-gray-400 mt-4">Cargando...</p>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import Input from "@/Jetstream/Input.vue";
import InputFile from "@/Components/Common/InputFile.vue";
import FileUploader from "@/Components/Common/FileUploader.vue";
import Label from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue"

export default {
  data() {
 
        const form = useForm({
        title: null,
        description: null,
        limit_date: null,
        priority: "",
        user_id: this.$page.props.user.id,
        school_subject_id: "",
        resources: null,
      })

      return {form}
     
  },
  components: {
    AppLayout,
    Input,
    InputFile,
    FileUploader,
    Label,
    JetValidationErrors,
    Link,
  },
  props: {

  },
  methods: {
     store() {
      this.form.post(this.route('homeworks.store'));
    },
  }
};
</script>