<template>
  <div class="h-full overflow-hidden">
    <div></div>
    <div class="flex flex-col items-center justify-center h-full">
      <div class="animate__animated animate__zoomIn" v-if="processing">
        <img
          class="w-24 h-24 spin"
          src="/assets/spin.svg"
          alt="processing"
          draggable="false"
        />
      </div>
      <div
        ref="submit"
        class="flex w-full max-w-xl animate__animated animate__fadeIn bg-nord0 text-nord4"
        v-if="!processing"
      >
        <input
          type="text"
          v-model="url"
          name="url"
          :class="{ 'border-nord11': errors }"
          class="w-full px-3 py-2 text-xl bg-transparent border-4 border-r-0 shadow-md outline-none border-nord1 rounded-l-2xl"
          placeholder="Paste link here"
          required
          autofocus
        />
        <button
          @click="submit()"
          :class="{ 'border-nord11': errors }"
          class="pl-2 pr-3 duration-100 border-4 border-l-0 shadow-md outline-none select-none focus:bg-nord3 focus:outline-none rounded-r-2xl hover:bg-nord3 border-nord1 bg-nord2"
        >
          <img
            src="assets/submit.svg"
            alt="submit-icon"
            class="my-auto w-9 h-9"
          />
        </button>
      </div>
      <div
        v-for="(error, index) in errors"
        :key="index"
        class="py-2 text-xl text-nord11 animate__animated animate__fadeIn"
      >
        {{ error }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: require("../Layouts/App").default,
  data() {
    return {
      url: "",
      errors: null,
      processing: false,
    };
  },
  methods: {
    submit() {
      // let regex = [
      //   /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11,11}).*/,
      //   /^https?:\/\/twitter\.com\/(?:#!\/)?(\w+)\/status(es)?\/(\d+)/,
      // ];

      // let check = 0;
      // regex.forEach((reg) => {
      //   if (this.url.match(reg)) check++;
      // });

      // if (check == 0) {
      //   this.errors = "Veuillez entrer un lien valide";
      //   return;
      // }

      this.$inertia.post(
        this.$route("process"),
        { url: this.url },
        {
          onStart: () => {
            this.errors = null;
            this.processing = true;
          },
          onError: (errors) => {
            this.errors = errors;
            this.processing = false;
          },
        }
      );
    },
  },
};
</script>