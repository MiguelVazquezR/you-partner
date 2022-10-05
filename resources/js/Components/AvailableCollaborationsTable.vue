<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <Pagination :pagination="homeworks" />
    <InputSearch
      :filters="filters"
      :filterURL="filterURL"
      class="mb-2 ml-4 flex-1"
    />
  </div>
  <div class="overflow-x-auto text-sm">
    <table v-if="homeworks.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="homework in homeworks.data"
          :key="homework.id"
          class="focus:outline-none h-16 border border-gray-100 rounded"
        >
          <td class="px-3">
            <StatusIcon :status="homework.status" />
          </td>
          <td class="pr-5">
            <Avatar :user="homework.user"/>
          </td>
          <td>
            <div class="flex items-center pl-1">
              <p class="font-medium leading-none text-gray-700 mr-2 truncate">
                {{ homework.title }}
              </p>
            </div>
          </td>
          <td class="pl-5">
            <div class="flex items-center text-gray-600" title="Materia">
              <i class="fa-solid fa-tag"></i>
              <p class="text-sm leading-none ml-2">
                {{ homework.school_subject.name }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center text-gray-600" title="Archivos adjuntos">
              <i class="fa-solid fa-paperclip"></i>
              <p class="text-sm leading-none ml-2">{{ homework.media.length }}</p>
            </div>
          </td>
          <td class="pl-2">
            <div
              class="inline py-3 px-3 text-sm focus:outline-none leading-none rounded"
              :class="homework.priority === 'Urgente' ? 'text-red-700 bg-red-100' : 'text-green-700 bg-green-100'"
              :title="'Prioridad: ' + homework.priority"
            >
              Límite: {{ homework.limit_date }}
            </div>
          </td>
          <td>
            <button
              @click="showDetails(homework)"
              class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 text-sm leading-none text-gray-600 mr-4 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">
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
import InputSearch from "@/Components/Common/InputSearch.vue";
import { Link } from "@inertiajs/inertia-vue3";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import DangerButton from "@/Jetstream/DangerButton.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
import StatusIcon from "@/Components/StatusIcon.vue";

export default {
  data() {
    return {

    };
  },
  components: {
    Pagination,
    Avatar,
    InputSearch,
    Link,
    DangerButton,
    SecondaryButton,
    StatusIcon,
  },
  props: {
    homeworks: Object,
    filters: Object,
    filterURL: String,
  },
  methods: {
    showDetails(prop) {
      this.$emit("details", prop);
    },
  },
};
</script>