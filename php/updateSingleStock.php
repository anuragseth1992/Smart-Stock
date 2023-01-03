<?php
	date_default_timezone_set( 'Asia/Kolkata' );
	include "../db/connection.php";
	class Process extends Database
	{
		public function verify_stockDetails( $stockName, $stockDate )
		{
			$verifyStockDetails = $this->conn->prepare( 'SELECT COUNT(id) FROM stock_details WHERE name=? and stock_date=? LIMIT 1' );
			$verifyStockDetails->bind_param( 'ss', $stockName, $stockDate );
			$verifyStockDetails->execute();
			$result = $verifyStockDetails->get_result();
			$row = $result->fetch_row();
			if ( $row[ 0 ] > 0 ) {
				return "already_exists";
			}
		}

		public function update_stockDetails( $id, $name, $price, $date )
		{
			$isActive = 1;
			$updateStockDetails = $this->conn->prepare( 'UPDATE stock_details SET name = ?,price = ?,stock_date = ?,is_active = ? WHERE id = ?' );
			$updateStockDetails->bind_param( 'sssss', $name, $price, $date, $isActive, $id );
			if ( $updateStockDetails->execute() ) {
				$isActive = 0;
				$updateStockDetails = $this->conn->prepare( 'UPDATE stock_details SET is_active = ? WHERE name = ? AND stock_date != (select MAX(stock_date) FROM stock_details WHERE name = ?)' );
				$updateStockDetails->bind_param( 'sss', $isActive, $name, $name );
				if ( $updateStockDetails->execute() ) {
					return "Update Successful";
				}				
			}
		}
	}
	$obj = new Process;
	if ( isset( $_POST[ "stockID" ] ) and isset( $_POST[ "stockName" ] ) and isset( $_POST[ "stockPrice" ] ) and isset( $_POST[ "stockDate" ] ) ) {
		$response = array( 'flag' => false, 'response' => 'error' );
		$stockID = input_cleaner( ( $_POST[ "stockID" ] ) );
		$stockName = strtoupper( input_cleaner( ( $_POST[ "stockName" ] ) ) );
		$stockPrice = input_cleaner( ( $_POST[ "stockPrice" ] ) );
		$stockDate = input_cleaner( ( $_POST[ "stockDate" ] ) );
		$stockDate = date( "Y-m-d", strtotime( $stockDate ) );
		$checkData = $obj->verify_stockDetails( $stockName, $stockDate );
		if ( $checkData == "already_exists" ) {
			$response[ 'response' ] = "Detail Already Exists";
			echo json_encode( $response );
			exit();
		}
		$updateData = $obj->update_stockDetails( $stockID, $stockName, $stockPrice, $stockDate );
		if ( $updateData == "Update Successful" ) {
			$response[ 'flag' ] = true;
			$response[ 'response' ] = "Update Successful";
			echo json_encode( $response );
			exit();
		}
	}
?>