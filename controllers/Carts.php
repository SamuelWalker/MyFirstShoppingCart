<?php
	// define('PROJECTROOT','http://localhost/PracticeProject/ShoppingCart/');
	class Carts{
		public function __construct(){
			require_once 'models/Cart'.'.php';
			//Instantiate model Cart
			$this->cartModel = new Cart();
		}

		public function view($view, $data = []){

			if(file_exists('views/'.$view.'.php')){
				require_once 'views/'.$view.'.php';
			}else{
				die('View does not exist');
			}
		}
//for
		// public function model($model){
		// 	require_once 'models/'.$model.'.php';

		// 	return new $model;
		// }

		public function index(){
			$products = $this->cartModel->getProducts();
			$rows = $this->cartModel->rows();
			$data = [
				'title' => 'ShoppingCart',
				'description' => 'Have Fun! Shop around!',
				'products' => $products,
				'rows' => $rows,
				'count' => 0
			];
			$this->view('index',$data);
		}

		public function product(){
			// $products = $this->cartModel->getProducts();
			if(isset($_GET['submit'])){
				
				$cartData = [
					'productId' => $_GET['productId'],
					'quantity' => $_GET['quantity']
				];

				
//Check if the product about to add into the cart already existed
				if($this->cartModel->checkTempCartById($_GET['productId'])){
// add up quantity of result(an object)
					$cartData['quantity'] += $this->cartModel->getTempCartById($cartData['productId'])->quantity;
					// echo $cartData['quantity'];
// Update tempCart data
					if(!$this->cartModel->updateTempCartById($cartData)){
						die('Something went wrong');
					}

				}else{					
					if(!$this->cartModel->addTempCart($cartData)){
						die('Something went wrong');
					}
				}
//or add a new data into cart				
				header('location:product.php?productId='.$_GET['productId']);
				
			}
			
			$product = $this->cartModel->getProductById($_GET['productId']);
			$data =[
				'product' => $product
			];
			$this->view('product',$data);
		}

		public function cart(){
			$products = $this->cartModel->getTempCart();
			// $rows = $this->cartModel->getTempCartRow(); 沒用的
			$data = [
				'title' => 'ShoppingCart',
				'description' => 'Have Fun! Shop around!',
				'products' => $products,
				'total' => 0
			];
			$this->view('cart',$data);
		}

		public function recalculateCart(){

			if(isset($_POST['update'])){
				//Filter quantity input, if is not integer, don't do anything
				foreach($_POST['quantity'] as $q){
					if(!filter_var($q, FILTER_VALIDATE_INT) === false){
						}else{
							header('location:cart.php');
						}
				}
				$quantity = $_POST['quantity'];
				$pId = $_POST['productId'];
				// var_export($_POST['productId']);
				
				//switch case if post['quantity'] != tempcart quantity then ...

				//filter_var($int, FILTER_VALIDATE_INT)
				if(filter_)
				foreach ($pId as $key => $value) {
					// echo 'hmm..';
					// var_dump($value);
					//(int): convert string to integer
					// make sure its larger than 0, non-int string using (int) convert to integer will all be 0
					//isset make sure it's not empty or null
					if((int)$quantity[$key] > 0 && isset($quantity[$key])){
						//get db quantity from tempcart
						$dbCartQuantity = (int)$this->cartModel->getTempCartById($value)->quantity;
						//If quantity from form of cart differs from it's from db then update
						
						if((int)$quantity[$key] !== $dbCartQuantity){
							 
							$updateData = [
								'productId' => $value,
								'quantity' => (int)$quantity[$key]
							];
							if(!$this->cartModel->updateTempCartById($updateData)){
								die('Something went wrong with the update.');
							}
						}

						header('location:cart.php');						
					}					
				}				
			}//end of POST['update']

			if(isset($_GET['productId'])){
				// var_dump($_GET['productId']);
				if(!$this->cartModel->deleteTempCartById($_GET['productId'])){
					die('Something went wrong with delete!');				
				}else{
					header('location:../cart.php');
				}
			}
		}//end of recalculateCart()

		public function checkout(){

			if(isset($_POST['submit'])){
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					'name' => trim($_POST['name']),
					'address' => trim($_POST['address']),
					'phone' => trim($_POST['phone']),
					'paymentMethod' => $_POST['paymentMethod'],
					'total' => $_POST['total'],
					'shippingFee' => $_POST['shippingFee'],
					'grandTotal' => $_POST['grandTotal']
				];
				//insert into table orders and table orderDetail
				if(!empty($data['name']) && !empty($data['address']) && !empty($data['phone'])){
					if($this->cartModel->addOrderInfo($data)){
						if($this->cartModel->addOrderDetail()){
//delete tempCart data
							if($this->cartModel->deleteTempCart()){
								header('location:index.php');
							}else{
								die('Something went wrong with delete!');
							}							
						}else{
							die('Something went wrong with delete!');	
						}
					}else{
						die('Something went wrong with delete!');	
					}
					
				}//end of insert into orders adn orderDetail
			}else{

				$products = $this->cartModel->getTempCart();
				$totalQuantity = $this->cartModel->getTempCartTotalQuantity();
				$data = [
					'title' => '結帳區',
					'description' => '結帳區',
					'products' => $products,
					'totalQuantity' => $totalQuantity,
					'total' => 0
				];
				$this->view('checkout',$data);
			}
		}

		public function productUpload(){

			if(isset($_POST['submit'])){
				
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
//確認檔案沒有重複，才存入資料與檔案
				if(!empty($_POST['productName']) && !empty($_POST['price']) && !empty($_FILES['image']['name']) && !empty($_POST['description'])) {
					
					if(file_exists('img/'.$_FILES['image']['name'])){
						return false;
					}else{

						$data = [
							'productName' => $_POST['productName'],
							'productPrice' => $_POST['price'],
							'productImg' => $_FILES['image']['name'],
							'description' => $_POST['description']
						];

						if($this->cartModel->addProduct($data)){
							move_uploaded_file($_FILES['image']['tmp_name'],'img/'.$_FILES['image']['name']);
							
							header('location:index.php');
						}else{
							die('Can not insert this product into db.');
						}				
					}
				}			
			}else{

				$this->view('productUpload');
			}
		}
	}//end of Carts

class Core{
	protected $controller;

	public function __construct(){
		$this->controller = new Carts;

		// $this->controller->index();
	}
}
?>