require("./bootstrap");
import { App, plugin } from "@inertiajs/inertia-vue";
import Vue from "vue";

Vue.use(plugin);
Vue.prototype.$route = route;

const files = require.context("./Components/", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);

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
