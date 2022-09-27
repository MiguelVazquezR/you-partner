<template>
<h1 class="text-center text-indigo-500 font-bold">Colaboración</h1>
	<div class="container flex flex-col w-full max-w-lg p-6 mx-auto divide-y rounded-md divide-gray-400 dark:bg-gray-900 dark:text-gray-100">
		<div class="flex justify-between p-4">
			<div class="flex space-x-4">
				<div>
					<img src="https://source.unsplash.com/100x100/?portrait" alt="" class="object-cover w-12 h-12 rounded-full dark:bg-gray-500">
				</div>
				<div>
					<h4 class="font-bold">{{'Nombre del colaborador'}}</h4>
					<span class="text-xs dark:text-gray-400">2 days ago</span>
        <h4 class="text-center text-lg text-indigo-500">{{'Titulo de la tarea'}}</h4>
				</div>
			</div>
			<div class="flex items-center space-x-2 dark:text-yellow-500">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current text-yellow-500">
					<path d="M494,198.671a40.536,40.536,0,0,0-32.174-27.592L345.917,152.242,292.185,47.828a40.7,40.7,0,0,0-72.37,0L166.083,152.242,50.176,171.079a40.7,40.7,0,0,0-22.364,68.827l82.7,83.368-17.9,116.055a40.672,40.672,0,0,0,58.548,42.538L256,428.977l104.843,52.89a40.69,40.69,0,0,0,58.548-42.538l-17.9-116.055,82.7-83.368A40.538,40.538,0,0,0,494,198.671Zm-32.53,18.7L367.4,312.2l20.364,132.01a8.671,8.671,0,0,1-12.509,9.088L256,393.136,136.744,453.3a8.671,8.671,0,0,1-12.509-9.088L144.6,312.2,50.531,217.37a8.7,8.7,0,0,1,4.778-14.706L187.15,181.238,248.269,62.471a8.694,8.694,0,0,1,15.462,0L324.85,181.238l131.841,21.426A8.7,8.7,0,0,1,461.469,217.37Z"></path>
				</svg>
				<span class="text-xl font-bold text-yellow-500">4.8</span>
			</div>
		</div>
		<div class="p-4 space-y-2 text-sm dark:text-gray-400">
              
			<div class="grid grid-cols-2">
            <div class="col-start-1 mx-5">
                <p class="my-1"> {{ 'Nombre' }} </p>
                <p class="my-1"> {{ 'Reclamos' }} </p>
                <p class="my-1"> {{ 'Grado Académico' }} </p>
                <p class="my-1"> {{ 'Colaboraciones canceladas' }} </p>
                <p class="my-1"> {{ 'Se unió el...' }} </p>
            </div>
            <div class="col-start-2 mx-5">
                <p class="my-1"> {{ 'Angel' }} </p>
                <p class="my-1"> {{ '2' }} </p>
                <p class="my-1"> {{ 'Ingeniero' }} </p>
                <p class="my-1"> {{ '0' }} </p>
                <p class="my-1"> {{ '20 sep.,2022' }} </p>
            </div>
        </div>
		</div>
    <div class="grid grid-cols-2 text-sm mx-auto font-semibold">
        <div class="col-start-1 mx-8">
            <p class="my-1">Entrega Pactada</p>
            <p class="my-1">costo</p>
        </div>
        <div class="col-start-2 mx-8">
            <p class="my-1">30 Sep,. 2022</p>
            <p class="my-1 text-green-600">$350.00</p>
        </div>
    </div>
    <div class="text-center">   
        <button class="btn-primary mx-2 my-4">Aceptar Colaboración</button>
        <button class="btn-secondary mx-2">Comentar</button>
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

