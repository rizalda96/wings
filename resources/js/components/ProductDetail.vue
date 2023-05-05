<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="mt-8">
                    <b-card class="mb-2">
                        <div class="d-flex justify-content-center mb-4">
                            <h3>Product Detail</h3>
                        </div>
                        <b-row>
                            <b-col sm="6">
                                <b-img :src='`https://picsum.photos/300/150/?image=${$route.params.index}`' rounded fluid></b-img>
                            </b-col>
                            <b-col>
                                <b-row class="d-flex">
                                    <div class="mr-auto">
                                        <div>
                                            {{ product_name }}
                                        </div>
                                        <template v-if="discount != 0">
                                            <s>Rp. {{ price }}</s>
                                        </template>
                                        <template v-else>
                                            <div>Rp. {{ price }}</div>
                                        </template>

                                        <div v-if="discount != 0">Rp. {{ newPrice }}</div>
                                        <div>Dimension: {{ dimension }}</div>
                                        <div>Price Unit: {{ unit }}</div>
                                        <b-button
                                            variant="primary"
                                            pill
                                            class="mt-3 pl-5 pr-5"
                                        >Buy</b-button>
                                    </div>
                                </b-row>
                            </b-col>
                        </b-row>
                    </b-card>
                    <!-- <div class="d-flex justify-content-center">
                        <b-button variant="primary" pill class="pl-5 pr-5">Checkout</b-button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'product-detail',
        data() {
            return {
                product_code: null,
                product_name: null,
                price: null,
                discount: null,
                totalDiscount: null,
                newPrice: null,
                dimension: null,
                unit: null,
            }
        },
        async created() {
            await this.fetchData(this.$route.params.code)
        },
        methods: {
            async fetchData(code) {
                try {
                    let { data } = await this.$http.get(
                        this.$app.route('product.show', {
                            code: code
                        })
                    )
                    this.price = data.data.price
                    this.dimension = data.data.dimension
                    this.unit = data.data.unit
                    this.discount = data.data.discount
                    this.totalDiscount = (this.discount / 100) * this.price

                    this.product_code = data.data.product_code
                    this.product_name = data.data.product_name
                    this.newPrice = data.data.price - this.totalDiscount
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
