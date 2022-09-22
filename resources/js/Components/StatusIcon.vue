<template>
  <i
    class="fa-solid mr-1"
    :class="{
      'fa-bullseye text-red-300': status == 0,
      'fa-clock text-sky-300': status == 1,
      'fa-spinner text-amber-200': status == 2,
      'fa-check text-green-300': status == 3,
      'fa-circle-exclamation text-red-500': status == 4,
    }"
    :title="titles[status]"
  ></i>
</template>

<script>
export default {
  data() {
    return {
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
    status: {
      type: Number,
      default: 0,
    },
  },
  // mounted() {
  //   this.state = this.statusComputed;
  // },
  // computed: {
  //   statusComputed() {
  //     if (!this.collaboration) {
  //       return 0; //no collaboration
  //     } else if (!this.collaboration.approved_at.string) {
  //       if (this.collaboration.user.id === this.$page.props.user.id) {
  //         return 1; //to approve
  //       } else {
  //         return 0; //no collaboration
  //       }
  //     } else if (!this.collaboration.completed_date) {
  //       return 2; //in process
  //     } else if (this.collaboration.claim) {
  //       return 4; //with claim
  //     } else {
  //       return 3; //Completed
  //     }
  //   },
  // },
};
</script>