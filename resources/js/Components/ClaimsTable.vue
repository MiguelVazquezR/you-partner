<template>
  <div class="flex justify-between items-center py-1 mt-2">
    <Pagination :pagination="claims" />
  </div>
  <div class="overflow-x-auto text-sm px-4">
    <table v-if="claims.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="claim in claims.data"
          :key="claim.id"
          class="
            focus:outline-none
            h-16
            border border-gray-100
            bg-white
            rounded
          "
        >
          <td class="px-1 text-center">
            <i class="fa-solid fa-circle-exclamation text-red-500 text-xl"></i>
          </td>
          <td class="pr-5">
            <Avatar :user="claim.collaboration.homework.user" />
          </td>
          <td>
            <div class="flex items-center pl-1">
              <p class="font-medium leading-none text-gray-700 mr-2">
                {{ claim.collaboration.homework.title }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center" title="Materia">
              <i class="fa-solid fa-tag"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">
                {{ claim.collaboration.homework.school_subject.name }}
              </p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center" title="Preguntas o comentarios">
              <i class="fa-solid fa-comment-dots"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">0</p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center" title="Archivos adjuntos">
              <i class="fa-solid fa-paperclip"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">0</p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center" title="Solicitudes de colaboración">
              <i class="fa-solid fa-user"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">2</p>
            </div>
          </td>
          <td class="pl-2">
            <div class="flex items-center" title="Fecha de reclamo">
              <i class="fa-regular fa-calendar"></i>
              <p class="text-sm leading-none text-gray-600 ml-2">
                {{ claim.created_at.special }}
              </p>
            </div>
          </td>
          <td class="pl-2">
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
                text-center
              "
              v-if="claim.status == 'Abierto'"
            >
              {{ claim.status }}
            </div>
            <div
              class="
                py-3
                px-3
                text-sm
                focus:outline-none
                leading-none
                text-green-700
                bg-green-100
                rounded
                text-center
              "
              v-else
            >
              {{ claim.status }}
            </div>
          </td>
          <td class="pl-4">
            <button
              @click="showDetails(claim.collaboration.homework)"
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
import Input from "@/Jetstream/Input.vue";
import { Link } from "@inertiajs/inertia-vue3";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import DangerButton from "@/Jetstream/DangerButton.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default {
  data() {
    return {};
  },
  emits: ["details"],
  components: {
    Pagination,
    Avatar,
    Input,
    Link,
    DangerButton,
    ConfirmationModal,
    SecondaryButton,
  },
  props: {
    claims: Object,
  },
  methods: {
    showDetails(prop) {
      this.$emit("details", prop);
    },
  },
};
</script>