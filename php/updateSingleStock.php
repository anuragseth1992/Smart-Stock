<?php
	date_default_timezone_set( 'Asia/Kolkata' );
	include "../db/connection.php";
	class Process extends Database
	{
		public function verify_stockDetails( $stockName, $stockDate )
		{
			$stmt = $this->conn->prepare( 'SELECT COUNT(id) FROM stock_details WHERE name=? and stock_date=? LIMIT 1' );
			$stmt->bind_param( 'sss', $stockName, $stockDate );
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_row();
			if ( $row[ 0 ] > 0 ) {
				return "already_exists";
			}
		}

		public function update_stockDetails( $id, $name, $price, $date )
		{
			$stmt = $this->conn->prepare( 'UPDATE stock_details SET name = ?,price = ?,stock_date = ? WHERE id = ?' );
			$stmt->bind_param( 'ssss', $name, $price, $date, $id );
			if ( $stmt->execute() ) {
				return "Update Successful";
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