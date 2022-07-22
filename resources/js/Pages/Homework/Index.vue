<template>
  <AppLayout title="Tareas">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
      <div class="flex justify-end mt-3">
        <Link :href="route('homeworks.create')" class="btn-primary">
          + Crear 
        </Link>
      </div>
      <HomeworkTable :homeworks="homeworks" :filters="filters" filterURL="/homeworks" canEdit canDelete />
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import HomeworkTable from "@/Components/HomeworkTable.vue";
import Tabs from "@/Components/Tabs.vue";

export default {
  data() {
    return {
      tabs: [
        {
          label: "Pendientes",
          url: 'homeworks.index'
        },
        {
          label: "En colaboracion",
          url: 'homeworks.on-collaboration'
        },
        {
          label: "Terminados",
          url: 'homeworks.finished'
        },
      ]
    }
  },
  components: {
    AppLayout,
    Link,
    HomeworkTable,
    Tabs,
  },
  props: {
    homeworks: Object,
    filters: Object,
  },
};
</script>

<style>
</style>