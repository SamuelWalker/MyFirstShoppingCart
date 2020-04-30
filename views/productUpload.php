<?php require 'inc/header.php';?>

<form class="my-3" action="productUpload.php" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-12 my-3">
			<span>商品圖片</span>
			<input type="file" name="image">
		</div>
		<div class="col-12 my-3">
			<span>商品名稱</span>
			<input type="text" name="productName">
		</div>
		<div class="col-12 my-3">
			<span>商品說明</span>
			<textarea name="description" cols="50" rows="10"></textarea>
		</div>
		<!-- <div class="clearfix"></div> -->
		<div class="col-12 my-3">
			<span>價錢</span>
			<input type="number" name="price">
		</div>
		<div class="col-12">
			<button class="btn btn-primary btn-lg " name="submit" type="submit" value="submit">上傳</button>
		</div>
	</div>
</form>

<!-- 
insert img
productName > productName
description > description
price > productPrice
categoryId 
 -->
  
<?php require 'inc/footer.php'?>
