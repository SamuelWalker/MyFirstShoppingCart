<?php require 'inc/header.php';?>
			
		<div class="row cart-thread cart-thread-margin">
			<div class="col-lg-6 col-md-6 my-3"><h4>商品</h4></div>
			<div class="col-lg-3 col-md-3 my-3"><h4>數量</h4></div>
			<div class="col-lg-3 col-md-3 my-3"><h4>價格</h4></div>
		</div>
		<form action="recalculateCart.php" method="post">
		<?php foreach($data['products'] as $product):;?>
			<div class="row cart-thread cart-thread-margin">
		    <div class="card card-body mb-3">
		      <a href="product.php?productId=<?php echo $product->productId; ?>">
		      	<div class="col-lg-5 col-md-5">
			      	<h4 class="card-title"><?php echo $product->productName;?></h4>
			      </div>
			    </a>
		    	<div class="col-lg-3 col-md-3">
		    		<input type="text" name="quantity[]" value="<?php echo $product->quantity;?>">      	
		      </div>
		      <div class="col-lg-3 col-md-3">		     	 
		     		<div class="bg-light p-2 mb-3 pricetag"><?php echo $product->productPrice; ?></div>
	      	</div>
	      	<input type="hidden" name="productId[]" value="<?php echo $product->productId;?>">
	      	<div class="col-lg-1 col-md-1">    	     	
    	     	<a class="btn btn-dark" href="recalculateCart.php/?productId=<?php echo $product->productId; ?>">Delete</a>    	     	
    	    </div>     
		    </div>
			</div>
     <?php
        $data['total'] += $product->subtotal;
      	endforeach;?>
      	<button class="btn btn-primary" name="update" type="submit">修改</button>
    </form>
		
		<!-- <input name="proceedToRetailCheckout" class="a-button-input" type="submit" value="Proceed to checkout" aria-labelledby="sc-buy-box-ptc-button-announce"> -->

    <span>小計: NT$<?php echo $data['total'];?></span>
    <a class="btn btn-primary"href="checkout.php">前去結帳</a>
    

<?php require 'inc/footer.php';?>