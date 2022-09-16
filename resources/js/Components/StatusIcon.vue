<template>
  <i
    class="fa-solid mr-1"
    :class="{
      'fa-bullseye text-red-300': state == 0,
      'fa-clock text-sky-300': state == 1,
      'fa-spinner text-amber-200': state == 2,
      'fa-check text-green-300': state == 3,
      'fa-circle-exclamation text-red-500': state == 4,
    }"
    :title="titles[state]"
  ></i>
</template>

<script>
export default {
  data() {
    return {
      state: 0,
      titles: [
        "Sin colaboración",
        "Esperando aprobación",
        "En proceso",
        "Completado",
        "Con reclamo",
      ],
    };
  },
  props: {
    collaboration: Object,
  },
  mounted() {
    this.state = this.statusComputed;
  },
  computed: {
    statusComputed() {
      if (!this.collaboration) {
        return 0; //no collaboration
      } else if (!this.collaboration.approved_at) {
        if (this.collaboration.user_id === this.$page.props.user.id) {
          return 1; //to approve
        } else {
          return 0; //no collaboration
        }
      } else if (!this.collaboration.completed_date) {
        return 2; //in process
      } else if (this.collaboration.claim) {
        return 4; //with claim
      } else {
        return 3; //Completed
      }
    },
  },
};
</script>