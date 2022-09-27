<template>
<h1 class="text-center text-indigo-500 font-bold">Pagar Colaboración</h1>
	<div class="container flex flex-col w-full max-w-lg p-6 mx-auto divide-y rounded-md divide-gray-400 dark:bg-gray-900 dark:text-gray-100">
		<div class="flex justify-between p-4">
			<div class="flex space-x-4">
				<div>
					<img src="https://source.unsplash.com/100x100/?portrait" alt="" class="object-cover w-12 h-12 rounded-full dark:bg-gray-500">
				</div>
				<div>
					<h4 class="font-bold">{{'Nombre del colaborador'}}</h4>
        <h4 class="text-center text-lg text-indigo-500">{{'Titulo de la tarea'}}</h4>
				</div>
			</div>
		</div>
		<div class="p-4 space-y-2 text-sm dark:text-gray-400">
            <input
        type="text"
        class="input w-3/4"
        placeholder="Codigo de descuento"
      /> <button class="btn-primary mx-2 my-4">Canjear</button>
              
			<div class="grid grid-cols-2">
            <div class="col-start-1 mx-5">
                <p class="my-1"> {{ 'Entrega pactada' }} </p>
                <p class="my-1"> {{ 'Costo' }} </p>
                <p class="my-1"> {{ 'Descuento' }} </p>
                <p class="my-1 font-bold"> {{ 'Total:' }} </p>
            </div>
            <div class="col-start-2 mx-5">
                <p class="my-1"> {{ '20 sep.,2022' }} </p>
                <p class="my-1 text-green-600"> {{ '$350.00' }} </p>
                <p class="my-1 text-red-600"> {{ '$50.00' }} </p>
                <p class="my-1 font-bold text-green-600"> {{ '$300.00' }} </p>
            </div>
        </div>
		</div>
    <div class="text-center">   
        <button class="btn-primary mx-2 my-4">Pagar</button>
        <button class="btn-secondary mx-2">Cancelar</button>
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
    user: Object,
  },
};
</script>

