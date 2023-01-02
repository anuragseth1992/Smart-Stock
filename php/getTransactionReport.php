<?php
	class Process extends Database
	{
		public function get_inventoryDetails()
		{
			$currentDate = date( 'Y-m-d' );
			$getInventoryDetails = $this->conn->prepare( 'SELECT type,name,transaction_date,bought_price,quantity FROM stock_transactions ORDER BY transaction_date DESC' );
			$getInventoryDetails->execute();
			$result = $getInventoryDetails->get_result();
			return $result;
		}
	}
	$obj = new Process;
	$getData = $obj->get_inventoryDetails();
?>