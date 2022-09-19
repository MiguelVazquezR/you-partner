<template>
  <AppLayout title="Tareas">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
      <div class="flex justify-end mt-3">
        <Link :href="route('homeworks.create')" class="btn-primary">
          + Crear
        </Link>
      </div>
      <HomeworkTable
        :homeworks="homeworks"
        :filters="filters"
        filterURL="/homeworks"
        canEdit
        canDelete
        @details="showDetails($event)"
      />
    </div>
    <DetailsModal :show="side_modal" @close="side_modal = false">
      <template #title>
        <div class="flex flex-col">
          <h1 class="text-indigo-600 text-xl font-semibold">
            {{ homework_detail.title }}
          </h1>
          <div class="flex justify-between">
            <small class="text-indigo-400 text-xs">
              <i class="fa-solid fa-tag"></i>
              {{ homework_detail.school_subject.name }}
            </small>
            <small class="text-xs px-2 bg-red-100 text-red-400 rounded-md">
              Entrega: {{ homework_detail.delivery_date.split("T")[0] }}
            </small>
          </div>
        </div>
      </template>
      <template #content>
        <section class="mt-3">
          <div>
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-comment-dots mr-2"></i>
              <span>Preguntas y comentarios</span>
            </h1>
            <div
              class="
                border
                rounded-md
                border-dotted
                max-h-[35vh]
                min-h-[10vh]
                overflow-y-auto
                px-1
                py-2
                divide-y
              "
            >
              <div
                v-for="item in [1, 2]"
                :key="item"
                class="
                  grid grid-cols-2
                  gap-x-2
                  hover:bg-gray-100
                  cursor-pointer
                  rounded
                "
              >
                <Avatar
                  :user="$page.props.user"
                  secondary_info="Hace 3 horas"
                />
                <p class="text-xs text-gray-600">
                  Hola amigo he visto tu tarea y yo puedo ayudarte...
                </p>
              </div>
              <p
                v-if="![1, 2].length"
                class="text-center text-gray-400 text-xs pt-3"
              >
                No tienes ningún comentario o pregunta
              </p>
            </div>
          </div>
          <div class="mt-6">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-handshake-angle mr-2"></i>
              <span>Solicitudes de colaboración</span>
            </h1>
            <div class="mt-1">
              <div
                class="
                  border
                  rounded-md
                  border-dotted
                  max-h-[35vh]
                  min-h-[10vh]
                  overflow-y-auto
                  px-1
                  py-2
                  divide-y
                "
              >
                <div
                  @click="dialog_modal = true"
                  v-for="item in [1, 2]"
                  :key="item"
                  class="
                    grid grid-cols-2
                    gap-x-2
                    hover:bg-gray-100
                    cursor-pointer
                    rounded
                  "
                >
                  <Avatar
                    :user="$page.props.user"
                    secondary_info="Hace 3 horas"
                  />
                </div>
                <p
                  v-if="![1, 2].length"
                  class="text-center text-gray-400 text-xs pt-3"
                >
                  No tienes ninguna solicitud
                </p>
              </div>
            </div>
          </div>
          <div class="mt-6">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-paperclip mr-2"></i>
              <span>Archivos adjuntos</span>
            </h1>
            <div class="mt-1">
              <p
                class="
                  cursor-pointer
                  hover:scale-105
                  transition
                  duration-100
                  inline-block
                "
              >
                <i class="fa-solid fa-file-pdf text-red-600 text-2xl mr-2"></i>
                <span class="text-red-800 text-sm"
                  >Tarea 4.5 Ecuaciones diferenciales</span
                >
              </p>
              <p
                class="
                  cursor-pointer
                  hover:scale-105
                  transition
                  duration-100
                  inline-block
                "
              >
                <i
                  class="fa-solid fa-file-word text-blue-600 text-2xl mr-2"
                ></i>
                <span class="text-blue-800 text-sm"
                  >Tarea 4.5 Ecuaciones diferenciales</span
                >
              </p>
              <p
                class="
                  cursor-pointer
                  hover:scale-105
                  transition
                  duration-100
                  inline-block
                "
              >
                <i
                  class="
                    fa-solid fa-file-powerpoint
                    text-orange-500 text-2xl
                    mr-2
                  "
                ></i>
                <span class="text-orange-700 text-sm"
                  >Tarea 4.5 Ecuaciones diferenciales</span
                >
              </p>
              <p
                class="
                  cursor-pointer
                  hover:scale-105
                  transition
                  duration-100
                  inline-block
                "
              >
                <i
                  class="fa-solid fa-file-excel text-green-600 text-2xl mr-2"
                ></i>
                <span class="text-green-800 text-sm"
                  >Tarea 4.5 Ecuaciones diferenciales</span
                >
              </p>
              <p
                class="
                  cursor-pointer
                  hover:scale-105
                  transition
                  duration-100
                  inline-block
                "
              >
                <i
                  class="fa-solid fa-file-image text-sky-500 text-2xl mr-2"
                ></i>
                <span class="text-sky-700 text-sm"
                  >Tarea 4.5 Ecuaciones diferenciales</span
                >
              </p>
            </div>
          </div>
        </section>
      </template>
      <template #footer>
        <div class="flex">
          <button class="btn-primary mr-3">Editar</button>
          <button @click="side_modal = false" class="btn-secondary">
            Cerrar
          </button>
        </div>
      </template>
    </DetailsModal>
    <DialogModal :show="dialog_modal" @close="dialog_modal = false">
      <template #title>Title</template>
      <template #content> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae facilis cum ut aliquid eligendi id dolor eum magnam nemo nihil quaerat numquam nisi, voluptates excepturi aliquam quis accusantium modi similique.
      Delectus sequi quas quia asperiores inventore laborum, doloremque quasi aliquam nobis eaque quis amet reiciendis beatae? Doloremque ipsa officia, delectus odit optio nostrum suscipit beatae autem explicabo modi earum repellendus!
      Consequatur, architecto consequuntur nesciunt voluptate quidem aliquam officia quibusdam dolor omnis a et ut est voluptatem itaque voluptas minus. Fugit ducimus minima quisquam voluptate dolores maxime. Unde incidunt ducimus minus?
      Accusantium natus, quisquam delectus expedita provident facilis ullam et nihil deserunt iste temporibus est corrupti suscipit soluta veritatis, porro velit aliquam maiores necessitatibus vel! Odio ad accusamus unde quibusdam et?
      Facere aliquid ut labore mollitia a praesentium quia! Repellat eligendi quos, odit eum recusandae sed quam odio consequatur impedit. Eveniet ex laboriosam architecto nesciunt earum iste dolorem, impedit necessitatibus enim. 
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati enim nemo fugiat, vel corrupti quam harum omnis laborum reprehenderit, doloremque corporis magnam numquam a illo unde qui, ipsum adipisci cupiditate!
      Consequatur modi corporis fugit dolorum veniam voluptatibus non adipisci? Tempore consequuntur recusandae dolor aliquam molestias necessitatibus ut a eos quasi, reiciendis cupiditate aliquid quo natus dolorem laudantium. Id, perferendis eum.
      Quod necessitatibus omnis veritatis ea quisquam molestiae incidunt, corporis nostrum porro voluptatibus praesentium fugit alias expedita suscipit neque ducimus inventore nihil sunt eum doloremque. Nihil animi nostrum ullam facilis eaque.
      Ullam sit accusamus nihil quibusdam, quaerat repellat. Alias, amet sequi sint libero quaerat optio, quis aliquid voluptas totam hic accusamus voluptates velit fuga repudiandae minus quasi error incidunt. Quisquam, quia!
      Consectetur et, distinctio alias expedita dicta illo. Obcaecati vitae nesciunt molestiae fuga quibusdam ipsum debitis odio dolores. Eius quae impedit voluptas. Ea vitae, hic dicta harum veritatis quas quam ad.
      </template>
      
      <template #footer>Footer</template>
    </DialogModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import HomeworkTable from "@/Components/HomeworkTable.vue";
import Tabs from "@/Components/Tabs.vue";
import DetailsModal from "@/Components/DetailsModal.vue";
import Avatar from "@/Components/Avatar.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";

export default {
  data() {
    return {
      homework_detail: {},
      side_modal: false,
      dialog_modal: false,
      tabs: [
        {
          label: "Todas",
          url: "homeworks.index",
        },
        {
          label: "Pendientes",
          url: "homeworks.no-collaboration",
        },
        {
          label: "En colaboracion",
          url: "homeworks.on-collaboration",
        },
        {
          label: "Terminados",
          url: "homeworks.finished",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Link,
    HomeworkTable,
    Tabs,
    DetailsModal,
    Avatar,
    DialogModal,
  },
  props: {
    homeworks: Object,
    filters: Object,
  },
  methods: {
    showDetails(event) {
      this.homework_detail = event;
      this.side_modal = true;
    },
  },
};
</script>
