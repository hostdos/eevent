<?php
include(dirname(__FILE__) . '/../lib/DAO.php');
include_once(dirname(__FILE__) . '/../lib/managers/ProductsManager.php');
include_once(dirname(__FILE__) . '/../lib/managers/SellsManager.php');

if(isset($_POST['action'])) {
	session_start();
	$services = new TillServices();
	$action = $_POST['action'];
	switch ($action) {
		case 'sell':		
			if(isset($_POST['products'])) {
				$products = array($_POST['products']);
				echo $services->Sell($products[0], $_POST['selltype']);
			}
			break;

		case 'login':
			if(isset($_POST['key'])) {
				echo $services->Login($_POST['key']);
			}
			break;
		case 'checkin':
			if(isset($_POST['type'])){
				echo $services->Checkin($_POST['type']);
			}	
			break;
		case 'get': {
			echo $services->GetProducts();
		}
	}
}
class TillServices {
	public function Login($key) {
		session_unset('user');
		switch ($key) {
			case 'Eev3ntHelfer1':
				$_SESSION["user"] = "Helfer 1";
			break;

			case 'Eev3ntHelfer2':
				$_SESSION["user"] = "Helfer 2";
			break;

			case 'Eev3ntHelfer3':
				$_SESSION["user"] = "Helfer 3";
			break;

			case 'Eev3ntHelfer4':
				$_SESSION["user"] = "Helfer 4";
			break;

			case 'Eev3ntHelfer5':
				$_SESSION["user"] = "Helfer 5";
			break;
		}
		if(isset($_SESSION['user'])) {
			$return = array('result' => 'ok');
			return json_encode($return);
		}
		else {
			$return = array('result' => 'incorrect');
			return json_encode($return);
		}
	}

	public function Checkin($type) {
		$_SESSION["authed"] = true;
		$type = utf8_decode($type);
		$_SESSION["type"] = $type;

		$return = array('result' => 'ok', 'type' => $type);
		return json_encode($return);

	}

	public function GetProducts() {
		if($this->isAuthed()) {
			$manager = new ProductsManager();
			$products["products"] = $manager->GetProductsByType($_SESSION["type"]);
			$products["result"] = "ok";
			$products["type"] = $_SESSION["type"];
			return json_encode($products);
		}
	}

	private function isAuthed() {
		$authed = $_SESSION["authed"];
		if($authed == "true") {
			return true;
		}
		return false;
	}

	public function Sell($data, $type) {
		if($this->isAuthed()) {
			$manager = new SellsManager();
			foreach ($data as $product) {
				$manager->Sell($product, $_SESSION['user'], $type);
			}
			$return = array('result' => 'ok');
			return json_encode($return);
		}
	}
}

?>