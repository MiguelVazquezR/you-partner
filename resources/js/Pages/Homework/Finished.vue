<template>
  <AppLayout title="Mis tareas terminadas">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
        <Tabs :tabs="tabs" />
        <p class="my-4 ml-6">Mis tareas terminadas</p>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
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
    Tabs,
  },
};
</script>