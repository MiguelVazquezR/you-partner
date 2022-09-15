<template>
  {{ statusComputed }}
  <i
    v-if="!collaboration || !collaboration.approved_at"
    class="fa-solid fa-bullseye text-red-300"
    title="Sin colaboración"
  ></i>
  <i
    v-else-if="collaboration.completed_date"
    class="fa-solid fa-check text-green-300"
    title="Terminado"
  ></i>
  <i v-else class="fa-solid fa-spinner text-yellow-300" title="En proceso"></i>
</template>

<script>
export default {
  props: {
    collaboration: Object,
  },
  computed:{
    statusComputed() {
      if(!this.collaboration) {
        return 1; //no collaboration
      } else if(!this.collaboration.approved_at) {
        if(this.collaboration.user_id === $page.props.user.id) {
          return 2; //to approve
        }else {
          return 1; //no collaboration
        }
      } else if(!this.collaboration.completed_date) {
        return 3; //in process
      } else if(this.collaboration.claim) {
        return 5; //with claim
      } else {
        return 4; //Completed
      }
    }
  }
};
</script>