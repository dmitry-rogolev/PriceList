import "../node_modules/bootstrap/dist/css/bootstrap.min.css";

import { createApp, reactive, ref }     from 'vue';
import { createStore }                  from 'vuex';

import $ from "jquery";

import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

import router   from "./lib/Router";

import App from './App.vue';

import FlexComponent from "./components/FlexComponent.vue";
import ModalComponent from "./components/ModalComponent.vue";
import SpinnerComponent from "./components/SpinnerComponent.vue";
import SelectComponent from "./components/form/SelectComponent.vue";
import InputComponent from "./components/form/InputComponent.vue";
import SearchComponent from "./components/form/SearchComponent.vue";

const store = createStore({
    state() 
    {
        return {
            header: null, 
            products: null, 
            token: $('meta[name="csrf-token"]').attr('content'), 
        };
    }, 

    mutations: {
        header(state, header)
        {
            state.header = ref(header);
        }, 

        products(state, products)
        {
            state.products = products ? reactive(products) : ref(products);
        }, 

        token(state, token)
        {
            state.token = ref(token);
            $('meta[name="csrf-token"]').attr('content', token);
        }, 
    }, 

    actions: {
        async products(context)
        {
            let data = await $.ajax({
                url: "/", 
                method: "POST", 
                data: {
                    _token: context.state.token, 
                }, 
                headers: {
                    "X-CSRF-TOKEN": context.state.token, 
                }, 
            });

            context.commit("header", data.header);
            context.commit("products", data.products);
        }, 
    }, 
});

const app = createApp(App);

app.config.unwrapInjectedRef = true;

app.use(router);
app.use(store);

app.component("FlexComponent", FlexComponent);
app.component("ModalComponent", ModalComponent);
app.component("SpinnerComponent", SpinnerComponent);
app.component("SelectComponent", SelectComponent);
app.component("InputComponent", InputComponent);
app.component("SearchComponent", SearchComponent);

app.mount("#app");
