<template>
  <AppLayout title="Colaboraciones">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" class="mb-8" />
      <HomeworkTable :homeworks="homeworks" :filters="filters" filterURL="/collaborations" withAvatar />
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import HomeworkTable from "@/Components/HomeworkTable.vue";
import Tabs from "@/Components/Tabs.vue";

export default {
  data(){
    return {
      tabs: [
        {
          label: "Disponible",
          url: 'collaborations.index'
        },
        {
          label: "Mis colaboraciones",
          url: 'collaborations.my-collaborations'
        }
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