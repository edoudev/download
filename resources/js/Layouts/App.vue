<template>
  <div class="w-full min-h-screen antialiased font-roboto bg-nord0">
    <div class="container px-2 mx-auto">
      <slot></slot>
    </div>
    <div
      class="absolute bottom-0 left-0 right-0 z-10 flex flex-col items-center justify-center mb-2  text-nord4"
    >
      <div>
        Réalisé avec
        <span
          class="text-transparent select-none"
          style="text-shadow: 0 0 #f472b6"
          >❤️</span
        >
        par
        <a
          href="https://edou.dev/"
          target="_blank"
          class="duration-100 hover:text-nord6"
          >Edouard</a
        >
      </div>
      <span>
        {{ $page.props.version + " - " }}
        <a
          href="https://github.com/yesouisida/download"
          target="_blank"
          class="duration-100 hover:text-nord6"
          >Github</a
        >
      </span>
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