<template>
    <div class="col-lg-4 col-md-6">
        <div class="single-product">
            <div class="product-img">
                <img :src="data.image" class="img-fluid w-100" :alt="data.title"/>

            <div class="p_icon">
                <a :href="data.view">
                <i class="ti-eye"></i>
                </a>
                <a :href="data.cart">
                <i class="ti-shopping-cart"></i>
                </a>
            </div>
            </div>
            <div class="product-btm">
            <a :href="data.view" class="d-block">
                <h4>{{data.title}}</h4>
            </a>
            <div class="mt-3">
                <span class="mr-4">{{data.offer_price}}</span>
                <del>{{data.price}}</del>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>







