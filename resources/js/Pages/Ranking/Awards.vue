<template>
  <AppLayout title="Ranking">
 <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
    </div>
  
    <div class="border-2 border-black">
      <RateModal />
    </div>
    <div class="border-2 border-black">
      <MessagesModal />    
    </div>
    <div class="border-2 border-black">
      <CollaborationModal />    
    </div>
    <div class="border-2 border-black">
      <PaymentModal />    
    </div>
    <div class="border-2 border-black">
      <ClaimModal />    
    </div>
    <div class="border-2 border-black">
      <SendHomeworkModal />    
    </div>
    <div class="border-2 border-black">
      <CancelColabModal />    
    </div>
    <div class="border-2 border-black">
      <ApplyCollaborationModal />    
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
import PaymentModal from "@/Components/PaymentModal.vue";
import ClaimModal from "@/Components/ClaimModal.vue";
import SendHomeworkModal from "@/Components/SendHomeworkModal.vue";
import CancelColabModal from "@/Components/CancelColabModal.vue";
import ApplyCollaborationModal from "@/Components/ApplyCollaborationModal.vue";


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
    PaymentModal,
    ClaimModal,
    SendHomeworkModal,
    CancelColabModal,
    ApplyCollaborationModal,
  }
};
</script>


