<template>
<h1 class="text-center text-indigo-500 font-bold">Aplicar colaboracion</h1>
<h4 class="text-center text-lg text-indigo-500">{{'Titulo de la tarea'}}</h4>
	<div class="container flex flex-col w-full max-w-md p-6 mx-auto divide-y rounded-md divide-gray-400 bg-white-600 text-gray-600">
		<div class="p-4">
			<div class="flex justify-between space-x-4">
				<div class="">
					<img src="https://source.unsplash.com/100x100/?portrait" alt="" class="object-cover w-12 h-12 rounded-full dark:bg-gray-500">
				</div>
				<div class="">
					<img src="https://source.unsplash.com/100x100/?portrait" alt="" class="object-cover w-12 h-12 rounded-full dark:bg-gray-500">
				</div>
			</div>
		</div>
        <div class="p-3 text-center">
        <label for="costo">Costo ($MXN)</label>
        <input class="input my-2 mx-2" type="number" name="costo">
        <br>
        <label for="fecha">Fecha Promesa</label>
        <input class="input my-2 mx-2" type="date" name="fecha">
        <textarea class="input !h-24 w-full" placeholder="Escribe algun comentario"></textarea>
        </div>
    <div class="text-center">   
        <button class="btn-primary mx-2 my-4">Aplicar</button>
        <button class="btn-secondary mx-2">Cancelar</button>
    </div>
	</div>
</template>


<script>
import Avatar from "@/Components/Avatar.vue";
import RatingStars from "@/Components/RatingStars.vue";
import FileUploader from "@/Components/Common/FileUploader.vue";

export default {
  data() {
    return {};
  },
  components: {
    Avatar,
    RatingStars,
    FileUploader,
  },
  props: {
    collaboration: Object,
    user: Object,
  },
};
</script>
