<?php require 'inc/header.php';?>
	<div class="py-5 text-center">
		<h2>結帳區</h2>
	</div>
	<form action="checkout.php" method="post">
		<div class="row">
			<div class="col-md-12 mb-4">
				<h4 class="" ">收件人資料</h4>
			</div>
			<div class="col-lg-6 col-md-6 mb-3">
				<label for="name">姓名</label>
				<input type="text" class="form-control" id="name" name="name" required>
			</div>
			<div class="col-lg-6 col-md-6 mb-3">
				<label for="phone">電話</label>
				<input type="text" class="form-control" id="phone" name="phone" required>
			</div>
			<div class="col-md-12 mb-3">
			<labe for="address">地址</labe>
			<input type="text" class="form-control" id="address" name="address" required>			
			</div>
		</div>
		<hr class="mb-4">
		<div class="row">
			<h4 class="col-md-12 d-flex justify-content-between align-items-center">
				<span>購物車</span>
				<span class="badge badge-secondary">商品總數 <?php echo $data['totalQuantity']->totalQuantity; ?></span>
			</h4>
		<!-- </div>
		<div class="row"> -->
			<div class="col-lg-8 col-md-8 mb-3">商品</div>
			<div class="col-lg-1 col-md-1 mb-3">數量</div>
			<div class="col-lg-3 col-md-3 mb-3">價格</div>
		
			<?php foreach ($data['products'] as $product): ?>
				
			<div class="col-8 col-sm-8 mb-1"><?php echo $product->productName;?></div>
			<div class="col-1 col-sm-1 mb-1"><?php echo $product->quantity;?></div>
			<div class="col-3 col-sm-3 mb-1 pricetag"><?php echo $product->productPrice;?></div>
			
			
			<?php
				$data['total'] += $product->subtotal; 
				endforeach; ?>

			<div class="col-12">
				<ul class="list-group">
					<li class="list-group-item d-flex justify-content-between">
						<span>小計</span>
						<strong class="pricetag"><?php echo $data['total']; ?></strong>
						<input type="hidden" name="total" value="<?php echo $data['total']; ?>">
					</li>
					<li class="list-group-item d-flex justify-content-between">
						<span>運費</span>
						<strong class="pricetag">100</strong>
						<input type="hidden" name="shippingFee" value="100">
					</li>
					<li class="list-group-item d-flex justify-content-between">
						<span>總計</span>
						<strong class="pricetag"><?php echo $data['total']+100; ?></strong>
						<input type="hidden" name="grandTotal" value="<?php echo $data['total']+100; ?>">
					</li>
				</ul>
			</div>
		</div>
		<hr class="mb-4">
		<h4>付款方式</h4>
		<div>
			<input id="atm" name="paymentMethod" type="radio" value="2" checked required>
			<!-- always send checked data? -->
			<label for="atm">ATM</label>
		</div>
		<div>
			<input id="credit" name="paymentMethod" type="radio" value="1" required>
			<label for="credit">信用卡</label>
		</div>
		<div>
			<input id="cash" name="paymentMethod" type="radio" value="3" required>
			<label for="cash">貨到付款</label>
		</div>
		<hr class="mb-4">
		<button class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="submit">結帳</button>
	</form>

<?php require 'inc/footer.php';?>

<!-- 姓名
電話
地址

商品名稱 數量 價格
.       .   .
.       .   .
.       .   .
小計：
運費：
總計商品數量 總價
選擇付款方式 radio
結帳


total price
	deliverFee
	grandTotal
	customerName
	customerEmail
	customerAddress
	customerPhone
	paymentType(1,2,3) -> paymentType table 1:... 2:... 3:... -->
