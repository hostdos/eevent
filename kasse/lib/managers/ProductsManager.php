<?php

class ProductsManager {
	public function GetAllProducts() {
		$DAO = DAO::GetDatabase();

		$query = "SELECT * FROM products";

		$products = $DAO->GetRowsOfQuery($query);
		return $products;
	}

	public function GetProductsByType($type) {
		$DAO = DAO::GetDatabase();

		$query = "SELECT * FROM products WHERE type='" . $type . "';";
		$products = $DAO->GetRowsOfQuery($query);
		return $products;
	}

	public function GetProduct($id) {
		$DAO = DAO::GetDatabase();
		$query = "SELECT * FROM products WHERE id=". $id;

		$product = $DAO->GetRowsOfQuery($query);

		$return = new Product($product[0]['id'], $product[0]['name'], $product[0]['price'], $product[0]['type']);
		return $return;
	}

	public function GetProductByName($name) {
		$DAO = DAO::GetDatabase();
		$query = "SELECT * FROM products WHERE name='". $name . "'";

		$product = $DAO->GetRowsOfQuery($query);

		$return = new Product($product[0]['id'], $product[0]['name'], $product[0]['price'], $product[0]['type']);
		return $return;
	}
}

class Product {
	public $id;
	public $name;
	public $price;
	public $type;

	public function __construct($id, $name, $price, $type) {
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
		$this->type = $type;
	}
}
?>