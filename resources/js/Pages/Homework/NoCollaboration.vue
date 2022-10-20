<template>
  <AppLayout :class="dark_mode" title="Tareas">
    <div class="bg-white transition-dark dark:bg-slate-900 py-4 md:py-7 px-4 md:px-8 xl:px-10">
      <Tabs :tabs="tabs" />
      <button @click="toggleDark" class="btn-primary">
      <i v-if="dark_mode" class="fa-solid fa-sun"></i>
      <i v-else class="fa-solid fa-moon"></i>
    </button>
      <div class="flex justify-end mt-3">
        <Link :href="route('homeworks.create')" class="btn-primary">
          + Crear
        </Link>
      </div>
      <HomeworkTable
        :homeworks="homeworks" 
        :filters="filters"
        filterURL="/homeworks"
        canEdit
        canDelete
        @details="showDetails($event)"
      />
    </div>
    <DetailsModal :show="side_modal" @close="side_modal = false">
       <template #title>
        <div class="flex flex-col">
          <h1 class="text-indigo-600 text-xl font-semibold">
            {{ homework_detail.title }}
          </h1>
          <div class="flex justify-between">
            <small class="text-indigo-400 text-xs">
              <i class="fa-solid fa-tag"></i>
              {{ homework_detail.school_subject.name }}
            </small>
            <small class="text-xs px-2 rounded-md"
              :class="homework_detail.priority === 'Urgente' ? 'text-red-700 bg-red-100' : 'text-green-700 bg-green-100'"
              :title="'Prioridad: ' + homework_detail.priority">
              Entrega: {{ homework_detail.limit_date }}
            </small>
          </div>
        </div>
      </template>
      <template #content>
        <section class="mt-3">
          <div>
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-circle-info mr-2"></i>
              <span>Descripción</span>
            </h1>
            <div>
              <p class="text-sm text-gray-500">{{ homework_detail.description }}</p>
            </div>
          </div>
          <div class="mt-5">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-comment-dots mr-2"></i>
              <span>Preguntas y comentarios</span>
            </h1>
            <div
              class="border rounded-md border-dotted max-h-[35vh] min-h-[10vh] overflow-y-auto px-1 py-2 divide-y">
              <div
                @click="dialog_modal = true; show_messages = true; chat_to_show = item"
                v-for="item in homework_detail.chats"
                :key="item.id"
                class="grid grid-cols-2 gap-x-2 hover:bg-gray-100 cursor-pointer rounded"
                :class="{'border-l-4 border-l-indigo-500 bg-indigo-50 hover:bg-indigo-100 font-bold': !getLastMessage(excludeMyMessages(item.messages))[0].read_at.relative}">                
                  <Avatar class="inline-block"
                    :user="getLastMessage(excludeMyMessages(item.messages))[0].user"
                    :secondary_info="getLastMessage(excludeMyMessages(item.messages))[0].created_at.relative"
                  />
                  <p class="text-xs text-gray-600 truncate pt-2">
                    {{ getLastMessage(excludeMyMessages(item.messages))[0].content }}
                  </p>
              </div>
              <p
                v-if="!homework_detail.chats.length"
                class="text-center text-gray-400 text-xs pt-3"
              >
                No tienes ningún comentario o pregunta
              </p>
            </div>
          </div>
          <div class="mt-6">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-handshake-angle mr-2"></i>
              <span>Solicitudes de colaboración</span>
            </h1>
            <div class="mt-1">
              <div
                class="border rounded-md border-dotted  max-h-[35vh] min-h-[10vh] overflow-y-auto px-1 py-2 divide-y">
                <div
                  @click="dialog_modal = true; show_applicants = true; applicant_collaboration = item"
                  v-for="item in homework_detail.collaborations"
                  :key="item"
                  class="grid grid-cols-2 gap-x-2 hover:bg-gray-100 cursor-pointer rounded"
                  :class="{'border-l-4 border-l-indigo-500 bg-indigo-50 hover:bg-indigo-100 font-bold': !item.read_at.relative}">
                  <Avatar
                    :user="item.user"
                    :secondary_info="item.created_at.relative"
                  />
                </div>
                <p
                  v-if="!homework_detail.collaborations.length"
                  class="text-center text-gray-400 text-xs pt-3"
                >
                  No tienes ninguna solicitud
                </p>
              </div>
            </div>
          </div>
          <div class="mt-6">
            <h1 class="text-lg text-gray-600">
              <i class="fa-solid fa-paperclip mr-2"></i>
              <span>Archivos adjuntos</span>
            </h1>
            <div v-if="homework_detail.media.length" class="mt-1 flex flex-col">
                <AttachedFile v-for="(file, index) in homework_detail.media" :key="index" :name="file.name" :extension="file.mime_type.split('/')[1]" :href="file.original_url" />
            </div>
            <p v-else class="text-center text-gray-400 text-xs pt-3">
                  No hay recursos para esta tarea
            </p>
          </div>
        </section>
      </template>
      <template #footer>
        <div class="flex">
          <Link :href="route('homeworks.create')" class="btn-primary">Editar</Link>
          <button @click="side_modal = false" class="btn-secondary mx-2">
            Cerrar
          </button>
        </div>
      </template>
    </DetailsModal>
    <DialogModal
      :show="dialog_modal"
      @close="
        dialog_modal = false;
        show_applicants = false;
        show_chat = false;
        show_payment = false;
      "
    >
      <template #title>
        <div v-if="show_chat" class="font-bold text-gray-600">
          Mensajes <br />
          <span class="text-indigo-500 font-normal">
            {{ homework_detail.title }}
          </span>
        </div>
        <div v-else-if="show_applicants" class="font-bold text-gray-600">
          Aplicantes a colaborar <br />
          <span class="text-indigo-500 font-normal">
            {{ homework_detail.title }}
          </span>
        </div>
        <div v-else-if="show_payment" class="font-bold text-gray-600">
          Pagar colaboración <br />
          <span class="text-indigo-500 font-normal">
            {{ homework_detail.title }}
          </span>
        </div>
      </template>
      <template #content>
        <MessagesModal :chat="chat_to_show" v-if="show_chat" />
        <CollaborationModal
          :collaboration="applicant_collaboration"
          v-else-if="show_applicants"
          @accepted="showPayment"
        />
        <PaymentModal
          :collaboration="applicant_collaboration"
          v-else-if="show_payment"
          @cancel="show_payment = false; show_applicants = true"
        />
      </template>
      <template #footer></template>
    </DialogModal>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import HomeworkTable from "@/Components/HomeworkTable.vue";
import Tabs from "@/Components/Tabs.vue";
import DetailsModal from "@/Components/DetailsModal.vue";
import Avatar from "@/Components/Avatar.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import AttachedFile from "@/Components/AttachedFile.vue";
import MessagesModal from "@/Components/MessagesModal.vue";
import CollaborationModal from "@/Components/CollaborationModal.vue";
import PaymentModal from "@/Components/PaymentModal.vue";
import CollaborationApplicants from "@/Components/CollaborationApplicants.vue";
import ChatList from "@/Components/ChatList.vue";


export default {
  data() {
    return {
      dark_mode: '',
      homework_detail: {},
      side_modal: false,
      dialog_modal: false,
      show_applicants: false,
      show_chat: false,
      applicant_collaboration: null,
      chat_to_show: null,
      tabs: [
        {
          label: "Todas",
          url: "homeworks.index",
        },
        {
          label: "Pendientes",
          url: "homeworks.no-collaboration",
        },
        {
          label: "En colaboracion",
          url: "homeworks.on-collaboration",
        },
        {
          label: "Terminados",
          url: "homeworks.completed",
        },
         {
          label: "Reclamos",
          url: "homeworks.claims",
        },
      ],
    };
  },
  components: {
    AppLayout,
    Link,
    HomeworkTable,
    Tabs,
    DetailsModal,
    Avatar,
    DialogModal,
    AttachedFile,
    MessagesModal,
    CollaborationModal,
    PaymentModal,
    CollaborationApplicants,
    ChatList,
  },
  props: {
    homeworks: Object,
    filters: Object,
  },
  methods: {
    showDetails(event) {
      this.homework_detail = event;
      this.side_modal = true;
    },
     showChat(item) {
      this.chat_to_show = item;
      this.dialog_modal = true;
      this.show_chat = true;
    },
    showApplicant(item) {
      this.applicant_collaboration = item;
      this.dialog_modal = true;
      this.show_applicants = true;
    },
    showPayment() {
      this.show_applicants = false;
      this.show_payment = true;
    },
    toggleDark(){
      if(this.dark_mode){
        this.dark_mode = '';
      }else{
        this.dark_mode= 'dark';
      }
    },
  },
};
</script>
