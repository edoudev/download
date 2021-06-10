<template>
  <div class="relative flex flex-col items-center justify-center h-full">
    <div class="px-2 animate__animated animate__fadeIn">
      <div class="flex flex-col items-center mx-2 md:flex-row text-nord6">
        <a :href="content.url" target="_blank">
          <div class="w-48 h-full">
            <img
              :src="content.thumbnail"
              alt="preview"
              class="object-contain border-4 bg-nord1 border-nord1 rounded-3xl"
              draggable="false"
            />
          </div>
        </a>
        <div class="flex flex-col justify-center pt-2 md:pl-4 md:pt-0">
          <a :href="content.url" target="_blank">
            <h1 class="text-xl leading-tight">
              {{ content.title }}
            </h1>
          </a>
          <a :href="content.author_url" target="_blank">
            <div class="text-base font-bold">
              {{ content.author }}
            </div>
          </a>
          <div class="text-lg">
            {{
              Math.floor(content.duration / 60) +
              ":" +
              Math.trunc(
                content.duration - Math.floor(content.duration / 60) * 60
              )
                .toString()
                .padStart(2, "0")
            }}
          </div>
        </div>
      </div>
      <div class="w-full h-1 my-4 bg-nord1" />
    </div>
    <select
      v-model="selectedFormat"
      class="p-2 mb-4 text-lg rounded-lg text-nord5 bg-nord1"
    >
      <option value="placeholder" disabled hidden>
        Sélectionnez un format
      </option>
      <option
        v-for="(format, index) in content.formats"
        :key="index"
        :value="format.url"
      >
        {{
          (format.height
            ? "Vidéo " + format.height + "p"
            : "Audio " + format.abr + "kbps") +
          " - " +
          format.ext
        }}
      </option>
    </select>
    <div
      class="flex items-center text-lg  text-nord5 animate__animated animate__slideInLeft"
      v-if="selectedFormat != 'placeholder'"
    >
      <a
        :href="selectedFormat"
        target="_blank"
        class="px-4 py-3 rounded-lg bg-nord1"
        >Télécharger</a
      >
      <div class="px-2">ou</div>
      <button class="bg-tranparent" v-clipboard:copy="selectedFormat">
        copier le lien
      </button>
    </div>
  </div>
</template>

<script>
export default {
  layout: require("../Layouts/App").default,
  props: {
    content: Object,
  },
  data() {
    return {
      selectedFormat: "placeholder",
    };
  },
};
</script>
