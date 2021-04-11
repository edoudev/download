<template>
  <div class="relative h-full overflow-hidden">
    <div class="relative flex items-center justify-center h-full">
      <div
        ref="submit"
        class="relative flex w-full max-w-xl bg-nord0 text-nord4"
      >
        <input
          type="text"
          v-model="url"
          name="url"
          :class="{ 'border-nord11': $page.props.errors.url }"
          placeholder="https://www.youtube.com/watch?v=fC7oUOUEEi4"
          class="w-full px-3 py-2 text-xl bg-transparent border-4 border-r-0 shadow-md outline-none border-nord1 rounded-l-2xl"
          required
          autofocus
        />
        <button
          @click="submit()"
          :class="{ 'border-nord11': $page.props.errors.url }"
          class="pl-2 pr-3 duration-100 border-4 border-l-0 shadow-md outline-none select-none focus:bg-nord3 focus:outline-none rounded-r-2xl hover:bg-nord3 border-nord1 bg-nord2"
        >
          <img
            src="assets/submit.svg"
            alt="submit-icon"
            class="my-auto w-9 h-9"
          />
        </button>
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
    };
  },
  methods: {
    submit() {
      let regex = [
        /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11,11}).*/,
      ];

      let check = 0;
      regex.forEach((reg) => {
        if (this.url.match(reg)) check++;
      });

      if (check == 0) {
        this.$page.props.errors.url = "Veuillez entrer un lien valide";
      }

      // this.$refs.submit.classList.add("animate__animated", "animate__fadeOut");
      this.$inertia.post(this.$route("process"), { url: this.url });
      // this.$page.props.errors = {};
    },
  },
};
</script>