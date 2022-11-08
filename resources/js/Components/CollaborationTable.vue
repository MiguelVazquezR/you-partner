<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <Pagination :pagination="collaborations" />
    <InputSearch
      :filters="filters"
      :filterURL="filterURL"
      class="mb-2 ml-4 flex-1"
    />
  </div>
  <div class="overflow-x-auto text-sm">
    <table v-if="collaborations.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="collaboration in collaborations.data"
          :key="collaboration.id"
          class="focus:outline-none h-16 border dark:border-slate-800 border-gray-100 rounded"
        >
          <td class="px-3">
             <StatusIcon :status="collaboration.status" />
          </td> 
          <td class="pr-5">
            <Avatar :user="collaboration.homework.user" />
          </td>
          <td>
            <div>
              <p class="font-medium leading-none dark:text-gray-300 text-gray-700 mr-2">
                {{ collaboration.homework.title }}
              </p>
            </div>
          </td>
          <td class="pl-5">
            <div class="flex items-center dark:text-gray-300 text-gray-600" title="Materia">
              <i class="fa-solid fa-tag"></i>
              <p class="text-sm leading-none ml-2">
                {{ collaboration.homework.school_subject.name }}
              </p>
            </div>
          </td>
          <td v-if="!collaboration.claim" class="pl-2">
            <div class="flex items-center mr-2 dark:text-gray-300" title="Mensajes">
              <i class="fa-solid fa-comment-dots"></i>
              <p class="text-sm leading-none dark:text-gray-300 text-gray-600 ml-2">0</p>
            </div>
          </td>
          <td v-else class="pl-2">
            <div class="flex items-center mr-2 dark:text-gray-300" title="Mensajes de soporte">
              <i class="fa-solid fa-headset"></i>
              <p class="text-sm leading-none dark:text-gray-300 text-gray-600 ml-2">0</p>
            </div>
          </td>
          <td>
            <div class="flex items-center dark:text-gray-300" title="Cobrado">
              <i class="fa-solid fa-dollar-sign"></i>
              <p class="text-sm leading-none dark:text-gray-300 text-gray-600">
                {{ collaboration.price }} MXN
              </p>
            </div>
          </td>
          <td v-if="collaboration.claim?.refund" class="pl-2">
            <div class="flex items-center text-red-700" title="Penalizado">
              -<i class="fa-solid fa-dollar-sign"></i>
              <p class="text-sm leading-none">
              {{ collaboration.claim.refund }} MXN
              </p>
            </div>
          </td>
          <td v-if="!collaboration.claim" class="pl-2">
            <div
              class="inline py-3 px-3 text-sm focus:outline-none leading-none rounded"
              :class="collaboration.homework.priority === 'Urgente' ? ' dark:text-red-900 dark:bg-red-500 text-red-700 bg-red-100' : 'dark:text-green-900 dark:bg-green-500 text-green-700 bg-green-100'"
              :title="'Prioridad: ' + collaboration.homework.priority"
            >
              Límite: {{ collaboration.homework.limit_date }}
            </div>
          </td>
          <td class="pl-2" v-if="collaboration.claim">
            <span
              v-if="collaboration.claim?.solution"
              class="rounded-full px-2 py-1 dark:bg-green-500 dark:text-green-900 bg-green-100 text-green-600 text-xs"
              >Cerrado</span
            >
            <span
              v-else
              class="rounded-full px-2 py-px dark:bg-red-500 dark:text-red-900 bg-red-100 text-red-600 text-xs"
              >Abierto</span
            >
          </td>
              <td v-if="collaboration.payed_at||collaboration.rate">
            <div class="flex items-center" title="Cobrado">
              <i title="Pago liberado" class="fa-solid fa-hand-holding-dollar text-green-600"></i> 
              <i v-if="collaboration.rate" title="Tarea calificada" class="fa-solid fa-star text-yellow-500 ml-5"> <small>{{ collaboration.rate.stars }}</small> </i> 
            </div>
          </td>
          <td class="pl-4">
            <button
              @click="showDetails(collaboration)"
              class="
                focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300
                text-sm
                leading-none
                text-gray-600
                py-3
                px-5
                mr-2
                bg-gray-100
                rounded
                hover:bg-gray-200
                focus:outline-none
                dark:text-gray-200 dark:bg-blue-900 dark:hover:bg-blue-700
              "
            >
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
import StatusIcon from "@/Components/StatusIcon.vue";
import Input from "@/Jetstream/Input.vue";
import InputSearch from "@/Components/Common/InputSearch.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Pagination,
    Avatar,
    StatusIcon,
    Input,
    InputSearch,
    Link,
  },
  props: {
    collaborations: Object,
    filters: Object,
    filterURL: String,
  },
  methods:{
    showDetails(item) {
      this.$emit('details', item)
    }
  }
};
</script>