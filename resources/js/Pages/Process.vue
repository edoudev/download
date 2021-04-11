<template>
  <div class="relative flex flex-col items-center justify-center h-full">
    <preview
      :url="$page.props.url"
      class="animate__animated animate__fadeIn"
    ></preview>
    <div
      class="w-full h-1 max-w-2xl my-4 bg-nord1 animate__animated animate__fadeIn"
    />
    <div
      v-if="processing"
      class="text-lg animate__animated animate__slideInLeft text-nord6"
    >
      <div v-if="complete" class="">Done</div>
      <div v-else class="">En cours</div>
      En cours de traitement...
    </div>
  </div>
</template>

<script>
export default {
  layout: require("../Layouts/App").default,
  data() {
    return {
      processing: false,
      complete: false,
    };
  },
  mounted() {
    this.$inertia.post(
      this.$route("download"),
      { url: this.$page.props.url },
      {
        onStart: () => {
          this.processing = true;
        },
        onSuccess: () => {
          this.complete = true;
        },
      }
    );
  },
};
</script>
