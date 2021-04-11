<template>
  <div class="w-full min-h-screen antialiased font-roboto bg-nord0">
    <div class="absolute top-0 right-0">
      <div @click="isOpen = true" class="cursor-pointer select-none">
        <img src="assets/menu.svg" alt="menu-icon" class="w-16 h-16" />
      </div>
    </div>
    <div class="container px-2 mx-auto">
      <slot></slot>
    </div>
    <div class="absolute bottom-0 left-0 right-0 w-full">
      <div class="wave"></div>
      <div class="wave"></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false,
    };
  },
};
</script>