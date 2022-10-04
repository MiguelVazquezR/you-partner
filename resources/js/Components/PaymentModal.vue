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
    <div class="flex justify-between p-4">
      <div class="flex items-center space-x-2">
        <figure>
          <img
            :src="collaboration.user.profile_photo_url"
            class="object-cover w-12 h-12 rounded-full"
          />
        </figure>
        <div>
          <h4 class="font-bold">{{ collaboration.user.name }}</h4>
        </div>
      </div>
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
          <p class="my-1">{{ collaboration.promise_date }}</p>
          <p class="my-1 text-green-600">${{ collaboration.price }}</p>
          <p class="my-1 text-red-600">$0.00</p>
          <p class="my-1 font-bold text-green-600">${{ collaboration.price - 0 }}</p>
        </div>
      </div>
    </div>
    <div class="text-center">
      <button class="btn-primary mx-2 my-4">Pagar</button>
      <button class="btn-secondary mx-2" @click="$emit('cancel')">Regresar</button>
    </div>
  </div>
</template>


<script>
import Avatar from "@/Components/Avatar.vue";
import RatingStars from "@/Components/RatingStars.vue";

export default {
  data() {
    return {};
  },
  components: {
    Avatar,
    RatingStars,
  },
  props: {
    collaboration: Object,
  },
};
</script>

