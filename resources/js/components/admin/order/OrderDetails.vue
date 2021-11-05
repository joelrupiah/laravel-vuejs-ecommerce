<template>
  <div class="content-wrapper">
        <div class="content mt-5">
            <div class="container-fluid">
                <!-- Main content -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Product Details
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="timetable_sub">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="rem1" v-for="item in order.order_items" :key="item.id">
                                                <td class="invert">{{item.item_name}}</td>
                                                <td class="invert">{{item.item_quantity}}</td>
                                                <td class="invert">kshs{{item.item_quantity * item.item_price}}</td>
                                            </tr><hr>
                                            <tr class="rem1">
                                                <b class="text-danger mt-2 mb-2"><td class="invert" colspan="5">Order Total  kshs{{order.total}}</td></b>
                                            </tr><hr>
                                            <tr class="rem1">
                                                <b class="text-primary mt-2 mb-2"><td class="invert" colspan="5">Payment Type:  {{order.payment_type}}</td></b>
                                            </tr><hr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Customer Details
                            </div>
                            <div class="card-body">
                                <!-- <div class="table-responsive">
                                    <table class="timetable_sub">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="rem1">
                                                <td class="invert">{{shipping.name ? shipping.name : ''}}</td>
                                                <td class="invert">{{shipping.email ? shipping.email : ''}}</td>
                                                <td class="invert">{{shipping.phone ? shipping.phone : ''}}</td>
                                                <td class="invert">{{shipping.address ? shipping.address : ''}}</td>
                                            </tr><hr>
                                        </tbody>
                                    </table>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-5">Name</div>
                                    <div class="col-md-7">{{shipping.name ? shipping.name : ''}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">Email</div>
                                    <div class="col-md-7">{{shipping.email ? shipping.email : ''}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">Phone</div>
                                    <div class="col-md-7">{{shipping.phone ? shipping.phone : ''}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">Address</div>
                                    <div class="col-md-7">{{shipping.address ? shipping.address : ''}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'OrderDetails',

    methods: {
        getOrder(){
            this.$store.dispatch('order/order', this.$route.params.orderId)
        }
    },
    created(){
        // console.log(this.$route.params.orderId)
        this.getOrder()
    },
    computed: {
        order(){
            return this.$store.getters['order/order']
        },
        shipping(){
            return this.order.shipping_address ? JSON.parse(this.order.shipping_address) : ''
        }
    }
}
</script>

<style>

</style>