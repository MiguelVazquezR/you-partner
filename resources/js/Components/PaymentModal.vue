<template>
  <div
    class="
      container
      flex flex-col
      w-full
      px-4
      mx-auto
      divide-y
      rounded-md
      divide-gray-400
    "
  >
    <div class="flex justify-between">
      <Avatar :user="collaboration.user" />
    </div>
    <div class="p-4 space-y-2 text-sm">
      <input
        type="text"
        class="input w-3/4"
        placeholder="Codigo de descuento"
      />
      <button class="btn-primary mx-2 my-4">Canjear</button>

      <div class="grid grid-cols-2">
        <div class="col-start-1 mx-5">
          <p class="my-1">Entrega pactada</p>
          <p class="my-1">Costo</p>
          <p class="my-1">Descuento</p>
          <p class="my-1 font-bold">Total</p>
        </div>
        <div class="col-start-2 mx-5">
          <p class="my-1 font-bold">{{ collaboration.promise_date }}</p>
          <p class="my-1 text-green-600">${{ collaboration.price }}</p>
          <p class="my-1 text-red-600">$0.00</p>
          <p class="my-1 font-bold text-green-600">
            ${{ collaboration.price - 0 }}
          </p>
        </div>
      </div>
    </div>
    <div class="text-center">
      <button class="btn-primary mx-2 my-4" @click="processPayment" v-if="!form.processing">Pagar</button>
      <button class="btn-primary mr-2 mt-3" disabled v-else>
        Procesando pago... 
        <i class="fa-solid fa-circle-notch animate-spin ml-2"></i>
      </button>
      <button class="btn-secondary mx-2" @click="$emit('cancel')">
        Regresar
      </button>
    </div>
  </div>
</template>


<script>
import Avatar from "@/Components/Avatar.vue";
import RatingStars from "@/Components/RatingStars.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  data() {
    const form = useForm({
      approved: true,
    });

    return { form };
  },
  components: {
    Avatar,
    RatingStars,
  },
  props: {
    collaboration: Object,
  },
  methods: {
    processPayment() {
      this.form.put(route('collaborations.approve', this.collaboration.id));
    },
  }
};
</script>

