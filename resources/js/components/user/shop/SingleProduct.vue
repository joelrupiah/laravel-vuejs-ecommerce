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
									<img :src="`/uploads/${product.image}`" :alt="product.name">
									<div class="men-cart-pro">
										<div class="inner-men-cart-pro">
											<a href="single.html" class="link-product-add-cart">Quick View</a>
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
												<input type="submit" name="submit" value="Add to cart" class="button" />
											</fieldset>
										</form>
									</div>

								</div>
							</div>
						</div>

						<div class="clearfix"></div>
						
					</div>
					<!-- //first section (nuts) -->
				</div>
			</div>
			<!-- //product right -->
		</div>
	</div>
	<!-- //top products -->
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>