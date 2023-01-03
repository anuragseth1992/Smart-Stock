<?php
	class Process extends Database
	{
		public function get_stockDetailsToBuy()
		{
			$isActive = 1;
			$getStockDetails = $this->conn->prepare( 'SELECT id,name,price,stock_date FROM stock_details WHERE is_active = ? GROUP BY name' );
			$getStockDetails->bind_param( 's', $isActive );
			$getStockDetails->execute();
			$result = $getStockDetails->get_result();
			return $result;
		}

		public function get_stockDetailsToSell()
		{
			$currentDate = date( 'Y-m-d' );
			$stockDetailsArray = $responseArray = array();
			$getInventory = $this->conn->prepare( 'SELECT id,name,bought_price,remaining_quantity FROM stock_transactions where type = "Bought" and remaining_quantity > 0 ORDER BY id DESC' );
			$getInventory->execute();
			$result_getInventory = $getInventory->get_result();
			$getStockDetails = $this->conn->prepare( 'SELECT id,name,price FROM stock_details' );
			$getStockDetails->execute();
			$result_getStockDetails = $getStockDetails->get_result();
			while ( $row = $result_getStockDetails->fetch_array( MYSQLI_ASSOC ) ) {
				$stockDetailsArray[ $row[ 'name' ] ] = $row[ 'price' ];
			}
			foreach ( $result_getInventory as $currentInventory ) {
				$key = $currentInventory[ 'id' ];
				$responseArray[ $key ][ 'tid' ] = $currentInventory[ 'id' ];
				$responseArray[ $key ][ 'name' ] = $currentInventory[ 'name' ];
				$responseArray[ $key ][ 'bought_price' ] = $currentInventory[ 'bought_price' ];
				$responseArray[ $key ][ 'remaining_quantity' ] = $currentInventory[ 'remaining_quantity' ];
				$responseArray[ $key ][ 'selling_price' ] = $stockDetailsArray[ $currentInventory[ 'name' ] ];
			}
			return $responseArray;
		}
	}
	$obj = new Process;
	$getToBuyData = $obj->get_stockDetailsToBuy();
	$getToSellData = $obj->get_stockDetailsToSell();
?>