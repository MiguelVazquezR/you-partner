<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <Pagination :pagination="errors" />
    <InputSearch
      :filters="filters"
      :filterURL="filterURL"
      class="mb-2 ml-4 flex-1"
    />
  </div>
  <div class="overflow-x-auto text-sm">
    <table v-if="errors.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="error in errors.data"
          :key="error.id"
          class="focus:outline-none h-16 border border-gray-100 rounded"
        >
          <td >
             <i v-if="error.is_error" title="Bug" class="text-lg fa-solid fa-bug text-green-600"></i>
             <i v-else title="sugest" class="text-lg fa-solid fa-thumbtack text-blue-500"></i>
          </td>
          <td class="pr-5">
            <Avatar :user="error.user" />
          </td>
          <td>
            <div>
              <p class="font-medium leading-none text-gray-700 mr-2">
                {{ error.subject }}
              </p>
            </div>
          </td>
          <td>
            <div>
              <p class="font-medium leading-none text-gray-700 mr-2">
                {{ error.created_at.special }}
              </p>
            </div>
          </td>
          <td>
            <div
            v-if="error.is_read"
              class="inline py-3 px-3 text-sm focus:outline-none leading-none rounded text-green-700 bg-green-100"
            >
              Revisado
            </div>
            <div
            v-else
              class="inline py-3 px-3 text-sm focus:outline-none leading-none rounded text-red-700 bg-red-100"
            >
              Pendiente
            </div>
          </td>
          <td class="pl-4">
            <button
              @click="showDetails(error)"
              class="
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
    errors: Object,
    filters: Object,
    filterURL: String,
  },
  methods:{
    showDetails(prop) {
      this.$emit('details',prop);
    }
  }
};
</script>