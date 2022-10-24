<template>
  <AppLayout title="Ranking">
 <div class="bg-white dark:bg-slate-900 py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <header class="flex fixed bg-white dark:bg-slate-900 w-full top-[49px] z-50">
        <Tabs :tabs="tabs" class="my-5" />
      </header>
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
          label: "Ranking",
          url: "ranking.index",
        },
        {
          label: "Premios",
          url: "ranking.awards",
        },
        {
          label: "Motivacion",
          url: "ranking.motivation",
        },
        {
          label: "Niveles",
          url: "ranking.levels",
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


