<template>
  <div
    v-if="$page.props.flash.message"
    class="
      absolute
      top-1
      left-1
      lg:left:1
      bg-green-100
      border border-green-600
      text-green-600 text-xs
      px-4
      py-2
      rounded-md
      m-1
      z-50
    "
  >
    <i class="fa-regular fa-circle-check mr-2"></i>
    {{ $page.props.flash.message }}
    <button @click="$page.props.flash.message = ''" class="text-green-500 hover:text-green-700 ml-2">X</button>
  </div>
</template>

<script>
export default {
    
};
</script>