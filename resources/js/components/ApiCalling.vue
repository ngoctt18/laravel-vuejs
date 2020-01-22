<template>
    <div class="api-calling">
        <div class="error" v-if="errors.length">
            <span v-for="err in errors">
                {{ err }}
            </span>
            <hr>
        </div>
        <div class="create-form">
            <div class="product-name-input form-group">
                <input class="form-control" type="text" v-model="product.name">
            </div>
            <div class="product-name-input form-group">
                <input class="form-control" type="text" v-model.number="product.price">
            </div>
            <div class="button-create form-group">
                <button class="btn btn-primary" @click="createProduct">Create</button>
            </div>
        </div>
        <hr>
        <div class="list-products">
            <h2>LIST PRODUCT</h2>
            <div class="product-table">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Date created</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(prod, index) in list_products" :key="prod.id">
                        <td>{{ prod.id }}</td>
                        <td v-if="!prod.isEdit">
                            {{ prod.name }}
                        </td>
                        <td v-else>
                            <input type="text" class="form-control" v-model="selectedProduct.name">
                        </td>
                        <td v-if="!prod.isEdit">
                            {{ prod.price }}
                        </td>
                        <td v-else>
                            <input type="text" class="form-control" v-model.number="selectedProduct.price">
                        </td>
                        <td>{{ prod.created_at }}</td>
                        <td v-if="!prod.isEdit">
                            <button class="btn btn-success" @click="selecteProduct(prod)">Edit</button>
                            <button class="btn btn-danger" @click="deleteProduct(prod, index)">Delete</button>
                        </td>
                        <td v-else>
                            <button class="btn btn-primary" @click="updateProduct(index)">Save</button>
                            <button class="btn btn-danger" @click="prod.isEdit = false">Cancel</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {
                    name: '',
                    price: 0
                },
                selectedProduct: {},
                list_products: [],
                errors: [],
            }
        },
        created() {
            this.getListProducts()
        },
        methods: {
            createProduct() {
                this.errors = []
                axios.post('/products', {name: this.product.name, price: this.product.price})
                    .then(response => {
                        this.list_products.push({...response.data.product, isEdit: false})
                        this.product.name = '';
                        this.product.price = 0;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name
                    })
            },
            getListProducts() {
                axios.get('/products')
                    .then(response => {
                        this.list_products = response.data
                        this.list_products.forEach(item => {
                            Vue.set(item, 'isEdit', false)
                        })
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name
                    })
            },
            selecteProduct(product) {
                this.selectedProduct = {...product}
                product.isEdit = true
            },
            updateProduct(index) {
                axios.put('/products/' + this.selectedProduct.id, {
                    name: this.selectedProduct.name,
                    price: this.selectedProduct.price
                })
                    .then(response => {
                        this.list_products[index].name = this.selectedProduct.name
                        this.list_products[index].price = this.selectedProduct.price
                        this.list_products[index].isEdit = false
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name
                    })
            },
            deleteProduct(product, index) {
                axios.delete('/products/' + product.id)
                    .then(response => {
                        console.log(response.data.result)
                        this.list_products.splice(index, 1)
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors.name
                    })
            }
        }
    }

    // setInterval(function () {
    //     $('.questionDropdownContainer span[data-index="1"]').click();
    //     $('.surveyDashboardCTA').click();
    // }, 7000);
    //
    // setInterval(function () {
    //     let list = document.getElementsByClassName('section-place-with-edits-selected')[0].getElementsByClassName('section-verify-edit-not-sure');
    //     for (let i = 0; i < list.length; i++) {
    //         list[i].click();
    //         console.log('click');
    //     }
    // }, 5000);
    // setInterval(function () {
    //     let scroll = document.getElementsByClassName('section-scrollbox')[0];
    //     scroll.scrollTop = scroll.scrollHeight / 2;
    //     console.log('scroll');
    // }, 25000);


</script>

<style lang="scss" scoped>
    .error {
        span {
            color: red;
        }
    }
</style>
