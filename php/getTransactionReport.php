<?php
	class Process extends Database
	{
		public function get_inventoryDetails()
		{
			$currentDate = date( 'Y-m-d' );
			$stmt = $this->conn->prepare( 'SELECT type,name,transaction_date,bought_price,quantity FROM stock_transactions ORDER BY transaction_date DESC' );
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
	}
	$obj = new Process;
	$getData = $obj->get_inventoryDetails();
?>