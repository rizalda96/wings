<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-4">
                    <b-card class="mb-2" v-for="(product) in products" :key="product.product_code">
                        <b-row>
                            <b-col sm="3">
                                <b-img :src='`https://picsum.photos/300/150/?image=${product.index}`' rounded fluid></b-img>
                            </b-col>
                            <b-col>
                                <b-row class="d-flex">
                                    <div class="mr-auto">
                                        <div>
                                            <router-link
                                                :to="{ name: 'product-detail', params: {
                                                    code: product.product_code,
                                                    index: product.index
                                                }}"
                                            >
                                                {{ product.product_name }}
                                            </router-link>

                                        </div>
                                        <template v-if="product.discount != 0">
                                            <s>{{ product.price }}</s>
                                        </template>
                                        <template v-else>
                                            <div>{{ product.price }}</div>
                                        </template>

                                        <div v-if="product.discount != 0">{{ product.newPrice }}</div>
                                    </div>
                                    <div class="mr-5">
                                        <b-button variant="primary" pill @click="addToCart(product)">Buy</b-button>
                                    </div>
                                </b-row>
                            </b-col>
                        </b-row>
                    </b-card>
                    <div class="d-flex justify-content-center">
                        <!-- :to="{ name: 'cart' }" -->
                        <b-button
                            @click="checkout"
                            variant="primary"
                            pill
                            class="pl-5 pr-5"
                        >Checkout ( {{ totalItems }} )</b-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CryptoJS from 'crypto-js';

    export default {
        name: 'product-list',
        data() {
            return {
                products: [],
                cartItems: [],
                isDiscount: false,
            }
        },
        computed: {
            totalItems(){
                return this.cartItems.reduce((accumulator , item) => {
                    return accumulator  + item.qty;
                }, 0);
            }
        },
        async created() {
            await this.fetchData()
        },
        methods: {
            async fetchData() {
                try {
                    let { data } = await this.$http.get(
                        this.$app.route('product.get')
                    )
                    this.products = _.map(data.data, (el, index) => {
                        let price = el.price
                        let discount = el.discount
                        let totalDiscount = (discount / 100) * price
                        return {
                            index: index,
                            product_code: el.product_code,
                            product_name: el.product_name,
                            price: el.price,
                            discount: el.discount,
                            totalDiscount: totalDiscount,
                            newPrice: el.price - totalDiscount,
                            qty: 1,
                        }
                    })
                    } catch (error) {
                        console.log(error);
                    }
            },
            discount(item) {
                let price = item.price
                let discount = item.discount
                let totalDiscount = (discount / 100) * price
                if (totalDiscount != 0) {
                    this.isDiscount = true
                }
                return price - totalDiscount
            },
            addToCart(itemToAdd) {
                // let found = false;

                // Add the item or increase qty
                let itemInCart = this.cartItems.filter(item => item.product_code === itemToAdd.product_code);
                let isItemInCart = itemInCart.length > 0;

                if (isItemInCart === false) {
                    this.cartItems.push(itemToAdd);
                } else {
                    itemInCart[0].qty += itemToAdd.qty;
                }
                // itemToAdd.qty = 1;
                // console.log(itemInCart);

            },
            checkout() {
                let enc = this.encrypt(JSON.stringify(this.cartItems))
                let dec = this.decrypt(enc)

                if (this.cartItems.length > 0) {
                    this.$router.push({name: 'cart', params: { slug: enc }})
                }
            },
            encrypt (src) {
                const passphrase = '123456'
                return CryptoJS.AES.encrypt(src, passphrase).toString()
            },

            decrypt (src) {
                const passphrase = '123456'
                const bytes = CryptoJS.AES.decrypt(src, passphrase)
                const originalText = bytes.toString(CryptoJS.enc.Utf8)
                return originalText
            }
        }
    }
</script>
