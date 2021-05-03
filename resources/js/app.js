require("./bootstrap");
import { App, plugin } from "@inertiajs/inertia-vue";
import Vue from "vue";
import VueClipboard from "vue-clipboard2";

Vue.use(VueClipboard);
Vue.use(plugin);

Vue.prototype.$route = route;

const el = document.getElementById("app");
new Vue({
    render: h =>
        h(App, {
            props: {
                initialPage: JSON.parse(el.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(el);
