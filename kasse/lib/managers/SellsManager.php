<?php

class SellsManager {
	public function Sell($name, $seller, $selltype) {
		$manager = new ProductsManager();
		$product = $manager->GetProductByName($name);

		$DAO = DAO::GetDatabase();

		$query = "INSERT INTO sells (name, price, type, seller, selltype) VALUES (
			'".$product->name."',
			'".$product->price."',
			'".$product->type."',
			'".$seller."',
			'".$selltype."'
			);";

		return $DAO->GetQueryResult($query);

	}


}
?>