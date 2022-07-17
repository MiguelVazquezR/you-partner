<template>
  <AppLayout title="Colaboraciones">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
      <HomeworkTable :homeworks="homework" />
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
          label: "Todo",
          url: 'collaborations.index'
        },
        {
          label: "Mis colaboraciones",
          url: 'homework.index'
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
    homework: Object,
  },
};
</script>