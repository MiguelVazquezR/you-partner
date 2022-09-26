<template>
    <div class="">
        <h1 class="text-center text-indigo-500 font-semibold">Puntuar Colaboración</h1>
        <!-- <p> {{ collaboration.homework.title }} </p> -->
        <p class="text-sm"> {{ 'TITULO DE TAREA' }} </p>
        <br>
        <div class="grid grid-cols-2">
            <div class="col-start-1 text-sm">
                <p>Fecha límite de entrega:</p>
                <p>Empezado el:</p>
                <p>Entregado el:</p>
                <p>Costo:</p>
            </div>        
            <div class="col-start-2 text-sm">
                <p>30 sep., 2022</p>
                <p>26 sep., 2022</p>
                <p>29 sep., 2022</p>
                <p>$350.00</p>
            </div>        
        </div>
        <br>
        <div>
        <!-- <Avatar :user="user"> -->
         <RatingStars />
        <textarea class="input !h-28 mb-2 w-3/4" placeholder="Escribe un comentario"></textarea>
        </div>
        <button class="btn-primary">Puntuar</button>
        
    </div>
</template>

<script>
import Avatar from "@/Components/Avatar.vue";
import RatingStars from "@/Components/RatingStars.vue";


export default {
    data() {
        return {
            
        }
    },
    components:{
        Avatar,
        RatingStars,

    },
    props:{
        collaboration:Object,
        user:Object,
    },
}
</script>