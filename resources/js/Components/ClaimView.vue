<template>
  <div>
    <p class="text-sm dark:text-gray-300">
      <strong v-if="collaboration.homework"
        >{{ collaboration.homework.user.name }} -</strong
      >
      <strong class="dark:text-gray-300" v-else>Usted -</strong>

      {{ collaboration.claim.created_at.special }}
    </p>
    <p style="white-space: pre-line" class="text-xs dark:text-gray-500">
      {{ collaboration.claim.description }}
    </p>
    <div class="mt-2 flex flex-col">
      <AttachedFile
        v-for="file in collaboration.claim.media"
        :key="file.id"
        :name="file.name"
        :extension="file.mime_type.split('/')[1]"
        :href="file.original_url"
      />
    </div>
    <div v-if="collaboration.claim.solution">
      <p class="text-sm dark:text-gray-300">
        <strong>Soporte</strong> -
        {{ collaboration.claim.updated_at.special }}
      </p>
      <p style="white-space: pre-line" class="text-xs dark:text-gray-500">
        {{ collaboration.claim.solution_details }}
      </p>
      <br />
      <strong class="text-sm dark:text-gray-300">Solución -</strong>
      <p class="text-indigo-600 px-2 text-sm">{{ collaboration.claim.solution }}</p>
    </div>
    <p v-else class="text-sm mt-3 dark:text-gray-500">
      Estamos evaluando el caso. Cuando tengamos una solución te avisaremos.
    </p>
  </div>
</template>

<script>
export default {
  props: {
    collaboration: Object,
  },
};
</script>
