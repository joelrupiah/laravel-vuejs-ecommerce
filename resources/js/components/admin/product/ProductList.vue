<template>
    <div class="content-wrapper">
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                <h3 class="card-title">Product List</h3>
                                <router-link :to="{name: 'AddUpdateProduct'}">
                                    <el-button type="success">Add New
                                      <i class="el-icon-plus el-icon-right"></i></el-button>
                                </router-link>
                                </div>
                                    <el-button v-if="multipleSelection.length>0" @click="multipleDelete" type="danger" size="small">Bulk Delete
                                      <i class="el-icon-delete el-icon-right"></i></el-button>
                            </div>
                            <el-table
                                ref="multipleTable"
                                :data="products.data"
                                style="width: 100%"
                                @selection-change="handleSelectionChange">

                                <el-table-column
                                type="selection"
                                width="55">
                                </el-table-column>

                                <el-table-column
                                property="name"
                                label="Name"
                                width="250">
                                </el-table-column>

                                <el-table-column
                                property="category_id"
                                label="Category"
                                width="100">
                                <template slot-scope="scope">{{ scope.row.category.name }}</template>
                                </el-table-column>

                                <el-table-column
                                property="price"
                                label="Price"
                                width="100">
                                </el-table-column>

                                <el-table-column
                                property="quantity"
                                label="Quantity"
                                width="100">
                                </el-table-column>

                                <el-table-column
                                label="Date"
                                width="200">
                                <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                </el-table-column>

                                <el-table-column
                                label="Actions" fixed="right">
                                  <template slot-scope="scope">
                                    <el-button  @click.prevent="productDetails(scope.row)" type="primary" icon="el-icon-view" size="mini"></el-button>
                                    <router-link :to="{name: 'editProduct', params: { productId: scope.row.id }}">
                                    <el-button type="warning" icon="el-icon-edit-outline" size="mini"></el-button>
                                    </router-link>
                                    <el-button @click="deleteProduct(scope.row.id)" type="danger" icon="el-icon-delete-solid" size="mini"></el-button>
                                  </template>
                                </el-table-column>
                            </el-table>
                            <el-pagination
                            class="text-center mt-2 mb-2"
                            background
                            @current-change="handleCurrentChange"
                            :current-page.sync="currentPage"
                            :page-size="products.per_page"
                            layout="prev, pager, next"
                            :total="products.total">
                            </el-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- product details -->
        <el-dialog
        :title="product.name+ '   Details'"
        :visible.sync="centerDialogVisible"
        width="30%"
        center>
        <span>
            <h5 v-if="product.category">Category Name: {{product.category.name}}</h5>
            <p v-if="product.name">Product Name: {{product.name}}</p>
            <p>Description: {{product.description}}</p>
            <b>Price: {{product.price}}</b> <br>
            <b>Discount Price: {{product.discount_price}}</b> <br>
            <b>Qty: {{product.quantity}}</b> <br>
            Image: <img  :src="`/uploads/${product.image}`" width="100px" height="100px"/> <br>
            Flavor/s: <b v-for="(flavor,index) in product.flavor" :key="index">
            {{flavor}},
            </b> <br>
            Occassion/s: <b v-for="(occassion,index) in product.occassion" :key="occassion">
            {{occassion}} ,
            </b>
        </span>
        </el-dialog>
        <!-- product details -->
    </div>
</template>

<script>
export default {
    name: 'ProductList',
    data(){
        return {
            centerDialogVisible: false,
            product: {},
            currentPage: 1,
            multipleSelection: []
        }
    },
    methods: {
        productDetails(row){
            this.product = row
            this.centerDialogVisible = true
        },
        productList(){
            this.$store.dispatch('product/productList', this.currentPage)
        },
        handleCurrentChange(){
            this.$store.dispatch('product/productList', this.currentPage)
            // console.log(this.currentPage)
        },
        toggleSelection(rows) {
            if (rows) {
            rows.forEach(row => {
                this.$refs.multipleTable.toggleRowSelection(row);
            });
            } else {
            this.$refs.multipleTable.clearSelection();
            }
        },
        handleSelectionChange(val) {
            this.multipleSelection = val;
        },
        deleteProduct(id){
            this.$store.dispatch('product/deleteProduct' ,id)
            this.productList()
            this.$message({
            message: 'Product deleted successfully',
            type: 'success'
            })
        },
        multipleDelete(){
            // console.log(this.multipleSelection)
            axios.post('/admin/multiple-product-delete', this.multipleSelection)
            .then(res=>{
                this.$message({
                message: 'Products deleted successfully',
                type: 'success'
                })
                this.productList()
            })
        },
    },
    created(){
        this.productList()
    },
    computed: {
        products(){
            return this.$store.getters['product/productList']
        }
    }
}
</script>

<style>

</style>
