<template>
  <AppLayout title="Ranking">
 <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
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
          label: "Colaboraciones",
          url: "ranking.byCollaborations",
        },
        {
          label: "Tareas subidas",
          url: "ranking.byHomeworks",
        },
        {
          label: "Puntos",
          url: "ranking.byPoints",
        },
        {
          label: "Calificaciones",
          url: "ranking.byRatings",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Tabs,
  }
};
</script>


