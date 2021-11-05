<template>
    <div>
        	<!-- top Products -->
	<div class="ads-grid">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">SHOP
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->

			<!-- product sidebar -->
            <product-sidebar></product-sidebar>
            <!-- product sidebar -->

			<!-- product right -->
			<div class="agileinfo-ads-display col-md-9">
				<div class="wrapper">
					<!-- first section (nuts) -->
					<div class="product-sec1">
						<h3 class="heading-tittle">All Products</h3>

						<div class="col-md-4 product-men" v-for="product in products.data" :key="product.id">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img :src="`/uploads/${product.imageOne}`" :alt="product.name">
									<div class="men-cart-pro">
										<div class="inner-men-cart-pro">
											<a href="#" @click="singleProductView(product)" class="link-product-add-cart" data-toggle="modal" data-target="#singleproductModal">Quick View</a>
										</div>
									</div>
									<span class="product-new-top">New</span>
								</div>
								<div class="item-info-product ">
									<h4>
										<a href="single.html">{{product.name}}</a>
									</h4>
									<div class="info-product-price">
										<span class="item_price">{{currency}} {{product.price}}</span>
										<del>{{currency}} {{product.discount_price}}</del>
									</div>
									<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
										<form action="#" method="post">
											<fieldset>
												<input type="hidden" name="cmd" value="_cart" />
												<input type="hidden" name="add" value="1" />
												<input type="hidden" name="business" value=" " />
												<input type="hidden" name="item_name" value="Almonds, 100g" />
												<input type="hidden" name="amount" value="149.00" />
												<input type="hidden" name="discount_amount" value="1.00" />
												<input type="hidden" name="currency_code" value="USD" />
												<input type="hidden" name="return" value=" " />
												<input type="hidden" name="cancel_return" value=" " />
												<input type="submit" @click.prevent="addToWishlist(product)" name="submit" value="Add to wishlist" class="btn btn-warning" /><br>
												<input type="submit" @click.prevent="addToCart(product)" name="submit" value="Add to cart" class="btn btn-success" /><hr>
											</fieldset>
										</form>
									</div>

								</div>
							</div>
						</div>
							
						<div class="clearfix mb-5"></div>
							<el-pagination
								class="text-center mt-5 mb-2"
								background
								@current-change="handleCurrentChange"
								:current-page.sync="currentPage"
								:page-size="products.per_page"
								layout="prev, pager, next"
								:total="products.total">
							</el-pagination>
					</div>
					<!-- //first section (nuts) -->
				</div>
			</div>
			<!-- //product right -->

			<!-- single product modal -->
			<div class="modal fade" id="singleproductModal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body modal-body-sub_agile">
							<div class="main-mailposi">
								<span class="fa fa-product-hunt" aria-hidden="true"></span>
							</div>
							<div class="modal_body_left modal_body_left1">
								<h3 class="agileinfo_sign">{{product.name}}</h3><hr>
								
								<div class="row">
									<div class="col-md-12">
										<h5>{{product.name}} Description</h5>
										{{product.description}}
									</div><hr>
								</div>
								<div class="row" v-if="product.discount_price">
									<div class="col-md-4">
										<h6>{{product.name}} Price</h6>
										{{product.price}}
									</div><hr>
									<div class="col-md-4">
										<h6>{{product.name}} Discount Price</h6>
										{{product.discount_price}}
									</div>
									<div class="col-md-4">
										<div class="quantity">
										<div class="quantity-select">
											<div class="entry value-minus">&nbsp;</div>
											<div class="entry value">
												<span>1</span>
											</div>
											<div class="entry value-plus active">&nbsp;</div>
										</div>
									</div>
									</div>
								</div>
								<div class="row" v-else>
									<div class="col-md-6">
										<h6>{{product.name}} Price</h6>
										{{product.price}}
									</div>
									<div class="col-md-6">
										<div class="quantity">
										<div class="quantity-select">
											<div class="entry value-minus">&nbsp;</div>
											<div class="entry value">
												<span>1</span>
											</div>
											<div class="entry value-plus active">&nbsp;</div>
										</div>
									</div>
									</div><hr>
								</div>
								<div class="row mt-5">
									<div class="col-md-4">
										<img :src="`/uploads/${product.imageOne}`" :alt="product.name">
									</div>
									<div class="col-md-4">
										<img :src="`/uploads/${product.imageTwo}`" :alt="product.name">
									</div>
									<div class="col-md-4">
										<img :src="`/uploads/${product.imageThree}`" :alt="product.name">
									</div>
								</div>
								<div class="row mt-5">
									<div class="col-md-4"></div>
									<div class="col-md-2">
										<button @click.prevent="addToCart(product)" class="btn btn-success btn-sm">Add to Cart</button>
									</div>
									<div class="col-md-2">
										<button @click.prevent="addToWishlist(product)" class="btn btn-warning btn-sm">Add to Wishlist</button>
									</div>
									<div class="col-md-4"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- //Modal content-->
				</div>
			</div>
			<!-- //single product modal -->
		</div>
	</div>
	<!-- //top products -->
    </div>
</template>

<script>
import ProductSidebar from './ProductSidebar'
export default {
    name: 'Shop',
    components:{
        ProductSidebar
    },
    data(){
        return{
			currency: process.env.MIX_APP_CURRENCY,
            currentPage: 1,
			product: {},
			wishlist: {
				user_id: '',
				product_id: ''
			}
        }
    },
    methods:{
		cartProductList(){
			this.$store.dispatch('cart/productList')
		},
        productList(){
            this.$store.dispatch('product/getAllProduct', this.currentPage)
        },
        handleCurrentChange(){
            this.$store.dispatch('product/getAllProduct', this.currentPage)
            // console.log(this.currentPage)
        },
		addToCart(product){
			// console.log(product)
			// alert ("Cart")
			axios.post('/cart/add-to-cart', product)
				.then(res=>{
					this.$message({
						message: 'Product added to cart',
						type: 'success'
					})
					this.cartProductList()
				})
				.catch(err=>{

				})
		},
		addToWishlist(product){
			// console.log(product)
			// alert ("Wishlist")
			if (this.user) {
				// console.log(product)
				this.wishlist.user_id = this.user.id
				this.wishlist.product_id = product.id
				axios.post('/user/wishlist', this.wishlist)
					.then(res=>{
						this.$message({
							message: 'Product added to wishlist',
							type: 'success'
						})
					})
			}else{
				this.$router.push({name: 'UserLogin'})
				this.$message({
					message: 'Please login to add products to cart',
					type: 'warning'
				})
			}
		},
		singleProductView(product){
			this.product = product
		},
    },
    created(){
        this.productList()
		this.cartProductList()
    },
    computed: {
        products(){
            return this.$store.getters['product/productList']
        },
		user(){
            return this.$store.getters['user/getAuthUser']
        }
    }
}
</script>

<style>

</style>