<?php require 'inc/header.php';?>

		<nav>
			<button><a href="index.php">Back</a></button>
			<button><a href="cart.php">購物車</a></button>
		</nav>
		
		<div>
			<div>				
				<img src="img/<?php echo $data['product']->productImg; ?>" style="width: 220px;">
				<div>
					<h4><?php echo $data['product']->productName;?></h4>
					<p><?php echo $data['product']->description;?></p>
					<p class="pricetag"><?php echo $data['product']->productPrice;?></p>

				</div>
			</div>

			<div>
				<form action="product.php" method="get">
				<input type="hidden" name="productId" value="<?php echo $_GET['productId'];?>">
				<select name="quantity" id="count">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
				<button type="submit" name="submit" >放入購物車</button>
				</form>
			</div>
		</div>

<?php require 'inc/footer.php'; ?>