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
            <i v-if="!homework.collaboration" class="fa-solid fa-bullseye text-red-300" title="Sin colaboración"></i>
            <i v-else-if="homework.collaboration.status == 'En proceso'" class="fa-solid fa-spinner text-yellow-300" title="En proceso"></i>
            <i v-else class="fa-solid fa-check text-green-300" title="Terminado"></i>
          </td>
          <td v-if="withAvatar" class="pr-5">
            <Avatar :user="homework.collaboration ? homework.collaboration.user : homework.user " />
          </td>
          <td>
            <div class="flex items-center pl-5">
              <p class="font-medium leading-none text-gray-700 mr-2">
                {{ homework.title }}
              </p>
            </div>
          </td>
          <td class="pl-20">
            <div class="flex items-center">
              <i class="fa-solid fa-tag"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">
                {{ homework.school_subject.name }}
              </p>
            </div>
          </td>
          <td class="pl-5">
            <div class="flex items-center">
              <i class="fa-solid fa-comment-dots"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">0</p>
            </div>
          </td>
          <td class="pl-5">
            <div class="flex items-center">
              <i class="fa-solid fa-paperclip"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">
                {{ homework.resources.length }}
              </p>
            </div>
          </td>
          <td class="pl-5">
            <div
              class="
                py-3
                px-3
                text-sm
                focus:outline-none
                leading-none
                text-red-700
                bg-red-100
                rounded
              "
            >
              Para: 01/01/2022
            </div>
          </td>
          <td class="pl-4">
            <button
              class="
                focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300
                text-sm
                leading-none
                text-gray-600
                mr-4
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
          <td class="pl-5" v-if="canDelete && canEdit">
            <div class="flex items-center text-xs text-gray-300">
              <Link
                v-if="canEdit"
                :href="route('homeworks.edit', homework)"
                class="mr-2 hover:text-blue-300"
              >
                <i class="fa-solid fa-pen"></i>
              </Link>
              <Link
                v-if="canDelete"
                :href="route('homeworks.destroy', homework)"
                class="mr-2 hover:text-red-300"
              >
                <i class="fa-solid fa-trash"></i>
              </Link>
            </div>
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
    homeworks: Object,
    filters: Object,
    filterURL: String,
    canEdit: Boolean,
    canDelete: Boolean,
    withAvatar: Boolean,
  },
};
</script>