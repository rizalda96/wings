<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="mt-8">
                    <b-card class="mb-2">
                        <b-row v-for="item in items" :key="item.product_code">
                            <b-col sm="3">
                                <b-img :src='`https://picsum.photos/300/150/?image=${item.index}`' rounded fluid></b-img>
                            </b-col>
                            <b-col>
                                <b-row class="d-flex">
                                    <div class="mr-auto">
                                        <div>
                                            {{ item.product_name }}
                                        </div>
                                        <div>
                                            {{ item.qty }} PCS
                                        </div>
                                        <template v-if="item.discount != 0">
                                            <s>Rp. {{ item.price }}</s>
                                        </template>
                                        <template v-else>
                                            <div>Rp. {{ item.price }}</div>
                                        </template>

                                        <div v-if="item.discount != 0">Rp. {{ item.newPrice }}</div>
                                    </div>
                                </b-row>
                            </b-col>
                        </b-row>

                        <div class="d-flex justify-content-center mt-4">
                            <h4>Total: {{ Total }}</h4>
                        </div>
                        <div class="d-flex justify-content-center">
                            <b-button variant="primary" pill class="pl-5 pr-5">Confirm</b-button>
                        </div>
                    </b-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CryptoJS from 'crypto-js';
    export default {
        name: 'cart-detail',
        data() {
            return {
                items: []
            }
        },
        computed: {
            Total() {
                let total = 0;
                this.items.forEach(item => {
                    total += (item.price * item.qty);
                });
                return total;
            }
        },
        async created() {
            let src = this.$route.params.slug
            let item = await this.decrypt(src)
            this.items = JSON.parse(item)
        },
        methods: {
            async decrypt (src) {
                const passphrase = '123456'
                const bytes = CryptoJS.AES.decrypt(src, passphrase)
                const originalText = bytes.toString(CryptoJS.enc.Utf8)
                return originalText
            }
        }
    }
</script>
