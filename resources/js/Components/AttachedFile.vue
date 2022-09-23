<template>
  <p
    class="cursor-pointer hover:scale-105 transition duration-100 inline-block"
  >
    <i
      class="fa-solid text-2xl mr-2"
      :class="{
        'fa-file-pdf text-red-600': extension === 'pdf',
        'fa-file-word text-blue-600':
          extension === 'doc' || extension === 'docx',
        'fa-file-powerpoint text-orange-500': extension === 'ppt',
        'fa-file-excel text-green-600':
          extension === 'xlc' || extension === 'clv',
        'fa-file-image text-sky-500':
          extension === 'png' ||
          extension === 'jpeg' ||
          extension === 'jpg' ||
          extension === 'bmp',
      }"
    ></i>
    <span
      class="text-sm"
      :class="{
        'text-red-800': extension === 'pdf',
        'text-blue-800': extension === 'doc' || extension === 'docx',
        'text-orange-700': extension === 'ppt',
        'text-green-800': extension === 'xlc' || extension === 'clv',
        'text-sky-800':
          extension === 'png' ||
          extension === 'jpeg' ||
          extension === 'jpg' ||
          extension === 'bmp',
      }"
      >{{ name }}</span
    >
  </p>
</template>

<script>
export default {
  props: {
    name: String,
    extension: String,
  },
};
</script>