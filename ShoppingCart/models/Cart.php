<?php
class Cart{
	private $db;
	

	public function __construct(){
		require_once 'libraries/Database'.'.php';
		$this->db = new Database;
	}

	public function getProducts(){
		$this->db->query('SELECT * FROM product');
		$results = $this->db->resultSet();

		return $results;
	}

	public function rows(){
		return $this->db->rowCount('SELECT * FROM product');
	}

	public function getProductById($id){
		$this->db->query('SELECT * FROM product WHERE id = :id');
		$this->db->bind(':id', $id);

		$row = $this->db->single();
		return $row;

	}

	public function checkTempCartById($id){
		$this->db->query('SELECT * FROM tempCart WHERE productId = :productId');
		$this->db->bind(':productId', $id);

		$row = $this->db->single();
//if execute() is enough?
		if($this->db->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	// public function quantitySumById($id){
	// 	$this->db->query('SELECT SUM(quantity) as sum FROM tempCart WHERE productId = :productId');
	// 	$this->db->bind(':productId', $id);
	// 	$result = $this->db->single();
	// 	return $result;
	// }

	public function updateTempCartById($data){
		$this->db->query('UPDATE tempCart SET quantity = :quantity WHERE productId = :productId');
		$this->db->bind(':quantity', $data['quantity']);
		$this->db->bind(':productId', $data['productId']);
		
		if($this->db->execute()){
			return true;
		}else return false;
	}
	//set date

	public function addTempCart($data){
		$this->db->query('INSERT INTO tempCart (
			productId, quantity) VALUES(:productId, :quantity)
			');
		$this->db->bind(':productId', $data['productId']);
		$this->db->bind(':quantity', $data['quantity']);

		//Execute
		if($this->db->execute()){
			return true;
		}else return false;
	}

	public function getTempCart(){
		$this->db->query('SELECT *,
											tempCart.id as tempCartId,
											product.id as productId,
											tempCart.quantity * product.productPrice as subtotal
											FROM tempCart
											INNER JOIN product
											WHERE tempCart.productId = product.id
											ORDER BY tempCart.date DESC');
		$results = $this->db->resultSet();

		return $results;
	}

	public function getTempCartById($id){
		$this->db->query('SELECT * FROM tempCart WHERE productId = :productId');
		$this->db->bind(':productId', $id);
		$result = $this->db->single();
		return $result;
	}

	public function getTempCartRow(){
		return $this->db->rowCount('SELECT * FROM tempCart');
	}

	public function deleteTempCartById($id){
		$this->db->query('DELETE FROM tempCart WHERE productId = :productId');
		$this->db->bind(':productId', $id);

		if($this->db->execute()){
			return true;
		}else return false;
	}

	public function getTempCartTotalQuantity(){
		$this->db->query('SELECT sum(quantity) as totalQuantity from tempCart');
		$result = $this->db->single();

		return $result;
	}

	public function addOrderInfo($data){
		$this->db->query('INSERT INTO orders 
											(customerName, customerAddress, customerPhone, paymentMethod, total, shippingFee, grandTotal) 
											VALUES
											(:customerName, :customerAddress, :customerPhone, :paymentMethod, :total, :shippingFee, :grandTotal)');
		$this->db->bind(':customerName', $data['name']);
		$this->db->bind(':customerAddress', $data['address']);
		$this->db->bind(':customerPhone', $data['phone']);
		$this->db->bind(':paymentMethod', $data['paymentMethod']);
		$this->db->bind(':total', $data['total']);
		$this->db->bind(':shippingFee', $data['shippingFee']);
		$this->db->bind(':grandTotal', $data['grandTotal']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	// public function get

	public function addOrderDetail(){
		$this->db->query('INSERT INTO orderDetail(orderId, productId, quantity)
SELECT orders.id, tempCart.productId, tempCart.quantity
FROM orders INNER JOIN tempCart');
		// $this->db->bind(':orderId', $data['orderId']);
		// $this->db->bind(':productId', $data['productId']);
		// $this->db->bind('.quantity', $data['quantity']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function deleteTempcart(){
		$this->db->query('DELETE FROM tempCart');
		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function addProduct($data){
		$this->db->query('INSERT INTO product 
										(productName, productPrice, productImg, description)
										VALUES
										(:productName, :productPrice, :productImg, :description)');
		$this->db->bind(':productName', $data['productName']);
		$this->db->bind(':productPrice', $data['productPrice']);
		$this->db->bind(':productImg', $data['productImg']);
		$this->db->bind(':description', $data['description']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	
}//end of Cart


