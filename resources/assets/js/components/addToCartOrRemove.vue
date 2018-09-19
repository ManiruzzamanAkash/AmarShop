<template>
    <span v-if="cartAdded == false">
        <b-tooltip label="Click to add the product in the cart"
        type = "is-success">
        <button class="button is-primary" @click="addToCartOrRemove"> <i class="fa fa-cart-plus"></i> &nbsp; Add To Cart</button>
        </b-tooltip>
    </span>
    <span v-else>
        <b-tooltip label="Already added to cart !! Click to remove"
        type = "is-danger">
            <button class="button is-info" @click="addToCartOrRemove"> <i class="fa fa-cart-plus"></i> &nbsp; Added to Cart</button>
        </b-tooltip>
    </span>
    
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            cartAdded: false
        }
    },
    props: ['product_id'],

    methods: {
        addToCartOrRemove(){
            if (this.cartAdded) {
                this.cartAdded = false
                //Make a server request and add the product to the cart
            }else {
                this.cartAdded = true
            }
            
        }
    }
}
</script>
