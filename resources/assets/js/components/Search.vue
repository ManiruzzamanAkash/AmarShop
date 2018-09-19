<template>
    <section>
        Query for - {{ search }}
        <input type="search" name="search" class="input" v-model="search" v-on:keyup="searchProduct()" placeholder="Please type a product by name or price">
        <div class="">
            <div class="card" v-for="product in products">
            <div class="card-content" >
                <a @click="goProduct(product.slug)">{{ product.title }}</a>
            </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    data() {
        return {
            search : '',
            products: [],
        }
    },
    computed: {

    },
    methods: {
        searchProduct() {
            
            axios.get('api/search/'+ this.search)
            .then(response =>{
                this.products = response.data
                //console.log(response)
            });
        },
        goProduct(slug){
            window.location = "/product/"+slug;
        }
    }
}
</script>