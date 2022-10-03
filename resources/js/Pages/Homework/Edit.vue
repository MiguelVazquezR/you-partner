<template>
  <AppLayout title="Editar tarea">
    <div class="px-8 mt-3">
      <JetValidationErrors />
      <div class="flex items-center">
        <Link :href="route('homeworks.index')" class="flex items-center text-indigo-600">
        <i class="fas fa-long-arrow-alt-left text-lg"></i>
        <span class="ml-2">Atrás</span>
        </Link>
        <p class="text-xl text-indigo-600 ml-6 font-semibold">
          Editar tarea {{form.id}}
        </p>
      </div>
      <form @submit.prevent="update" class="mt-6">
        <div class="lg:grid grid-cols-2 gap-x-3 section-container">
          <div class="mt-3">
            <Label value="Título" />
            <Input v-model="form.title" type="text" class="w-full" />
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
          <div class="mt-3 col-span-2">
            <Label value="Descripción" />
            <textarea v-model="form.description" class="input w-full !h-20"></textarea>
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
            <Label value="Fecha límite de entrega" />
            <Input v-model="form.limit_date.split('T')[0]" type="date" class="w-full" />
          </div>
          <div class="mt-3">
            <Label value="Archivos subidos" />
            <div class="flex flex-col" v-for="(file, index) in media" :key="file.id">
              <a :href="file.original_url" target="_blank" class="text-sm text-indigo-500 hover:underline">{{ file.name }}
                <button
                  @click="removeFile(index)"
                  title="Remover archivo"
                >
                <span class="text-gray-500 ml-2 font-bold text-xs hover:text-red-500"><i class="fa-solid fa-trash-can"></i></span>
                </button>
              </a>
            </div>
          </div>
          <div class="mt-3">
            <Label value="Archivos o recursos de la tarea" />
            <FileUploader @input="form.resources = $event.target.files" />
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
          </div>
        </div>
        <button type="submit" v-if="!form.processing" class="btn-primary mt-4 mr-2">
          Actualizar
        </button>
        <button v-if="!form.processing" class="btn-danger mt-4">
          Eliminar
        </button>
        <p v-else class="text-sm text-gray-400 mt-4">Cargando...</p>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Input from "@/Jetstream/Input.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import FileUploader from "@/Components/Common/FileUploader.vue";
import Label from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    let form = useForm(this.homework);
    form.resources = null;

    return {
      form
    }
  },
  components: {
    AppLayout,
    Input,
    ConfirmationModal,
    FileUploader,
    Label,
    JetValidationErrors,
    Link,
  },

  props: {
    subjects: Array,
    homework: Object,
    resources: Array,
    media: Array,
  },
  methods: {
    update() {
      this.$inertia.post(this.route('homeworks.update', this.homework), {
        _method: 'put',
        title: this.form.title,
        description: this.form.description,
        limit_date: this.form.limit_date,
        priority: this.form.priority,
        user_id: this.$page.props.user.id,
        school_subject_id: this.form.school_subject_id,
        resources: this.form.resources,
      })
    },
    destroy() {
      this.$inertia.delete(this.route('homeworks.destroy', this.homework))
    },
  }
};
</script>
