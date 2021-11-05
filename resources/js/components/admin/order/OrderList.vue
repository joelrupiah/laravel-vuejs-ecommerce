<template>
    <div class="content-wrapper">
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                <h3 class="card-title">Orders List</h3>
                                <a href="javascript:void(0);">
                                    <!-- <el-button type="success">Add New   
                                      <i class="el-icon-plus el-icon-right"></i></el-button> -->
                                </a>
                                </div>
                                    <!-- <el-button v-if="multipleSelection.length>0" @click="multipleDelete" type="danger" size="small">Bulk Delete   
                                      <i class="el-icon-delete el-icon-right"></i></el-button> -->
                            </div>
                            <el-table
                                ref="multipleTable"
                                :data="orders.data"
                                style="width: 100%"
                                @selection-change="handleSelectionChange">

                                <el-table-column
                                type="selection"
                                width="55">
                                </el-table-column>

                                <el-table-column
                                property="payment_type"
                                label="Payment Type"
                                width="250">
                                </el-table-column>

                                <el-table-column
                                property="total"
                                label="Total"
                                width="250">
                                </el-table-column>

                                <el-table-column
                                property="status"
                                label="Status"
                                width="250">
                                </el-table-column>

                                <el-table-column
                                label="Date"
                                width="200">
                                <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                </el-table-column>

                                <el-table-column
                                label="Actions" fixed="right">
                                  <template slot-scope="scope">
                                    <el-button @click.prevent="orderDetails(scope.row.id)" type="primary" icon="el-icon-view" size="mini"></el-button>
                                    <el-button type="warning" icon="el-icon-edit-outline" size="mini"></el-button>
                                    <el-button type="danger" icon="el-icon-delete-solid" size="mini"></el-button>
                                  </template>
                                </el-table-column>
                            </el-table>
                            <el-pagination
                            class="text-center mt-2 mb-2"
                            background
                            @current-change="handleCurrentChange"
                            :current-page.sync="currentPage"
                            :page-size="orders.per_page"
                            layout="prev, pager, next"
                            :total="orders.total">
                            </el-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'OrderList',
    data() {
      return {
        currentPage: 1,
        multipleSelection: [],
        categoryDialog: false,
      }
    },

    methods: {
      orderDetails(id){
        // console.log(id)
        this.$router.push({name: 'OrderDetails', params:{orderId: id}})
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
      orderList(){
        this.$store.dispatch('order/orderList', this.currentPage)
      },
      handleCurrentChange(){
          this.$store.dispatch('user/orderList', this.currentPage)
      },
    },
    created(){
      this.orderList()
    },
    computed: {
        orders(){
            return this.$store.getters['order/orderList']
        }
     }
}
</script>

<style>

</style>