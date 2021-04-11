<template>
  <div class="flex text-nord6">
    <img
      @load="onLoad($event)"
      :src="'https://img.youtube.com/vi/' + id + '/' + quality[index] + '.jpg'"
      alt="preview"
      class="h-32 border-4 w-52 bg-nord1 border-nord1 rounded-3xl"
      draggable="false"
    />
    <div class="flex flex-col justify-center p-4">
      <h1 class="text-xl">{{ title }}</h1>
      <div class="text-lg font-bold">{{ author }}</div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["url"],
  data() {
    return {
      id: null,
      title: null,
      author: null,
      quality: [],
      index: 0,
    };
  },
  mounted() {
    this.id = this.url.match(
      /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11,11}).*/
    )[2];
    this.quality = ["maxresdefault", "hqdefault", "mqdefault", "sddefault"];

    window.axios
      .get("https://www.youtube.com/oembed?url=" + this.url + "&format=json")
      .then((response) => {
        this.title = response.data.title;
        this.author = response.data.author_name;
      });
  },
  methods: {
    onLoad(e) {
      if (e.target.naturalWidth == 120 && e.target.naturalHeight == 90) {
        if (this.index == this.quality.length - 1) return;
        this.index++;
      } else {
        e.target.classList.remove("w-52");
      }
    },
  },
};
</script>