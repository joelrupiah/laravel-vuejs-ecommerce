<template>
    <div>
        <!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.html">Home</a>
						<i>|</i>
					</li>
					<li>WishList</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
    <!-- checkout page -->
	<div class="privacy">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Wishlist
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>SL No.</th>
								<th>Product</th>
								<th>Quality</th>
								<th>Product Name</th>

								<th>Price</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>
							<tr class="rem1" v-for="(wishlist, index) in wishlists.data" :key="wishlist.id">
								<td class="invert">{{index+1}}</td>
								<td class="invert-image">
									<a href="single2.html">
										<img :src="`/uploads/${wishlist.product.image}`" alt="" class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<div class="quantity">
										<div class="quantity-select">
											<div class="entry value-minus">&nbsp;</div>
											<div class="entry value">
												<span>1</span>
											</div>
											<div class="entry value-plus active">&nbsp;</div>
										</div>
									</div>
								</td>
								<td class="invert">{{wishlist.product.name}} <br>
									<p class="text-danger">Flavor: 
									<span class="text-danger" v-for="flavor in wishlist.product.flavor" :key="flavor">{{flavor +','}}</span>
									</p> <br>
									<p class="text-danger">Occassion:
									<span class="text-danger" v-for="occassion in wishlist.product.occassion" :key="occassion">{{occassion}},</span>
									</p> <br>
								</td>
								<td class="invert">{{wishlist.product.price}}</td>
								<td class="invert">
									<div class="rem">
										<div class="close1" @click.prevent="removeToWishlist(wishlist.id)"> </div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- //checkout page -->
    </div>
</template>

<script>
export default {
    name: 'WishList',
    data(){
        return {
            currentPage: 1
        }
    },
    methods: {
        wishList(){
            this.$store.dispatch('wishlist/wishList', this.currentPage)
        },
		removeToWishlist(id){
			// console.log(id)
			this.$store.dispatch('wishlist/deleteWishlist', id)
				.then(res=>{
					this.$message({
						message: "Product removed from wishlist",
						type: "success"
					})
				})
		}
    },
    created(){
        this.wishList()
    },
    computed: {
        wishlists(){
            return this.$store.getters['wishlist/wishList']
        }
    }
}
</script>

<style>

</style>