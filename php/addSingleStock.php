<?php
	date_default_timezone_set( 'Asia/Kolkata' );
	include "../db/connection.php";
	class Process extends Database
	{
		public function verify_stockDetails( $stockName, $stockPrice, $stockDate )
		{
			$stmt = $this->conn->prepare( 'SELECT COUNT(id) FROM stock_details WHERE name=? and price=? and stock_date=? LIMIT 1' );
			$stmt->bind_param( 'sss', $stockName, $stockPrice, $stockDate );
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_row();
			if ( $row[ 0 ] > 0 ) {
				return "already_exists";
			}
		}
		public function insert_stockDetails( $name, $price, $date )
		{
			$stmt = $this->conn->prepare( 'INSERT INTO stock_details(name,price,stock_date) values (?,?,?)' );
			$stmt->bind_param( 'sss', $name, $price, $date );
			if ( $stmt->execute() ) {
				return "Insertion Successful";
			}
		}

		public function insert_bulk_stockDetails( $insertData )
		{
			$insertionSuccessful = true;
			foreach ( $insertData as $val ) {
				$stmt = $this->conn->prepare( 'SELECT COUNT(id) FROM stock_details WHERE name=? and price=? and stock_date=? LIMIT 1' );
				$stmt->bind_param( 'sss', $val[ 'name' ], $val[ 'price' ], $val[ 'stockDate' ] );
				$stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_row();
				if ( $row[ 0 ] == 0 ) {
					$statement = "INSERT INTO stock_details (name,price,stock_date) VALUES (?,?,?)";
					$stmt = $this->conn->prepare( $statement );
					$stmt->bind_param( 'sss', $val[ 'name' ], $val[ 'price' ], $val[ 'stockDate' ] );
					if ( !$stmt->execute() ) {
						$insertionSuccessful = false;
					}
					$stmt->close();
				}
			}
			if ( $insertionSuccessful ) {
				return "Insertion Successful";
			}
		}
	}
	$obj = new Process;
	if ( isset( $_POST[ "stockName" ] ) and isset( $_POST[ "stockPrice" ] ) and isset( $_POST[ "stockDate" ] ) ) {
		$response = array( 'flag' => false, 'response' => 'error' );
		$stockName = strtoupper( input_cleaner( ( $_POST[ "stockName" ] ) ) );
		$stockPrice = input_cleaner( ( $_POST[ "stockPrice" ] ) );
		$stockDate = input_cleaner( ( $_POST[ "stockDate" ] ) );
		$stockDate = date( "Y-m-d", strtotime( $stockDate ) );
		$checkData = $obj->verify_stockDetails( $stockName, $stockPrice, $stockDate );
		if ( $checkData == "already_exists" ) {
			$response[ 'response' ] = "Detail Already Exists";
			echo json_encode( $response );
			exit();
		}
		$insertData = $obj->insert_stockDetails( $stockName, $stockPrice, $stockDate );
		if ( $insertData == "Insertion Successful" ) {
			$response[ 'flag' ] = true;
			$response[ 'response' ] = "Insertion Successful";
			echo json_encode( $response );
			exit();
		}
	}
	if ( isset( $_POST[ "UploadStockDetails" ] ) ) {
		$insertData = array();
		$filename = $_FILES[ "file" ][ "tmp_name" ];
		if ( $_FILES[ "file" ][ "size" ] > 0 ) {
			$file = fopen( $filename, "r" );
			$keyID = 0;
			while ( ( $getData = fgetcsv( $file, 10000, "," ) ) !== FALSE ) {
				if ( $keyID != 0 ) {
					$insertData[ $keyID ][ 'name' ] = strtoupper( input_cleaner( $getData[ 0 ] ) );
					$insertData[ $keyID ][ 'stockDate' ] = date( "Y-m-d", strtotime( $getData[ 1 ] ) );
					$insertData[ $keyID ][ 'price' ] = input_cleaner( $getData[ 2 ] );
					$sortByDate[ $keyID ] = strtotime( $getData[ 1 ] );
				}
				$keyID++;
			}
			array_multisort( $sortByDate, SORT_ASC, $insertData );
			$insertBulkData = $obj->insert_bulk_stockDetails( $insertData );
			if ( $insertBulkData == "Insertion Successful" ) {
				echo "<script type=\"text/javascript\">
							alert(\"CSV File has been successfully Imported.\");
							window.location = \"../AddStocks/index.php\"
						  </script>";
			} else {
				echo "<script type=\"text/javascript\">
							  alert(\"There was an issue while uploading CSV File. Please contact adminitrator for the same.\");
							  window.location = \"../AddStocks/index.php\"
							  </script>";
			}
			fclose( $file );
		}
	}
?>