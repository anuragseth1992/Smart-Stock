<?php
	class Process extends Database
	{
		public function get_inventoryDetails()
		{
			$currentDate = date( 'Y-m-d' );
			$stmt = $this->conn->prepare( 'SELECT name,transaction_date,bought_price, remaining_quantity FROM stock_transactions WHERE type = "Bought"' );
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
	}
	$obj = new Process;
	$getData = $obj->get_inventoryDetails();
?>