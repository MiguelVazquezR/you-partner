<template>
  <AppLayout title="Mis tareas en colaboración">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
        <Tabs :tabs="tabs" />
        <HomeworkTable :homeworks="homeworks" :filters="filters" filterURL="/homeworks/on-collaboration" withAvatar />
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Tabs from "@/Components/Tabs.vue";
import HomeworkTable from "@/Components/HomeworkTable.vue";

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
    Tabs,
    HomeworkTable,
  },
  props: {
    homeworks: Object,
    filters: Object,
  },
};
</script>