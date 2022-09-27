<template>
  <div class="">
    <h1 class="text-center text-indigo-500 font-semibold">
      Preguntas y Comentarios
    </h1>
    <!-- <p> {{ collaboration.homework.title }} </p> -->
    <p class="text-sm">{{ "TITULO DE LA SOLICITUD O TAREA" }}</p>
    <br />
    <div>
      <div class="grid grid-cols-2">
        <div class="col-start-1">AVATAR DE LA OTRA PERSONA</div>
        <div class="col-start-2 text-end">AVATAR DE USTED</div>
      </div>
      <hr />
      <div
        id="cuerpo-chat"
        class="border border-gray-300 overflow-y-auto h-64 w-2/3 rounded-md mx-auto text-sm"
      >
        <div class="bg-indigo-200 max-w-md rounded-lg text-left my-2 mx-3 p-2">
          {{
            "Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona Mensaje o comentario de la otra persona "
          }}
        </div>
        <div class="bg-red-200 max-w-md rounded-lg text-right my-2 mx-3 p-2 ml-auto">
          {{
            "Mensaje o comentario tuyo Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque soluta laborum ratione architecto, porro aliquid reprehenderit magni, fugit natus quia repellat. Voluptates dolorum commodi quisquam fugiat nostrum voluptatibus sequi animi."
          }}
        </div>
      </div>
      <div class="text-center">
      <input
        type="text"
        class="input w-1/2 my-5"
        placeholder="Escribe tu mensaje aquí..."
      />
      <button class="btn-primary mx-3"><i class="fa-solid fa-paper-plane"></i></button>
      </div>
    </div>
    <br />
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
  },
  props: {
    collaboration: Object,
    user: Object,
  },
};
</script>