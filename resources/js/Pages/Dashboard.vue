<template>
  <AppLayout title="Panel de información">
    <div class="px-8 py-5">
      <h1 class="text-gray-500 text-2xl font-bold">Mis tareas</h1>
      <div class="mt-3 grid grid-cols-4 gap-5">
        <!-- homeworks uploaded this month -->
        <DashboardPanel :items="completed_homeworks">
          <template #title>
            <p>Tareas subidas este mes</p>
          </template>
          <template #content>
            <h2 class="text-3xl font-bold">
              {{ homeworks_uploaded_this_month }}
            </h2>
            <small class="text-gray-400">
              Mes pasado: {{ homeworks_uploaded_prev_month }}
            </small>
          </template>
        </DashboardPanel>
        <!-- All homeworks uploaded -->
        <DashboardPanel :items="completed_homeworks">
          <template #title>
            <p>Total tareas subidas</p>
          </template>
          <template #content>
            <h2 class="text-3xl font-bold">
              {{ all_homeworks_uploaded }}
            </h2>
            <small class="text-gray-400">Desde {{ $page.props.user.created_at }}</small>
          </template>
        </DashboardPanel>
      </div>
      <div class="mt-3 grid grid-cols-2 gap-5">
        <!-- homeworks about to expire -->
        <DashboardPanel :items="homework_expired" size="lg">
          <template #title>
            <p>Tareas próximas a vencer</p>
          </template>
          <template #content>
            <div v-for="item in homework_expired" :key="item.id">
              {{ item.limit_date }} -
              <StatusIcon :collaboration="item.collaboration" />
              {{ item.title }}
            </div>
          </template>
        </DashboardPanel>
        <!-- new comments or questions -->
        <DashboardPanel :items="unread_messages" size="lg">
          <template #title>
            <p>Nuevos comentarios y/o preguntas</p>
          </template>
          <template #content>
            <div v-for="item in unread_messages" :key="item.id">
              <div class="grid grid-cols-2 gap-x-3">
              <Avatar :user="item.user" :secondary_info="item.created_at" />
              <p>{{ item.content }}</p>
              </div>
            </div>
          </template>
        </DashboardPanel>
        <!-- homeworks recently completed (last 24 hrs) -->
        <DashboardPanel :items="completed_homeworks" size="lg">
          <template #title>
            <p>Tareas recientemente completadas</p>
          </template>
          <template #content>
            <div v-for="item in completed_homeworks" :key="item.id">
              {{ item.name }}
            </div>
          </template>
        </DashboardPanel>
        <!-- new collaboration applies -->
        <DashboardPanel :items="completed_homeworks" size="lg">
          <template #title>
            <p>Nuevos aplicantes para colaborar</p>
          </template>
          <template #content>
            <div v-for="item in completed_homeworks" :key="item.id">
              {{ item.name }}
            </div>
          </template>
        </DashboardPanel>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardPanel from "@/Components/DashboardPanel.vue";
import StatusIcon from "@/Components/StatusIcon.vue";
import Avatar from "@/Components/Avatar.vue";

export default {
  data() {
    return {
      completed_homeworks: [1],
    };
  },
  components: {
    AppLayout,
    DashboardPanel,
    StatusIcon,
    Avatar,
  },
  props: {
    homework_expired: Array,
    homeworks_uploaded_this_month: String,
    homeworks_uploaded_prev_month: String,
    all_homeworks_uploaded: String,
    unread_messages: Array,
  },
};
</script>