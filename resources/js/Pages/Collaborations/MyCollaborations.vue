<template>
  <AppLayout title="Mis colaboraciones">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
        <Tabs :tabs="tabs" />
        <CollaborationTable :collaborations="collaborations" :filters="filters" filterURL="/collaborations/my-collaborations" />
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Tabs from "@/Components/Tabs.vue";
import CollaborationTable from "@/Components/CollaborationTable.vue";

export default {
  data() {
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
    Tabs,
    CollaborationTable,
  },
  props: {
    collaborations: Object,
    filters: Object,
  }
};
</script>