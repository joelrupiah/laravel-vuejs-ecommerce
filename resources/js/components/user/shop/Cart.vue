<template>
    <div class="container-fluid">
		<h3 class="tittle-w3l">Cart
			<span class="heading-style">
				<i></i>
				<i></i>
				<i></i>
			</span>
		</h3>
        <div class="container">
        <div class="checkout-right">
			<h3 class="text-danger">Your shopping cart contains:
				<span>{{products.total_products}} Products</span>
			</h3>
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
						</tbody>
					</table>
					<router-link :to="{name: 'Checkout'}"><button class="btn btn-success btn-sm">Checkout</button></router-link>
				</div>
		</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Cart',
	data(){
		return{
			currentPage: 1,
			product: {
				quantity: 1
			}
		}
	},
	methods: {
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
	created(){
		this.productList()
	},
	computed:{
		products(){
			return this.$store.getters['cart/productList']
		}
	}
}
</script>

<style>

</style>