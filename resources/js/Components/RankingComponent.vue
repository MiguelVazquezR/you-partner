<template>
    <!-- ------------INICIO DEL BODY---------------------- -->
    <div>
    <h2 class="text-indigo-500  text-center mt-1 text-lg font-semibold">Ranking por de Colaboraciones</h2>
  
      <div class="grid lg:grid-cols-2 sm:grid-cols-1">

<!-- ------------INICIO DEL PANEL 1 TOP 10---------------------- -->

        <div class="my-6 mx-8 rounded-lg shadow-md max-h-screen col-span-2 lg:col-span-1">
        <h2 class="text-indigo-500 text-md font-bold text-center mt-2">TOP 10</h2>
        <hr class="mx-5">

      <ul class="my-4">
        <li class="flex items-center"><i class="fa-solid fa-trophy text-amber-500 text-3xl mx-4 my-1"></i><Avatar :user="user[0]"><span class="mr-1 bg-gray-300 rounded-md w-[60%] text-amber-500 font-bold p-1">Angel Vázquez</span> <span class="inline-block bg-gray-600 rounded-md w-[15%] text-white font-bold p-1 text-center">158</span> </li>
        <li class="flex items-center"><i class="fa-solid fa-trophy text-gray-500 text-3xl mx-4 my-1"></i><Avatar :user="user[1]"><span class="mr-1 bg-gray-300 rounded-md w-[60%] text-gray-600 font-bold p-1">Angel Vázquez</span> <span class="inline-block bg-gray-600 rounded-md w-[15%] text-white font-bold p-1 text-center">158</span></li>
        <li class="flex items-center"><i class="fa-solid fa-trophy text-amber-700 text-3xl mx-4 my-1 mb-3"></i><Avatar :user="user3"><span class=" mr-1 bg-gray-300 rounded-md w-[60%] text-amber-700 font-bold p-1">Angel Vázquez</span> <span class="inline-block bg-gray-600 rounded-md w-[15%] text-white font-bold p-1 text-center">158</span></li>
        <li v-for="user in users" :key="user.id" class="flex items-center"><span class="flex items-center justify-center ml-4 my-2 w-7 h-7 rounded-full bg-gray-600 text-center text-white">4</span><Avatar :user="user"><span class="mr-1 ml-5 bg-gray-300 rounded-md w-[60%] text-gray-500 font-bold p-1">Angel Vázquez</span> <span class="inline-block bg-gray-600 rounded-md w-[15%] text-white font-bold p-1 text-center">158</span></li>
        
      </ul>
      
        </div>


<!-- ------------FINAL DEL PANEL 2---------------------- -->
    <div class="my-6 mx-4 rounded-lg max-h-screen col-start-2">
        <h2 class="text-indigo-500 text-md font-bold text-center mt-2">TOP 3</h2>
        <hr class="mx-5">

      <div class="grid grid-cols-2 grid-rows-2">
        
          <div class="bg-amber-300 rounded-lg my-3 ml-4 row-span-2 shadow-xl">
              <h1 class="text-center my-2">TOP 1</h1>
              <div class="w-[60%] h-[45%] border-2 border-white mx-auto">
                    <Avatar :user="user1">
              </div>

              <div class="w-[80%] h-[35%] border-2 border-white mt-3 mx-auto text-center">
                <p>{{ user1.name }}</p>
                <p>{{ user1.state }}</p>
                <p>{{ user1.school_name }}</p>
                <p>{{ user1.academic_grade }}</p>  
              </div>
          </div>

          <div class="h-48 w-[85%] bg-gray-400 rounded-lg my-3 ml-4 grid grid-cols-5 shadow-xl">

              <h1 class="text-left mt-2">2</h1>
              <div class="w-[60%] h-[60%] border-2 border-white mx-3 col-start-1 col-span-2">
                    <Avatar :user="user2">
              </div>

              <div class="w-[80%] h-[100%] border-2 border-white text-center col-start-3 col-span-3 mb-4 ">
                <p>{{ user2.name }}</p>
                <p>{{ user2.state }}</p>
                <p>{{ user2.school_name }}</p>
                <p>{{ user2.academic_grade }}</p>
              </div>

          </div>

          <div class="h-48 w-[85%] bg-yellow-600 rounded-lg my-3 ml-4 grid grid-cols-5 shadow-xl">

              <h1 class="text-left mt-2">3</h1>
              <div class="w-[60%] h-[60%] border-2 border-white mx-3 col-start-1 col-span-2">
                    <Avatar :user="user3">
              </div>

              <div class="w-[80%] h-[100%] border-2 border-white text-center col-start-3 col-span-3 mb-4 ">
                <p>{{ user3.name }}</p>
                <p>{{ user3.state }}</p>
                <p>{{ user3.school_name }}</p>
                <p>{{ user3.academic_grade }}</p>
              </div>

          </div>
      

      </div>

       
        </div>
<!-- ------------FINAL DEL PANEL 2---------------------- -->

<!-- ------------FINAL DEL PANEL 1 TOP 10---------------------- -->
      </div>


    </div>
<!-- ------------FUINAL DEL BODY---------------------- -->
</template>

<script>
import Avatar from "@/Components/Avatar.vue";
import { Link } from "@inertiajs/inertia-vue3";


export default {
    data() {
        return {
            
        }
    },
    components:{
        Avatar,
        Link,
    },
    props:{
        user: Object,
    },

}
</script>