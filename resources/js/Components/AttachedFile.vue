<template>
  <a :href="url" target="_blank"
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
          extension === 'xls' || extension === 'xlsx',
        'fa-file-image text-sky-500': image_allowed.includes(extension),
      }"
    ></i>
    <span
      class="text-sm"
      :class="{
        'text-red-800': extension === 'pdf',
        'text-blue-800': extension === 'doc' || extension === 'docx',
        'text-orange-700': extension === 'ppt',
        'text-green-800': extension === 'xls' || extension === 'xlsx',
        'text-sky-800': image_allowed.includes(extension),
      }"
      >{{ name }}</span
    >
  </a>
</template>

<script>
export default {
  data() {
    return {
      image_allowed: ["png", "jpeg", "jpg", "bmp"],
    };
  },
  props: {
    name: String,
    extension: String,
    url: String,
  },
};
</script>