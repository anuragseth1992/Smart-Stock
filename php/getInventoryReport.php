<?php
	class Process extends Database
	{
		public function get_inventoryDetails()
		{
			$currentDate = date( 'Y-m-d' );
			$getInventoryDetails = $this->conn->prepare( 'SELECT name,transaction_date,bought_price, remaining_quantity FROM stock_transactions WHERE type = "Bought"' );
			$getInventoryDetails->execute();
			$result = $getInventoryDetails->get_result();
			return $result;
		}
	}
	$obj = new Process;
	$getData = $obj->get_inventoryDetails();
?>