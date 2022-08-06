<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <Pagination :pagination="collaborations" />
    <InputSearch :filters="filters" :filterURL="filterURL" class="mb-2 ml-4 flex-1" />
  </div>
  <div class="overflow-x-auto text-sm">
    <table v-if="collaborations.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr v-for="collaboration in collaborations.data" :key="collaboration.id"
          class="focus:outline-none h-16 border border-gray-100 rounded">
          <td class="px-3">
            <i v-if="collaboration.status == 'En proceso'" class="fa-solid fa-spinner text-yellow-300"
              :title="collaboration.status"></i>
            <i v-else class="fa-solid fa-check text-green-300" :title="collaboration.status"></i>
          </td>
          <td class="pr-5">
            <Avatar :user="collaboration.homework.user" />
          </td>
          <td>
            <div>
              <p class="font-medium leading-none text-gray-700 mr-2">
                {{ collaboration.homework.title }}
              </p>
            </div>
          </td>
          <td>
            <div class="flex items-center">
              <i class="fa-solid fa-comment-dots"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">0</p>
            </div>
          </td>
          <td>
            <div class="flex items-center">
              <i class="fa-solid fa-dollar-sign"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">
                {{ collaboration.payment }} MXN
              </p>
            </div>
          </td>
          <td class="pl-4">
            <button @click="details = true" class="
                focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300
                text-sm
                leading-none
                text-gray-600
                py-3
                px-5
                bg-gray-100
                rounded
                hover:bg-gray-200
                focus:outline-none
              ">
              Ver
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div v-else class="text-center text-gray-500 my-3">
      No hay ningún registro para mostrar
    </div>
  </div>
</template>

<script>
import Pagination from "@/Components/Pagination.vue";
import Avatar from "@/Components/Avatar.vue";
import Input from "@/Jetstream/Input.vue";
import InputSearch from "@/Components/Common/InputSearch.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Pagination,
    Avatar,
    Input,
    InputSearch,
    Link,
  },
  props: {
    collaborations: Object,
    filters: Object,
    filterURL: String,
  },
};
</script>