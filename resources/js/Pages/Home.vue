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
        class="flex w-full max-w-xl  animate__animated animate__fadeIn text-nord4"
        v-if="!processing"
      >
        <input
          type="text"
          v-model="url"
          name="url"
          :class="{ 'border-nord11': errors }"
          class="w-full px-3 py-2 text-xl border-4 border-r-0 shadow-md outline-none  bg-nord0 border-nord1 rounded-l-2xl"
          placeholder="Entrez un lien ici"
          required
          autofocus
        />
        <button
          @click="submit()"
          :class="{ 'border-nord11': errors }"
          class="pl-2 pr-3 duration-100 border-4 border-l-0 shadow-md outline-none select-none  focus:bg-nord3 focus:outline-none rounded-r-2xl hover:bg-nord3 border-nord1 bg-nord2"
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