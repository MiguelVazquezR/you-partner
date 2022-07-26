<template>
  <AppLayout title="Panel de información">
    <div class="px-4 py-3 grid grid-cols-3 gap-5">
      <DashboardPanel :items="completed_homeworks">
        <template #title>
          <p>Tareas recién terminadas</p>
        </template>
        <template #content>
          <div v-for="item in completed_homeworks" :key="item.id">
            {{ item.name }}
          </div>
        </template>
      </DashboardPanel>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardPanel from "@/Components/DashboardPanel.vue";

export default {
  data() {
    return {
      completed_homeworks: [
        // {
        //   id: 1,
        //   name: "Ecuaciones diferenciales de segundo orden",
        // },
        // {
        //   id: 5,
        //   name: "Presentación sobre Animales marinos",
        // },
      ],
    }
  },
  components: {
    AppLayout,
    DashboardPanel,
  }
}
</script>