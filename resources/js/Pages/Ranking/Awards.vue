<template>
  <AppLayout title="Ranking">
 <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
    </div>
  
    <div>
      <RateModal />
    </div>
    <div>
      <MessagesModal />    
    </div>
    <div>
      <CollaborationModal />    
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Tabs from "@/Components/Tabs.vue";
import RatingStars from "@/Components/RatingStars.vue";
import RateModal from "@/Components/RateModal.vue";
import MessagesModal from "@/Components/MessagesModal.vue";
import CollaborationModal from "@/Components/CollaborationModal.vue";


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
    RatingStars,
    RateModal,
    MessagesModal,
    CollaborationModal,
  }
};
</script>


