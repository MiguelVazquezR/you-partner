<template>
<h1 class="text-center text-indigo-500 font-bold">Cancelar colaborcion</h1>
<h4 class="text-center text-lg text-indigo-500">{{'Titulo de la tarea'}}</h4>
<div class="text-center">
<i class="fa-solid fa-circle-exclamation text-red-500 text-3xl"></i>
</div>
<div class="max-w-md mx-auto mt-2 bg-red-500 text-white text-sm text-center">
    <span class="p-3">¿Estas segura(o) de cancelar la colaboracion? Este movimiento se verá en tu historial</span>
</div>
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
        <textarea class="input !h-28 w-full" placeholder="Explica los motivos de la cancelación" required></textarea>
        </div>
    <div class="text-center">   
        <button class="btn-primary mx-2 my-4">Enviar</button>
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
