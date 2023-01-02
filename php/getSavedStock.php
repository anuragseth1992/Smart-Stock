<?php
	class Process extends Database
	{
		public function get_stock()
		{
			$getStock = $this->conn->prepare( 'SELECT name FROM stock_details GROUP BY name ORDER BY name' );
			$getStock->execute();
			$result = $getStock->get_result();
			return $result;
		}
	}
	$obj = new Process;
	$getSavedStock = $obj->get_stock();
?>