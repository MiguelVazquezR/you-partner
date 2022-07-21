<template>
  <AppLayout title="Tareas">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
      <div class="flex justify-end mt-3">
        <Link :href="route('homework.create')" class="btn-primary">
          + Crear 
        </Link>
      </div>
      <HomeworkTable :homeworks="homework" :filters="filters" filterURL="/homework" />
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
          url: 'homework.index'
        },
        {
          label: "En colaboracion",
          url: 'homework.create'
        },
        {
          label: "Terminados",
          url: 'homework.create'
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
    homework: Object,
    filters: Object,
  },
};
</script>

<style>
</style>