<template>
  <!-- sidebar -->
  <div class="h-screen hidden lg:block shadow-gray-500/100 dark:shadow-indigo-500/100 shadow-xl relative">
    <div class="bg-white h-full transition-dark dark:bg-slate-900">
      <div class="flex items-center justify-center pt-12 pb-2">
        <JetApplicationMark class="block h-14 w-auto" />
      </div>
      <nav class="mt-12">
        <div>
          <JetNavLink
            :href="route('dashboard')"
            :active="route().current('dashboard')"
          >
            <span class="text-left">
              <i class="fas fa-tachometer-alt"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Panel de información </span>
          </JetNavLink>
          <JetNavLink
            :href="route('homeworks.index')"
            :active="route().current('homeworks.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-file-pen"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Mis tareas </span>
          </JetNavLink>
          <JetNavLink
            :href="route('collaborations.index')"
            :active="route().current('collaborations.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-handshake-angle"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Colaborar </span>
          </JetNavLink>
          <JetNavLink
            :href="route('ranking.index')"
            :active="route().current('ranking.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-ranking-star"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Ranking </span>
          </JetNavLink>
          <JetNavLink
            :href="route('library.index')"
            :active="route().current('library.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-book"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Biblioteca </span>
          </JetNavLink>
          <JetNavLink
            :href="route('error-reports.index')"
            :active="route().current('errors.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-headset"></i>
            </span>
            <span class="mx-4 text-sm font-normal">
              Errores y sugerencias {{ $page.props.user}}
            </span>
          </JetNavLink>
          <JetNavLink v-if="$page.props.user.is_admin"
            :href="route('admin.finances')"
            :active="route().current('admin.*')"
          >
            <span class="text-left">
              <i class="fa-solid fa-user-secret"></i>
            </span>
            <span class="mx-4 text-sm font-normal"> Administrador </span>
          </JetNavLink>
        </div>
      </nav>
    </div>
  </div>
</template>
<script>
import JetNavLink from "@/Jetstream/NavLink.vue";
JetApplicationMark;
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";

export default {
  components: {
    JetNavLink,
    JetApplicationMark,
  },
};
</script>
<style>
</style>