<template>
  <div class="content-wrapper">
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title" v-if="form.id">Update Product</h3>
                                    <h3 class="card-title" v-else>Create Product</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <el-form label-position="top" size="mini" label-width="120px" @submit.prevent="saveUpdateProduct" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-4">
                                            <el-form-item label="Product Name">
                                            <el-input v-model="form.name" placeholder="Product Name"></el-input>
                                            <span class="text-danger" v-if="errors['name']">
                                                {{errors['name'][0]}}
                                            </span>
                                            </el-form-item>
                                        </div>
                                        <div class="col-4">
                                            <el-form-item label="Category">
                                                <el-select v-model="form.category_id" placeholder="Select Category" class="w-100">

                                                <el-option v-for="category in categories" :key="category.id" :label="category.name" :value="category.id"></el-option>

                                                </el-select>
                                                <span class="text-danger" v-if="errors['category_id']">
                                                    {{errors['category_id'][0]}}
                                                </span>
                                            </el-form-item>
                                        </div>
                                        <div class="col-4">
                                            <el-form-item label="Price">
                                            <el-input v-model="form.price" placeholder="Price" type="number"></el-input>
                                            <span class="text-danger" v-if="errors['price']">
                                                {{errors['price'][0]}}
                                            </span>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <el-form-item label="Discount Price">
                                            <el-input v-model="form.discount_price" placeholder="Discount Price" type="number"></el-input>
                                            <span class="text-danger" v-if="errors['discount_price']">
                                                {{errors['discount_price'][0]}}
                                            </span>
                                            </el-form-item>
                                        </div>
                                        <div class="col-3">
                                            <el-form-item label="Quantity">
                                            <el-input v-model="form.quantity" placeholder="Quantity" type="number"></el-input>
                                            <span class="text-danger" v-if="errors['quantity']">
                                                {{errors['quantity'][0]}}
                                            </span>
                                            </el-form-item>
                                        </div>
                                        <div class="col-2">
                                            <el-form-item label="Image One">
                                            <input @change="handleImageOne" placeholder="Select Image" type="file" />
                                            <img :src="`/uploads/${product.imageOne}`" alt="" width="100px" height="100px" v-if="form.imageOne" />
                                            <span class="text-danger" v-if="errors['imageOne']">
                                                {{errors['imageOne'][0]}}
                                            </span>
                                            </el-form-item>
                                        </div>
                                        <div class="col-2">
                                            <el-form-item label="Image Two">
                                            <input @change="handleImageTwo" placeholder="Select Image" type="file" />
                                            <img :src="`/uploads/${product.imageTwo}`" alt="" width="100px" height="100px" v-if="form.imageTwo" />
                                            <span class="text-danger" v-if="errors['imageTwo']">
                                                {{errors['imageTwo'][0]}}
                                            </span>
                                            </el-form-item>
                                        </div>
                                        <div class="col-2">
                                            <el-form-item label="Image Three">
                                            <input @change="handleImageThree" placeholder="Select Image" type="file" />
                                            <img :src="`/uploads/${product.imageThree}`" alt="" width="100px" height="100px" v-if="form.imageThree" />
                                            <span class="text-danger" v-if="errors['imageThree']">
                                                {{errors['imageThree'][0]}}
                                            </span>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <el-form-item label="Flavor">
                                                <el-checkbox-group v-model="form.flavor">
                                                <el-checkbox v-for="flavor in options.options.flavor" :key="flavor.value" :label="flavor.value" name="type">
                                                    {{flavor.label}}
                                                </el-checkbox>
                                                </el-checkbox-group>
                                                <span class="text-danger" v-if="errors['flavor']">
                                                    {{errors['flavor'][0]}}
                                                </span>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <el-form-item label="Occassion">
                                                <el-checkbox-group v-model="form.occassion">
                                                <el-checkbox v-for="occassion in options.options.occassions" :key="occassion.value" :label="occassion.value" name="type">
                                                    {{occassion.label}}
                                                </el-checkbox>
                                                </el-checkbox-group>
                                                <span class="text-danger" v-if="errors['occassion']">
                                                    {{errors['occassion'][0]}}
                                                </span>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-8">
                                            <el-form-item label="Product Description">
                                                <el-input type="textarea" v-model="form.description" placeholder="Product Description"></el-input>
                                                <span class="text-danger" v-if="errors['description']">
                                                    {{errors['description'][0]}}
                                                </span>
                                            </el-form-item>
                                            <el-button v-if="form.id" @click.prevent="saveUpdateProduct" type="success" style="float:right" size="mini">
                                                Update Product
                                            </el-button>
                                            <el-button v-else @click.prevent="saveUpdateProduct" type="success" style="float:right" size="mini">
                                                Create Product
                                            </el-button>
                                        </div>
                                        <div class="col-2"></div>
                                    </div>
                                </el-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
import jsonOptions from '../../../common/helper/form'
export default {
    name: 'AddUpdateProduct',
    data(){
        return {
            options: jsonOptions,
            errors: {},
            form:{
                imageOne: '',
                imageTwo: '',
                imageThree: '',
                flavor: [],
                occassion: [],
                category_id: '',
                name: '',
                price: '',
                discount_price: '',
                description: '',
                quantity: ''
            }
        }
    },
    methods: {
        handleImageOne(e){
            // console.log(e.target.files[0])
            this.form.imageOne = e.target.files[0]
        },handleImageTwo(e){
            // console.log(e.target.files[0])
            this.form.imageTwo = e.target.files[0]
        },handleImageThree(e){
            // console.log(e.target.files[0])
            this.form.imageThree = e.target.files[0]
        },
        categoryList(){
            this.$store.dispatch('category/categoryListAll')
        },
        saveProduct(formData){
            axios.post('/admin/product', formData)
                .then(res=>{
                    this.$message({
                        message: 'Product created successfully',
                        type: 'success'
                    })
                    this.$router.push({name: 'ProductList'})
                })
                .catch(err=>{
                    this.errors = err.response.data.errors
                })

        },
        updateProduct(formData){
            axios.post(`/admin/product-update/${this.$route.params.productId}`,formData)
                .then(res=>{
                    console.log(res.data)
                    this.$message({
                        message: 'Product updated successfully',
                        type: 'success'
                    })
                    this.$router.push({name: 'ProductList'})
                })
                .catch(err=>{
                    this.errors = err.response.data.errors
                })
        },
        saveUpdateProduct(){
            let formData = new FormData()
            formData.append('category_id', this.form.category_id)
            formData.append('name', this.form.name)
            formData.append('price', this.form.price)
            formData.append('discount_price', this.form.discount_price)
            formData.append('description', this.form.description)
            formData.append('imageOne', this.form.imageOne)
            formData.append('imageTwo', this.form.imageTwo)
            formData.append('imageThree', this.form.imageThree)
            formData.append('flavor', this.form.flavor)
            formData.append('occassion', this.form.occassion)
            formData.append('quantity', this.form.quantity)
            if (this.product.id) {
                this.updateProduct(formData)
            }else{
                this.saveProduct(formData)
            }
        },
        editProductById(){
            this.$store.dispatch('product/editProduct', this.$route.params.productId)
        }
    },
    created(){
        this.categoryList()
        if (this.$route.params.productId) {
            this.editProductById()
        }
    },
    computed: {
        categories(){
            return this.$store.getters['category/categoryList']
        },
        product(){
            return this.$store.getters['product/singleProduct']
        }
    },
    watch: {
        product(){
            this.form = this.product
        }
    }
}
</script>

<style>

</style>
