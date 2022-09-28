<template>
<h1 class="text-center text-indigo-500 font-bold">Reclamo</h1>
<div class="container max-w-lg mx-auto mt-2">
<h1 class="text-center text-red-500 font-bold text-xs">Antes de iniciar el reclamo, asegúrate de tener evidencias y explica bien tu inconformidad para poder evaluar con más rapidéz tu caso. Si nos percatamos de que la/el colaborador(a) hizo bien su trabajo pero quieres sacar ventaja, se te pondrá un punto malo. Al acumular 3 puntos malos, se suspenderá tu cuenta permanentemente. <a href="#" class="text-blue-400 hover:text-blue-300"> Ver politicas de reembolsos </a></h1>
</div>

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

        <div class="p-3 text-center">
        <textarea class="input !h-28 w-3/4" placeholder="Escribe un comentario"></textarea>
               
       <!-- <FileUploader /> -->

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
