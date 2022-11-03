<template>
    <div :class="[ 'form-inline', classes ]">
        <div class="input-group">
            <input type="search" v-model="query" name="search" placeholder="Поиск" :class="[ 'form-control', 'bg-light', 'border-dark', 'text-dark' ]" autocomplete="off" required />
            <button type="button" @click="search" :class="[ 'btn', 'btn-dark', 'search-icon' ]">&#128269;</button>
        </div>
    </div>
</template>

<script>
    import $ from "jquery";

    export default {
        name: "SearchComponent", 

        props: [
            "classes", 
        ], 

        data()
        {
            return {
                query: "", 
            };
        }, 

        computed: {
            token()
            {
                return this.$store.state.token;
            }, 
        }, 

        methods: {
            async search()
            {
                let data = await $.ajax({
                    url: "/search", 
                    method: "POST", 
                    data: {
                        _token: this.token, 
                        q: this.query, 
                    }, 
                    headers: {
                        "X-CSRF-TOKEN": this.token, 
                    }, 
                });

                this.$store.commit("products", JSON.parse(data.products));
            }
        }, 
    }
</script>

<style scoped>
    .search-icon {
        background-position: center center;
        background-size: contain;
        background-repeat: no-repeat;
    }
</style>
