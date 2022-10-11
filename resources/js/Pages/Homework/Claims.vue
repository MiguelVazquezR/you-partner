<template>
  <AppLayout title="Mis tareas terminadas">
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
      <HomeworkTable
        :homeworks="homeworks"
        :filters="filters"
        filterURL="/homeworks/finished"
        @details="showDetails"
      />
    </div>
    <DetailsModal :show="side_modal" @close="side_modal = false">
      <template #title> Título de mi modal </template>
      <template #content>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non quo autem
        illo excepturi consectetur expedita possimus, omnis reprehenderit
        dignissimos corrupti repudiandae modi similique, optio quos sit?
        Aspernatur rerum eos deserunt! Lorem, ipsum dolor sit amet consectetur
        adipisicing elit. Animi quaerat id possimus debitis ea alias ducimus
        libero. Vitae quae deserunt quas aspernatur veritatis provident debitis,
        exercitationem temporibus quasi optio sunt. Lorem ipsum dolor sit amet
        consectetur adipisicing elit. Quia veniam quibusdam, sit deleniti neque
        voluptates atque omnis commodi ea asperiores cumque, aspernatur deserunt
        eos autem repudiandae magni inventore aperiam beatae. Quam repellat
        quisquam veritatis voluptas saepe debitis voluptate, at pariatur
        distinctio a sequi error eveniet dignissimos atque ducimus nisi
        assumenda magni officiis, nihil, fugiat necessitatibus neque autem. Sed,
        tempora consectetur. Minima aspernatur nihil quibusdam molestiae
        accusamus suscipit ducimus illo cum nostrum unde est aperiam fuga quos
        dignissimos provident nemo nam consequatur, odio aliquid numquam rerum,
        praesentium veritatis doloremque explicabo! Possimus? Lorem ipsum dolor
        sit amet consectetur adipisicing elit. Expedita aperiam, dicta delectus
        cumque nulla amet soluta vero ullam, culpa harum unde id quis enim
        reiciendis? Animi ducimus provident molestiae dicta! Excepturi
        blanditiis nemo optio ea error, earum iure quas dolores autem porro
        maiores ratione a iste hic nisi tempora soluta aut minus pariatur?
        Excepturi nam voluptate praesentium, placeat totam ad? Consequuntur nam
        fuga deleniti aspernatur cupiditate quam excepturi obcaecati ipsa,
        voluptatum omnis quasi sed sint nisi accusantium pariatur nulla porro
        dignissimos. Culpa doloremque labore magni possimus, blanditiis ducimus
        similique eaque!
      </template>
      <template #footer>
        <div class="flex">
          <button class="btn-primary mr-3">Guardar</button>
          <button class="btn-secondary">Cancelar</button>
        </div>
      </template>
    </DetailsModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Tabs from "@/Components/Tabs.vue";
import HomeworkTable from "@/Components/HomeworkTable.vue";
import DetailsModal from "@/Components/DetailsModal.vue";

export default {
  data() {
    return {
      side_modal: false,
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
          url: "homeworks.completed",
        },
        {
          label: "Reclamos",
          url: "homeworks.claims",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Link,
    Tabs,
    HomeworkTable,
    DetailsModal,
  },
  props: {
    homeworks: Object,
    filters: Object,
  },
  methods: {
    showDetails() {
      this.side_modal = true;
    }
  }
};
</script>