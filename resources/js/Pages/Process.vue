<template>
  <div class="relative flex flex-col items-center justify-center h-full">
    <div class="px-2 animate__animated animate__fadeIn">
      <div class="flex items-center mx-2 text-nord6">
        <a :href="$page.props.content.url">
          <div class="w-48 h-full">
            <img
              :src="$page.props.content.thumbnail"
              alt="preview"
              class="object-contain border-4 bg-nord1 border-nord1 rounded-3xl"
              draggable="false"
            />
          </div>
        </a>
        <div class="flex flex-col justify-center pl-4">
          <a :href="$page.props.content.url">
            <h1 class="text-xl leading-tight">
              {{ $page.props.content.title }}
            </h1>
          </a>
          <a :href="$page.props.content.author_url">
            <div class="text-base font-bold">
              {{ $page.props.content.author }}
            </div>
          </a>
          <div class="text-lg">
            {{
              Math.floor($page.props.content.duration / 60) +
              ":" +
              Math.trunc(
                $page.props.content.duration -
                  Math.floor($page.props.content.duration / 60) * 60
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
        v-for="(format, index) in $page.props.content.formats"
        :key="index"
        :value="format.url"
      >
        {{
          (format.height
            ? format.height + "p"
            : "Audio " + format.abr + "kbps") +
          " - " +
          format.ext
        }}
      </option>
    </select>
    <div
      class="flex items-center text-lg text-nord5 animate__animated animate__slideInLeft"
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
    <!-- <inertia-link href="/" method="get" class="text-base text-nord4"
      >convertir autre chose</inertia-link
    > -->
  </div>
</template>

<script>
export default {
  layout: require("../Layouts/App").default,
  data() {
    return {
      selectedFormat: "placeholder",
    };
  },
};
</script>
