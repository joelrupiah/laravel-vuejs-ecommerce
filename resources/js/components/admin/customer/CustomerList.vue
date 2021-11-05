<template>
    <div class="content-wrapper">
        <div class="content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                <h3 class="card-title">Category List</h3>
                                <a href="javascript:void(0);">
                                    <el-button type="success">Add New   
                                      <i class="el-icon-plus el-icon-right"></i></el-button>
                                </a>
                                </div>
                                    <el-button v-if="multipleSelection.length>0" @click="multipleDelete" type="danger" size="small">Bulk Delete   
                                      <i class="el-icon-delete el-icon-right"></i></el-button>
                            </div>
                            <el-table
                                ref="multipleTable"
                                :data="users.data"
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
                                property="email"
                                label="Email"
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
                                    <el-button type="primary" icon="el-icon-view" size="mini"></el-button>
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
                            :page-size="users.per_page"
                            layout="prev, pager, next"
                            :total="users.total">
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
    name: 'CustomerList',
    data() {
      return {
        currentPage: 1,
        multipleSelection: [],
        categoryDialog: false,
      }
    },

    methods: {
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
      customerList(){
        this.$store.dispatch('user/userList', this.currentPage)
      },
      handleCurrentChange(){
          this.$store.dispatch('/user/userList', this.currentPage)
      },
      clearData(){
        this.errors = {}
        this.form = {}
      }
    },
    created(){
      this.customerList()
    },
    computed: {
        users(){
            return this.$store.getters['user/userList']
        }
     }
}
</script>

<style>

</style>