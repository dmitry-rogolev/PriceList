<template>
    <FlexComponent :classes="[ 'justify-content-center', 'align-items-center', 'min-vh-100', 'bg-secondary', 'p-3' ]">
        <div v-if="products" :class="[ 'card', 'text-dark', 'p-0' ]">
            <div class="card-header">
                <h3 :class="[ 'card-title', 'text-center', 'mb-3' ]">{{ header }}</h3>
                <FlexComponent classes="justify-content-center">
                    <SearchComponent />
                </FlexComponent>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Единица измерения</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.id" class="text-center">
                            <td>{{ product.id }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.measure }}</td>
                            <td>{{ product.price }}</td>
                            <td>{{ product.count }}</td>
                            <td>
                                <ModalComponent :buttonClasses="[ 'btn-success', 'px-2' ]" @show="prepareChangeProduct(product)" @save.enter="change(product)" title="Редактировать" header="Редактировать товар">
                                    <template v-slot:button>
                                        &#9997;
                                    </template>
                                    <template v-slot:window>
                                        <div class="mb-2">
                                            <InputComponent v-model="name" name="name" type="text" placeholder="Название" label="Название" autocomplete="off" />
                                        </div>
                                        <div class="mb-2">
                                            <InputComponent v-model="measure" name="measure" type="text" placeholder="Единица измерения" label="Единица измерения" autocomplete="off" />
                                        </div>
                                        <div class="mb-2">
                                            <InputComponent v-model="price" name="price" type="number" placeholder="Цена" label="Цена" autocomplete="off" />
                                        </div>
                                        <div class="mb-2">
                                            <InputComponent v-model="count" name="count" type="number" placeholder="Количество" label="Количество" autocomplete="off" />
                                        </div>
                                    </template>
                                </ModalComponent>
                            </td>
                            <td>
                                <button @click="remove(product)" type="button" :class="[ 'btn', 'btn-danger' ]">&#10006;</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <FlexComponent classes="justify-content-center">
                    <ModalComponent :buttonClasses="[ 'btn-primary', 'px-3' ]" @save.enter="add" @show="prepareAddProduct" title="Добавить" header="Добавить товар">
                        <template v-slot:button>
                            +
                        </template>
                        <template v-slot:window>
                            <div class="mb-2">
                                <InputComponent v-model="name" name="name" type="text" placeholder="Название" label="Название" autocomplete="off" />
                            </div>
                            <div class="mb-2">
                                <InputComponent v-model="measure" name="measure" type="text" placeholder="Единица измерения" label="Единица измерения" autocomplete="off" />
                            </div>
                            <div class="mb-2">
                                <InputComponent v-model="price" name="price" type="number" placeholder="Цена" label="Цена" autocomplete="off" />
                            </div>
                            <div class="mb-2">
                                <InputComponent v-model="count" name="count" type="number" placeholder="Количество" label="Количество" autocomplete="off" />
                            </div>
                        </template>
                    </ModalComponent>
                </FlexComponent>
            </div>
        </div>
        <SpinnerComponent classes="text-light" v-else />
    </FlexComponent>
</template>

<script>
    import $ from "jquery";

    export default {
        name: "WelcomeComponent", 

        computed: {
            header()
            {
                return this.$store.state.header;
            }, 

            products()
            {
                return this.$store.state.products;
            }, 

            token()
            {
                return this.$store.state.token;
            }, 
        }, 

        data()
        {
            return {
                name: null, 
                measure: null, 
                price: null, 
                count: null, 
            };
        }, 

        methods: {
            async add()
            {
                let data = await $.ajax({
                    url: "/product/add",
                    method: "POST", 
                    data: {
                        _token: this.token, 
                        name: this.name, 
                        measure: this.measure, 
                        price: this.price, 
                        count: this.count, 
                    }, 
                    headers: {
                        "X-CSRF-TOKEN": this.token, 
                    }, 
                });

                this.$store.commit("products", data.products);

                this.name = null;
                this.measure = null; 
                this.price = null;
                this.count = null;
            }, 

            prepareAddProduct()
            {
                this.name = null;
                this.measure = null; 
                this.price = null;
                this.count = null;
            }, 

            prepareChangeProduct(product)
            {
                this.name = product.name;
                this.measure = product.measure;
                this.price = product.price;
                this.count = product.count;
            }, 

            async change(product)
            {
                let data = await $.ajax({
                    url: "/product/" + product.id + "/change",
                    method: "POST", 
                    data: {
                        _token: this.token, 
                        name: this.name, 
                        measure: this.measure, 
                        price: this.price, 
                        count: this.count, 
                    }, 
                    headers: {
                        "X-CSRF-TOKEN": this.token, 
                    }, 
                });

                this.$store.commit("products", data.products);

                this.name = null;
                this.measure = null; 
                this.price = null;
                this.count = null;
            }, 

            async remove(product)
            {
                let data = await $.ajax({
                    url: "/product/" + product.id + "/remove", 
                    method: "POST", 
                    data: {
                        _token: this.token, 
                    }, 
                    headers: {
                        "X-CSRF-TOKEN": this.token, 
                    }, 
                });

                this.$store.commit("products", data.products);
            }, 
        }, 

        beforeMount()
        {
            this.$store.dispatch("products");
        }, 

        beforeUnmount()
        {
            this.$store.commit("header", null);
            this.$store.commit("products", null);
        }, 
    }
</script>

<style>

</style>
