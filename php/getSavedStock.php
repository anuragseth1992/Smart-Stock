<?php
	class Process extends Database
	{
		public function get_stock()
		{
			$stmt = $this->conn->prepare( 'SELECT name FROM stock_details GROUP BY name ORDER BY name' );
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
	}
	$obj = new Process;
	$getSavedStock = $obj->get_stock();
?>