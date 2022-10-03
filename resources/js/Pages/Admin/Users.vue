<template>
  <AppLayout title="Administrador">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
    </div>

  <div class="overflow-y-auto max-h-[85%]">
    <UsersTable :users="users" />
  </div>

  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Tabs from "@/Components/Tabs.vue";
import UsersTable from "@/Components/UsersTable.vue";

export default {
  data() {
    return {
      tabs: [
        {
          label: "Finanzas",
          url: "admin.finances",
        },
        {
          label: "Configuraciones",
          url: "admin.configurations",
        },
        {
          label: "Reclamos",
          url: "admin.claims",
        },
        {
          label: "Notificaciones",
          url: "admin.notifications",
        },
        {
          label: "Usuarios",
          url: "admin.users",
        },
        {
          label: "Errores",
          url: "admin.errors",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Tabs,
    UsersTable,
  },
  props:{
    users: Object,
  }
};
</script>
