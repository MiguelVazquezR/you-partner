<template>
  <div>
    <p class="text-sm">
      <strong v-if="collaboration.homework">{{ collaboration.homework.user.name }} -</strong>
            <strong v-else>Usted -</strong>

      {{ collaboration.claim.created_at.special }}
    </p>
    <p style="white-space: pre-line" class="text-xs">
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
      <p class="text-sm">
        <strong>Soporte</strong> -
        {{ collaboration.claim.updated_at.special }}
      </p>
      <p style="white-space: pre-line" class="text-xs">
        {{ collaboration.claim.solution_details }}
      </p> <br>
      <strong class="text-sm">Solución -</strong>
      <p class="text-indigo-600 px-2 text-sm">{{ collaboration.claim.solution }}</p>
    </div>
    <p v-else class="text-sm mt-3">
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