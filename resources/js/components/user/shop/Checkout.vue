<template>
    <div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Checkout
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
            <div class="row">
            <h4 class="text-center">Add a new Details</h4>
                <div class="col-md-6">
                    <div class="checkout-left">
                        <div class="address_form_agile">
                            <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
                                <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                                    <div class="information-wrapper">
                                        <div class="contact agileits">
                                            <div class="contact-agileinfo">
                                                <div class="contact-form wthree">
                                                    <form action="#" method="post" @submit.prevent="userRegister()">
                                                        <div class="">
                                                            <input readonly type="text" v-model="form.name" placeholder="Name">
                                                            <span class="text-danger mb-2" v-if="errors['name']">{{errors['name'][0]}}</span>
                                                        </div>
                                                        <div class="">
                                                            <input readonly class="email" v-model="form.email" type="email" placeholder="Email">
                                                            <span class="text-danger" v-if="errors['email']">{{errors['email'][0]}}</span>
                                                        </div>
                                                        <div class="">
                                                            <input readonly class="text" v-model="form.phone" type="text" placeholder="Phone Number">
                                                            <span class="text-danger" v-if="errors['phone']">{{errors['phone'][0]}}</span>
                                                        </div>
                                                        <div class="">
                                                            <input readonly class="text" v-model="form.address" type="text" placeholder="Address">
                                                            <span class="text-danger" v-if="errors['address']">{{errors['address'][0]}}</span>
                                                        </div>
                                                            Ship to different Address<input class="text" v-model="shippingDisplay" type="checkbox">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-6" v-if="shippingDisplay">
                    <div class="checkout-left">
                        <div class="address_form_agile">
                            <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
                                <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                                    <div class="information-wrapper">
                                        <div class="contact agileits">
                                            <div class="contact-agileinfo">
                                                <div class="contact-form wthree">
                                                    <form action="#" method="post" @submit.prevent="userRegister()">
                                                        <div class="">
                                                            <input type="text" v-model="shipping.name" placeholder="Name">
                                                            <span class="text-danger mb-2" v-if="errors['name']">{{errors['name'][0]}}</span>
                                                        </div>
                                                        <div class="">
                                                            <input class="email" v-model="shipping.email" type="email" placeholder="Email">
                                                            <span class="text-danger" v-if="errors['email']">{{errors['email'][0]}}</span>
                                                        </div>
                                                        <div class="">
                                                            <input class="text" v-model="shipping.phone" type="text" placeholder="Phone Number">
                                                            <span class="text-danger" v-if="errors['phone']">{{errors['phone'][0]}}</span>
                                                        </div>
                                                        <div class="">
                                                            <input class="text" v-model="shipping.address" type="text" placeholder="Address">
                                                            <span class="text-danger" v-if="errors['address']">{{errors['address'][0]}}</span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div><hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                                <table class="timetable_sub">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="rem1" v-for="product in products.products" :key="product.id">
                                            <td class="invert">{{product.name}} - {{product.quantity}}pieces</td>
                                            <td class="invert">${{product.price*product.quantity}}</td>
                                        </tr><hr>
                                        <tr class="rem1">
                                            <b class="text-danger mt-2 mb-2"><td class="invert" colspan="5">Order Total   ${{products.total}}</td></b>
                                        </tr><hr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                            <p>
                            <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Select Payment Option
                            </a>
                            </p><hr>
                            <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <select name="" id="" class="mt-2 text-center" v-model="payment_type">
                                    <option value="cash_on_delivery">Cash on Delivery</option>
                                    <option value="card_payment">Card Payment</option>
                                    <option value="mpesa">Moblie Payment</option>
                                </select><hr>
                                <div v-if="products.total > 0">
                                    <button class="btn btn-success btn-sm submit text-center mt-2" @click.prevent="placeOrder">Purchase</button>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
            </div>
		</div>
</template>

<script>
export default {
    name: 'Checkout',
    data(){
        return{
            shippingDisplay: false,
            errors: [],
            form: {
                
            },
            shipping: {
                
            },
            payment_type: 'cash_on_delivery',
            mobile_payment: 'mpesa',
            cardPayment: {
                cardNumber: '',
                cvc: '',
                expMonth: '',
                expYear: ''
            },
        }
    },
    methods: {
        getuser(){
            this.$store.dispatch('user/getUser')
        },
        productList(){
            this.$store.dispatch('cart/productList')
        },
        placeOrder(){
            // console.log(this.shipping, this.shippingDisplay)
            axios.post('checkout', {
                shipping: this.shipping,
                shipping_address: this.shippingDisplay,
                payment_type: this.payment_type,
                mobile_payment: this.mobile_payment,
                cardInfo: this.cardPayment
            })
                .then(res=>{
                    this.$message({
                        message: "Order Completed. Please Check your Dashboard",
                        type: "success"
                    })
                    this.$router.push({name : 'Shop'})
                })
                .catch(err=>{

                })
        },
        // cardPayment(){

        // },
    },
    created(){
        this.productList()
        this.getuser()
    },
    computed:{
        products(){
            return this.$store.getters['cart/productList']
        },
        user() {
        	return this.$store.getters['user/getAuthUser']
      	},
    },
    watch: {
        user: {
            handler: function(newVal, oldVal){
                this.form = newVal
            },
            deep: true
        }
    }
}
</script>

<style lang="scss">
.button {
  cursor: pointer;
  font-weight: 500;
  left: 3px;
  line-height: inherit;
  position: relative;
  text-decoration: none;
  text-align: center;
  border-style: solid;
  border-width: 1px;
  border-radius: 3px;
  -webkit-appearance: none;
  -moz-appearance: none;
  display: inline-block;
}

.button--small {
  padding: 10px 20px;
  font-size: 0.875rem;
}

.button--green {
  outline: none;
  background-color: #64d18a;
  border-color: #64d18a;
  color: white;
  transition: all 200ms ease;
}

.button--green:hover {
  background-color: #8bdda8;
  color: white;
}
</style>