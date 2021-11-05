<template>
    <div>
    <!-- top-header -->
	<div class="header-most-top">
		<p>RoyalPorters</p>
	</div>
	<!-- //top-header -->
	<!-- header-bot-->
	<div class="header-bot">
		<div class="header-bot_inner_wthreeinfo_header_mid">
			<!-- header-bot-->
			<div class="col-md-4 logo_agile">
				<h1>
					<a href="index.html">
						<span>R</span>oyal
						<span>P</span>orters
						<img src="/image/royalporters.jpg" alt="product.name" style="height:50px;width:50px">
					</a>
				</h1>
			</div>
			<!-- header-bot -->
			<div class="col-md-8 header">
				<!-- header lists -->
				<ul>
					<template v-if="user && user.id">
					<li>
						<router-link :to="{name: 'UserDashboard'}">
							<span class="fa fa-user" aria-hidden="true"></span>My Account</router-link>
					</li>
					<li>
						<router-link :to="{name: 'WishList'}">
							<span class="fa fa-user" aria-hidden="true"></span>Wishlist</router-link>
					</li>
					<li>
						<a @click.prevent="userLogout()">
							<span class="fa fa-sign-out" aria-hidden="true"></span>Logout</a>
					</li>
					<li>
						<router-link :to="{name: 'Cart'}">
							<span class="fa fa-shopping-cart" aria-hidden="true"></span> Cart </router-link>
					</li>
					<li>
						<router-link :to="{name: 'Checkout'}">
							<span class="fa fa-shopping-cart" aria-hidden="true"></span> Checkout </router-link>
					</li>
					</template>
					<template v-else>
					<li>
						<router-link :to="{name: 'UserLogin'}">
							<span class="fa fa-unlock-alt" aria-hidden="true"></span> Sign In </router-link>
					</li>
					<li>
						<router-link :to="{name: 'UserRegister'}">
							<span class="fa fa-pencil-square-o" aria-hidden="true"></span> Sign Up </router-link>
					</li>
					<li>
						<router-link :to="{name: 'Cart'}">
							<span class="fa fa-shopping-cart" aria-hidden="true"></span> Cart </router-link>
					</li>
					</template>
				</ul>
				<!-- //header lists -->
				<!-- search -->
				<div class="agileits_search">
					<form action="#" method="post">
						<input name="Search" type="search" placeholder="How can we help you today?" required="">
						<button type="submit" class="btn btn-default" aria-label="Left Align">
							<span class="fa fa-search" aria-hidden="true"> </span>
						</button>
					</form>
				</div>
				<!-- //search -->
				<!-- cart details -->
				<div class="top_nav_right">
					<div class="wthreecartaits wthreecartaits2 cart cart box_1">
							<button class="w3view-cart" type="submit" name="submit" data-toggle="modal" data-target="#cartproductModal">
								<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							</button>
					</div>
				</div>
				<!-- //cart details -->


				<!-- cart product modal -->
			<div class="modal fade" id="cartproductModal" tabindex="-1" role="dialog">
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
							<div class="table-responsive">
								<table class="timetable_sub">
									<thead>
										<tr>
											<th>SL No.</th>
											<th>Product</th>
											<th>Quantity</th>
											<th>Product Name</th>

											<th>Price</th>
											<th>Remove</th>
										</tr>
									</thead>
									<tbody>
										<tr class="rem1" v-for="(product, index) in products.products" :key="product.id">
											<td class="invert">{{index+1}}</td>
											<td class="invert-image">
												<a href="single2.html">
													<img :src="`/uploads/${product.attributes['image']}`" alt=" " class="img-responsive">
												</a>
											</td>
											<td class="invert">
												<div class="quantity">
													<div class="quantity-select">
														<input type="text" @keypress.enter.prevent="updateQty(product.id, product.quantity)" v-model="product.quantity" />
														<button class="btn btn-success btn-sm" @click.prevent="updateQty(product.id, product.quantity)">Update</button>
													</div>
												</div>
											</td>
											<td class="invert">{{product.name}}</td>
											<td class="invert">${{product.price*product.quantity}}</td>
											
											<td class="invert">
												<div class="rem">
													<div class="close1" @click.prevent="removeProduct(product.id)"> </div>
												</div>
											</td>
										
										</tr>
										<tr class="rem1">
											<td class="invert" colspan="5">${{products.total}}</td>
										</tr>
										<router-link :to="{name: 'Cart'}"><input type="submit" name="submit" value="Go To Cart" class="btn btn-warning" /></router-link><br>
										<router-link :to="{name: 'Checkout'}"><input type="submit" name="submit" value="Checkout" class="btn btn-success" /></router-link><hr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- //Modal content-->
				</div>
			</div>
			<!-- //cart product modal -->


				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //header-bot -->
	<!-- navigation -->
	<div class="ban-top">
		<div class="container">
			<div class="agileits-navi_search">
				<!-- <form action="#" method="post">
					<select id="agileinfo-nav_search" name="agileinfo_search" required="">
						<option value="">All Categories</option>
						<span @click.prevent="">
							<option v-for="category in maincategoryInfo.categories" :key="category.id">{{category.name}}</option>
						</span>
					</select>
				</form> -->
			</div>
			<div class="top_nav_left">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
							    aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav menu__list">
								<li class="active">
									<router-link class="nav-stylehead" :to="{name: 'Home'}">Home
										<span class="sr-only">(current)</span>
									</router-link>
								</li>
								<li class="">
									<router-link class="nav-stylehead" :to="{name: 'About'}">About Us</router-link>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle nav-stylehead" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu multi-column columns-3">
										<div class="agile_inner_drop_nav_info">
											<div class="col-sm-4 multi-gd-img">
												<ul class="multi-column-dropdown">
													<li v-for="category in maincategoryInfo.categories" :key="category.id">
														<a @click.prevent="productFilter(category.id, 'category_id')">{{category.name}}</a>
													</li>
												</ul>
											</div>
											<div class="clearfix"></div>
										</div>
									</ul>
								</li>
								<li class="">
									<router-link class="nav-stylehead" :to="{name: 'Shop'}">Shop</router-link>
								</li>
								<li class="">
									<router-link class="nav-stylehead" :to="{name: 'Contact'}">Contact</router-link>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<!-- //navigation -->
    </div>
</template>

<script>
export default {
    name: 'UserHeader',
	data(){
		return {
			form: {
				data: '',
				field: ''
			},
			currentPage: 1,
			product: {
				quantity: 1
			}
		}
	},
    methods : {
      getUser() {
        this.$store.dispatch('user/getUser')
      },
	  userLogout() {
		  this.$store.dispatch('user/userLogout')
		  localStorage.removeItem('userLoggedIn')
		  this.$router.push({name: 'Home'})
		  this.$message({
          showClose: true,
          message: 'Logged Out Successfully'
        });
	  },
	  productCategoryInfo(){
		  this.$store.dispatch('product/productCategoryInfo')
	  },
	  productFilter(data, field){
		//   alert(data)
		this.form.data = data
		this.form.field = field
		this.$store.dispatch('product/productFilter', JSON.stringify(this.form))
	  },
	  productList(){
		this.$store.dispatch('cart/productList')
	  },
	  removeProduct(id){
		// console.log(id)
		axios.get('cart/remove-product/'+id)
			.then(res=>{
				this.productList()
			})
			.catch(err=>{

			})
		},
		updateQty(id, qty){
			// console.log(id, qty)
			axios.post(`cart/update-cart`, {id: id, qty: qty})
				.then(res=>{
					this.productList()
				})
		}
    },
    created() {
      this.getUser();
	  this.productCategoryInfo()
	  this.productList()
    },
	computed: {
		user() {
        	return this.$store.getters['user/getAuthUser']
      	},
		maincategoryInfo(){
			return this.$store.getters['product/productCategoryInfo']
		},
		products(){
			return this.$store.getters['cart/productList']
		}
	}
}
</script>

<style scoped>

</style>