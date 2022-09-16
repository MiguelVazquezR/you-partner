<template>
  <AppLayout title="Panel de información">
    <div class="px-8 py-5">
      <h1 class="text-gray-500 text-2xl font-bold">Mis tareas</h1>
      <div>
        <div class="mt-3 lg:grid grid-cols-4 gap-5 space-y-4 lg:space-y-0">
          <!-- homeworks uploaded this month -->
          <DashboardPanelSmall>
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
          </DashboardPanelSmall>
          <!-- All homeworks uploaded -->
          <DashboardPanelSmall>
            <template #title>
              <p>Total tareas subidas</p>
            </template>
            <template #content>
              <h2 class="text-3xl font-bold">
                {{ all_homeworks_uploaded }}
              </h2>
              <small class="text-gray-400"
                >Desde {{ $page.props.user.created_at }}</small
              >
            </template>
          </DashboardPanelSmall>
        </div>
        <div class="mt-3 lg:grid grid-cols-2 gap-5 space-y-4 lg:space-y-0">
          <!-- homeworks about to expire -->
          <DashboardPanel :items="homework_expired">
            <template #title>
              <p>Tareas vencidas y próximas a vencer</p>
            </template>
            <template #content>
              <div v-for="item in homework_expired" :key="item.id">
                <div
                  class="
                    grid grid-cols-4
                    gap-x-3
                    hover:bg-indigo-50
                    cursor-pointer
                    px-2
                    py-1
                    rounded-md
                  "
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :collaboration="item.collaboration" />
                    {{ item.title }}
                  </span>
                  <span class="text-gray-400 text-right"
                    >{{ item.id }} días</span
                  >
                </div>
              </div>
            </template>
          </DashboardPanel>
          <!-- new comments or questions -->
          <DashboardPanel :items="unread_messages">
            <template #title>
              <p>Mensajes sin leer de mis tareas</p>
            </template>
            <template #content>
              <div v-for="item in unread_messages" :key="item.id">
                <div
                  class="
                    grid grid-cols-2
                    gap-x-3
                    hover:bg-indigo-50
                    cursor-pointer
                    px-2
                    py-1
                    rounded-md
                  "
                >
                  <Avatar :user="item.user" :secondary_info="item.created_at" />
                  <span class="mt-2 truncate">{{ item.content }}</span>
                </div>
              </div>
            </template>
          </DashboardPanel>
          <!-- homeworks recently completed (last 24 hrs) -->
          <DashboardPanel :items="homeworks_recently_completed">
            <template #title>
              <p>Tareas recientemente completadas</p>
            </template>
            <template #content>
              <div v-for="item in homeworks_recently_completed" :key="item.id">
                <div
                  class="
                    grid grid-cols-4
                    gap-x-3
                    hover:bg-indigo-50
                    cursor-pointer
                    px-2
                    py-1
                    rounded-md
                  "
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :collaboration="item.collaboration" />
                    {{ item.title }}
                  </span>
                  <span class="text-gray-400 text-right">
                    <i class="fa-solid fa-paperclip"></i>
                    1
                  </span>
                </div>
              </div>
            </template>
          </DashboardPanel>
          <!-- new collaboration applies -->
          <DashboardPanel :items="apllies_to_collaborate">
            <template #title>
              <p>Nuevos aplicantes para colaborar</p>
            </template>
            <template #content>
              <div v-for="item in apllies_to_collaborate" :key="item.id">
                <div
                  class="
                    grid grid-cols-2
                    gap-x-3
                    hover:bg-indigo-50
                    cursor-pointer
                    px-2
                    py-1
                    rounded-md
                  "
                >
                  <Avatar
                    :user="item.collaboration.user"
                    :secondary_info="item.collaboration.created_at"
                  />
                  <span class="mt-2 truncate text-sm">{{ item.title }}</span>
                </div>
              </div>
            </template>
          </DashboardPanel>
        </div>
      </div>
      <h1 class="text-gray-500 text-2xl font-bold mt-10">Mis Colaboraciones</h1>
      <div>
        <div class="mt-3 lg:grid grid-cols-4 gap-5 space-y-4 lg:space-y-0">
          <!-- profit this month -->
          <DashboardPanelSmall>
            <template #title>
              <p>Ganancias este mes</p>
            </template>
            <template #content>
              <div class="font-bold flex justify-between items-center">
                <span class="text-2xl"> ${{ profit_month }} </span>
                <span class="text-red-500 text-xl">
                  <i class="fa-solid fa-caret-down"></i>
                  50%
                </span>
              </div>
              <small class="text-gray-400"> Mes pasado: $6,800.00 </small>
            </template>
          </DashboardPanelSmall>
          <!-- money locked -->
          <DashboardPanelSmall>
            <template #title>
              <p>Dinero por liberar</p>
            </template>
            <template #content>
              <div class="font-bold flex justify-between items-center">
                <span class="text-2xl"> $342.00 </span>
              </div>
              <small class="text-gray-400"> De 1 colaboración(es) </small>
            </template>
          </DashboardPanelSmall>
          <!-- Total profit -->
          <DashboardPanelSmall>
            <template #title>
              <p>Ganancias totales</p>
            </template>
            <template #content>
              <div class="font-bold flex justify-between items-center">
                <span class="text-2xl"> $15,890.15 </span>
              </div>
              <small class="text-gray-400"> Desde 22 Julio, 2021 </small>
            </template>
          </DashboardPanelSmall>
        </div>
        <div class="mt-3 lg:grid grid-cols-2 gap-5 space-y-4 lg:space-y-0">
          <!-- Collaborations in process -->
          <DashboardPanel :items="collaborations_in_process">
            <template #title>
              <p>Colaboraciones en proceso</p>
            </template>
            <template #content>
              <div v-for="item in collaborations_in_process" :key="item.id">
                <div
                  class="
                    grid grid-cols-4
                    gap-x-3
                    hover:bg-indigo-50
                    cursor-pointer
                    px-2
                    py-1
                    rounded-md
                  "
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :collaboration="item" />
                    {{ item.homework.title }}
                  </span>
                  <span class="text-gray-400 text-right"
                    ><i
                      class="fa-solid fa-calendar-day"
                      title="Fecha promesa"
                    ></i>
                    {{ item.promise_date.split("T")[0] }}</span
                  >
                </div>
              </div>
            </template>
          </DashboardPanel>
          <!-- collaborations to approve -->
          <DashboardPanel :items="collaborations_to_approve">
            <template #title>
              <p>Colaboraciones esperando aprobación</p>
            </template>
            <template #content>
              <div v-for="item in collaborations_to_approve" :key="item.id">
                <div
                  class="
                    grid grid-cols-4
                    gap-x-3
                    hover:bg-indigo-50
                    cursor-pointer
                    px-2
                    py-1
                    rounded-md
                  "
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :collaboration="item" />
                    {{ item.homework.title }}
                  </span>
                  <span class="text-gray-400 text-right"
                    ><i
                      class="fa-solid fa-calendar-day"
                      title="Fecha aplicación"
                    ></i>
                    {{ item.created_at.split("T")[0] }}</span
                  >
                </div>
              </div>
            </template>
          </DashboardPanel>
          <!-- unread messages -->
          <DashboardPanel :items="unread_messages_c">
            <template #title>
              <p>Mensajes sin leer de mis colaboraciones</p>
            </template>
            <template #content>
              <div v-for="item in unread_messages_c" :key="item.id">
                <div
                  class="
                    grid grid-cols-2
                    gap-x-3
                    hover:bg-indigo-50
                    cursor-pointer
                    px-2
                    py-1
                    rounded-md
                  "
                >
                  <Avatar :user="item.user" :secondary_info="item.created_at" />
                  <span class="mt-2 truncate">{{ item.content }}</span>
                </div>
              </div>
            </template>
          </DashboardPanel>
          <!-- new collaboration applies -->
          <DashboardPanel :items="collaborations_claims">
            <template #title>
              <p>Reclamos abiertos</p>
            </template>
            <template #content>
              <div v-for="item in collaborations_claims" :key="item.id">
                <div
                  class="
                    grid grid-cols-4
                    gap-x-3
                    hover:bg-indigo-50
                    cursor-pointer
                    px-2
                    py-1
                    rounded-md
                  "
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :collaboration="item" />
                    {{ item.homework.title }}
                  </span>
                  <span class="text-gray-400 text-right"
                    ><i
                      class="fa-solid fa-calendar-day"
                      title="Fecha de creación"
                    ></i>
                    {{ item.created_at.split("T")[0] }}</span
                  >
                </div>
              </div>
            </template>
          </DashboardPanel>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardPanel from "@/Components/DashboardPanel.vue";
import DashboardPanelSmall from "@/Components/DashboardPanelSmall.vue";
import StatusIcon from "@/Components/StatusIcon.vue";
import Avatar from "@/Components/Avatar.vue";

export default {
  components: {
    AppLayout,
    DashboardPanel,
    DashboardPanelSmall,
    StatusIcon,
    Avatar,
  },
  props: {
    homework_expired: Array,
    homeworks_uploaded_this_month: String,
    homeworks_uploaded_prev_month: String,
    all_homeworks_uploaded: String,
    unread_messages: Array,
    homeworks_recently_completed: Array,
    apllies_to_collaborate: Array,
    collaborations_in_process: Array,
    collaborations_to_approve: Array,
    unread_messages_c: Array,
    collaborations_claims: Array,
    profit_month: String,
  },
};
</script>