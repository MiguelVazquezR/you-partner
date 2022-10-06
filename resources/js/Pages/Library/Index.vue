<template>
  <AppLayout title="Ranking">
 <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
    <!-- <pricing-plans /> -->
    </div>
    <h1 class="text-3xl font-semibold text-indigo-500">EN CONSTRUCCION... VIENE PRONTO</h1>
    <i class="fa-solid fa-person-digging text-[95px] text-gray-400 mt-24 ml-48"></i>


  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Tabs from "@/Components/Tabs.vue";
import PricingPlans from "@/Components/PricingPlans.vue";


export default {
   data() {
    
  },
  components: {
    AppLayout,
    Tabs,
    PricingPlans,
  },
  props:{

  },
  methods: {
    
  },
};
</script>


