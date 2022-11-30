<template>
  <div class="lg:flex justify-between items-center py-1 mt-2 space-x-1">
    <Pagination :pagination="collaborations" />
  </div>
  <div class="overflow-x-auto text-sm">
    <table v-if="collaborations.data.length" class="w-full whitespace-nowrap">
      <tbody>
        <tr
          v-for="collaboration in collaborations.data"
          :key="collaboration.id"
          class="
            focus:outline-none
            h-16
            border
            dark:border-slate-800
            border-gray-100
            rounded
          "
        >
          <td class="px-3 text-gray-400 text-xs">
            ID {{collaboration.id}}
          </td>
          <td class="px-3">
            <StatusIcon :status="collaboration.status" />
          </td>
          <td class="pr-10">
            <Avatar :user="collaboration.user" secondary_info="Colaborador" />
          </td>
          <td>
            <div>
              <p
                class="
                  font-medium
                  leading-none
                  dark:text-gray-300
                  text-gray-700
                  mr-2
                "
              >
                {{ collaboration.homework.title }}
              </p>
            </div>
          </td>
          <td class="pl-5">
            <div
              class="flex items-center dark:text-gray-300 text-gray-600"
              title="Materia"
            >
              <i class="fa-solid fa-tag"></i>
              <p class="text-sm leading-none ml-2">
                {{ collaboration.homework.school_subject.name }}
              </p>
            </div>
          </td>
          <td class="pl-2"></td>
          <td>
            <div
              class="flex items-center dark:text-gray-300"
              :title="
                'Por cobrar $' +
                collaboration.price +
                ' - ' +
                collaboration.tax +
                '% de comisión'
              "
            >
              <i class="fa-solid fa-dollar-sign"></i>
              <p class="text-sm leading-none dark:text-gray-300 text-gray-600">
                {{ collaboration.net_price }} MXN
              </p>
            </div>
          </td>
          <td class="pl-4">
            <div class="flex items-center">
              <i
                v-if="collaboration.payed_at.special"
                title="Pago realizado"
                class="fa-solid fa-hand-holding-dollar text-green-600"
              ></i>
              <i
                v-else-if="collaboration.bank_number"
                title="Esperando pago"
                class="fa-solid fa-hand-holding-dollar text-gray-500"
              ></i>
              <i
                v-else-if="collaboration.payment_released_at.special"
                class="fa-solid fa-unlock-keyhole text-green-600"
                title="Pago liberado"
              ></i>
              <i
                v-if="collaboration.rate"
                title="Tarea calificada"
                class="fa-solid fa-star text-yellow-500 ml-5"
              >
                <small>{{ collaboration.rate.stars }}</small>
              </i>
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
import { Link } from "@inertiajs/inertia-vue3";

export default {
  emits: ["details"],
  components: {
    Pagination,
    Avatar,
    StatusIcon,
    Link,
  },
  props: {
    collaborations: Object,
  },
  methods: {
    showDetails(item) {
      this.$emit("details", item);
    },
  },
};
</script>