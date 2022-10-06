<template>
    <!-- component -->
<div class="bg-gray-200">

    <div class="container mx-auto mb-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4 border-green-500">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-4/5 mx-auto rounded-full"
                            src="https://source.unsplash.com/100x100/?portrait"
                            alt="">
                    </div>
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ 'Nombre de usuario' }}</h1>
                    <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">Aqui la descripcion breve del usuario
                    cosas que le gustan academicamente hablandooooo ,etc.</p>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-900 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Estatus</span>
                            <span class="ml-auto"><span
                                    class="bg-green-500 py-1 px-2 rounded text-white text-sm">Activo</span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Miembro desde</span>
                            <span class="ml-auto">{{'Nov 07, 2016'}}</span>
                        </li>
                        <li class="flex items-center py-3">
                            <LevelBar />
                        </li>
                    </ul>
                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>

                <!-- End of friends card -->
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide border-b-2">Información Personal</span>
                    </div>
                    <div class="text-gray-600">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Escuela</div>
                                <div class="px-4 py-2">{{'Ceti colomos'}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Colaboraciones</div>
                                <div class="px-4 py-2">{{4}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Fecha de Nacimiento</div>
                                <div class="px-4 py-2">{{'13/03/1996'}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Tareas subidas</div>
                                <div class="px-4 py-2">{{10}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Grado académico</div>
                                <div class="px-4 py-2">{{'Ingeniero - Diseño Electrónico'}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Reclamos</div>
                                <div class="px-4 py-2">{{0}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of about section -->

                <div class="my-4"></div>
                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                      <i class="fa-solid fa-square-poll-horizontal text-lg text-gray-700 pl-6"></i>
                        <span class="tracking-wide border-b-2">Calificación de Usuario</span>
                    </div>

                <!-- Raiting -->
                <div class="bg-white p-3 shadow-sm rounded-sm text-center">

                    <div class="grid grid-cols-2">
                        <div>
                            <ReviewUser />
                           
                        </div>


                        <div class="max-h-96 overflow-y-auto">
                            <Comment />
                            <Comment />
                            <Comment />
   
                        </div>
                    </div>
                    <!-- End of Experience and education grid -->
                </div>
                <!-- End of profile tab -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
import LevelBar from "@/Components/LevelBar.vue";
import ReviewUser from "@/Components/ReviewUser.vue";
import Comment from "@/Components/Comment.vue";

export default {
    data() {
        return {
            
        }
    },
    props:{
        user: Object,
    },
    components:{
        LevelBar,
        ReviewUser,
        Comment,
    },
}
</script>