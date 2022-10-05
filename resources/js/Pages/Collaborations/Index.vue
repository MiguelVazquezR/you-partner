<template>
  <AppLayout title="Colaboraciones">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" class="mb-8" />
    </div>
      <AvailableCollaborationsTable 
        :homeworks="homeworks"
        :filters="filters"
        filterURL="/collaborations"
        @details="showDetails($event)"
      />

  </AppLayout>
  <DetailsModal :show="side_modal" @close="side_modal = false">
      <template #title>
        <div class="flex flex-col">
          <h1 class="text-indigo-600 text-xl font-semibold">
            {{ homework_detail.title }}
          </h1>
          <div class="flex justify-between">
            <small class="text-indigo-400 text-xs">
              <i class="fa-solid fa-tag"></i>
              {{ homework_detail.school_subject.name }}
            </small>
            <small
              class="text-xs px-2 rounded-md"
              :class="
                homework_detail.priority === 'Urgente'
                  ? 'text-red-700 bg-red-100'
                  : 'text-green-700 bg-green-100'
              "
              :title="'Prioridad: ' + homework_detail.priority"
            >
              Entrega: {{ homework_detail.limit_date }}
            </small>
          </div>
        </div>
      </template>
      <template #content>
        <section class="mt-3">
          <div>
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-circle-info mr-2"></i>
              <span>Descripción</span>
            </h1>
            <div>
              <p class="text-sm text-gray-500">
                {{ homework_detail.description }}
              </p>
            </div>
          </div>

          <div class="mt-6">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-paperclip mr-2"></i>
              <span>Archivos adjuntos</span>
            </h1>
            <div v-if="homework_detail.media.length" class="mt-1 flex flex-col">
              <AttachedFile
                v-for="(file, index) in homework_detail.media"
                :key="index"
                :name="file.name"
                :extension="file.mime_type.split('/')[1]"
                :href="file.original_url"
              />
            </div>
            <p v-else class="text-center text-gray-400 text-xs pt-3">
              No hay recursos para esta tarea
            </p>
          </div>
        </section>
      </template>
      <template #footer>
        <div class="flex">
        <DropupButton>
        <template #links>
          <a href="#mensajes" class="dropup-link">Mensajes</a>
          <a href="#colaborar" class="dropup-link">Colaborar</a>
        </template>
        </DropupButton>
          <button @click="side_modal = false" class="btn-secondary mx-2">
            Cerrar
          </button>
        </div>
      </template>
    </DetailsModal>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Tabs from "@/Components/Tabs.vue";
import DetailsModal from "@/Components/DetailsModal.vue";
import AvailableCollaborationsTable from "@/Components/AvailableCollaborationsTable.vue";
import DropupButton from "@/Components/DropupButton.vue";

export default {
  data() {
    return {
      homework_detail: {},
      side_modal: false,
      tabs: [
        {
          label: "Disponible",
          url: "collaborations.index",
        },
        {
          label: "Mis colaboraciones",
          url: "collaborations.my-collaborations",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Link,
    Tabs,
    DetailsModal,
    AvailableCollaborationsTable,
    DropupButton,
  },
  props: {
    homeworks: Object,
    filters: Object,
  },
  methods:{
     showDetails(item) {
      this.homework_detail = item;
      this.side_modal = true;
    },
  }
};
</script>