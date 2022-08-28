<template>
  <AppLayout title="Tareas">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
      <div class="flex justify-end mt-3">
        <Link :href="route('homeworks.create')" class="btn-primary">
          + Crear
        </Link>
      </div>
      <HomeworkTable
        :homeworks="homeworks"
        :filters="filters"
        filterURL="/homeworks"
        canEdit
        canDelete
        @details="showDetails($event)"
      />
    </div>
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
            <small class="text-xs px-2 bg-red-100 text-red-400 rounded-md">
              Entrega: {{ homework_detail.delivery_date.split("T")[0] }}
            </small>
          </div>
        </div>
      </template>
      <template #content>
        <section class="mt-3">
          <div>
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-comment-dots mr-2"></i>
              <span>Preguntas y comentarios</span>
            </h1>
            <div class="border rounded-md border-dotted max-h-[35vh] min-h-[10vh] overflow-y-auto px-1 py-2 divide-y">
              <div v-for="item in [1,2,3,4,5,6,7,8,9]" :key="item" class="grid grid-cols-2 gap-x-2">
                <Avatar :user="$page.props.user" secondary_info="Hace 3 horas" />
                <p class="text-xs text-gray-600">Hola amigo he visto tu tarea y yo puedo ayudarte... 
                  <span class="text-blue-400 cursor-pointer">Ver</span> </p>
              </div>
            </div>
          </div>
        </section>
      </template>
      <template #footer>
        <div class="flex">
          <button class="btn-primary mr-3">Guardar</button>
          <button class="btn-secondary">Cancelar</button>
        </div>
      </template>
    </DetailsModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import HomeworkTable from "@/Components/HomeworkTable.vue";
import Tabs from "@/Components/Tabs.vue";
import DetailsModal from "@/Components/DetailsModal.vue";
import Avatar from "@/Components/Avatar.vue";

export default {
  data() {
    return {
      homework_detail: {},
      side_modal: false,
      tabs: [
        {
          label: "Pendientes",
          url: "homeworks.index",
        },
        {
          label: "En colaboracion",
          url: "homeworks.on-collaboration",
        },
        {
          label: "Terminados",
          url: "homeworks.finished",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Link,
    HomeworkTable,
    Tabs,
    DetailsModal,
    Avatar,
  },
  props: {
    homeworks: Object,
    filters: Object,
  },
  methods: {
    showDetails(event) {
      this.homework_detail = event;
      this.side_modal = true;
    },
  },
};
</script>
