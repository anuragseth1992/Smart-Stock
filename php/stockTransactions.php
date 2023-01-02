<?php
	date_default_timezone_set( 'Asia/Kolkata' );
	include "../db/connection.php";
	class Process extends Database
	{
		public function checkTransactionLimit( $stockName )
		{
			$settingName = 'MultiStockTransactionLimit';
			$checkSetting = $this->conn->prepare( 'SELECT setting_value FROM settings WHERE name = ?' );
			$checkSetting->bind_param( 's', $settingName );
			$checkSetting->execute();
			$result_checkSetting = $checkSetting->get_result();
			$row_checkSetting = $result_checkSetting->fetch_row();
			$currentDate = date( 'Y-m-d' );
			if ( $row_checkSetting[ 0 ] != 0 ) {
				$checkTransactionLimit = $this->conn->prepare( 'SELECT COUNT(id) FROM stock_transactions WHERE transaction_date = ? AND name = ?' );
				$checkTransactionLimit->bind_param( 'ss', $currentDate, $stockName );
			} else {
				$checkTransactionLimit = $this->conn->prepare( 'SELECT COUNT(id) FROM stock_transactions WHERE transaction_date = ?' );
				$checkTransactionLimit->bind_param( 's', $currentDate );
			}
			$checkTransactionLimit->execute();
			$result = $checkTransactionLimit->get_result();
			$row = $result->fetch_row();
			if ( $row[ 0 ] > 0 ) {
				return "Transaction Done";
			} else {
				return "Transaction Not Done";
			}
		}

		public function buyStock( $name, $quantity, $price )
		{
			$currentDate = date( 'Y-m-d' );
			$type = 'Bought';
			$buyStock = $this->conn->prepare( 'INSERT INTO stock_transactions(type,name,bought_price,quantity,remaining_quantity,transaction_date) values (?,?,?,?,?,?)' );
			$buyStock->bind_param( 'ssssss', $type, $name, $price, $quantity, $quantity, $currentDate );
			if ( $buyStock->execute() ) {
				return "Insertion Successful";
			}
		}

		public function sellStock( $name, $quantity, $boughtID, $boughtPrice, $sellingPrice )
		{
			$currentDate = date( 'Y-m-d' );
			$type = 'Sold';
			$sellStock = $this->conn->prepare( 'INSERT INTO stock_transactions(type,name,bought_price,sold_price,quantity,bought_id,transaction_date) values (?,?,?,?,?,?,?)' );
			$sellStock->bind_param( 'sssssss', $type, $name, $boughtPrice, $sellingPrice, $quantity, $boughtID, $currentDate );
			if ( $sellStock->execute() ) {
				$updateOldTransaction = $this->conn->prepare( 'UPDATE stock_transactions SET remaining_quantity = quantity - remaining_quantity + ' . $quantity . ' WHERE id = ?' );
				$updateOldTransaction->bind_param( 's', $boughtID );
				if ( $updateOldTransaction->execute() ) {
					return "Insertion Successful";
				}
			}
		}
	}
	$obj = new Process;
	if ( isset( $_POST[ "buyStock" ] ) and isset( $_POST[ "stockName" ] ) and isset( $_POST[ "stockQuantity" ] ) and isset( $_POST[ "currentPrice" ] ) ) {
		$response = array( 'flag' => false, 'response' => 'error' );
		$stockName = strtoupper( input_cleaner( ( $_POST[ "stockName" ] ) ) );
		$stockQuantity = input_cleaner( ( $_POST[ "stockQuantity" ] ) );
		$currentPrice = input_cleaner( ( $_POST[ "currentPrice" ] ) );
		$isTransactionLimitOver = $obj->checkTransactionLimit( $stockName );
		if ( $isTransactionLimitOver == "Transaction Done" ) {
			echo "<script type=\"text/javascript\">
			 alert(\"One transaction already done today for stock $stockName.\");
			  window.location = \"../../BuyStock/index.php\"
			  </script>";
			exit();
		}
		$insertData = $obj->buyStock( $stockName, $stockQuantity, $currentPrice );
		if ( $insertData == "Insertion Successful" ) {
			echo "<script type=\"text/javascript\">
			 alert(\"Stock Purchased.\");
			  window.location = \"../../BuyStock/index.php\"
			  </script>";
			exit();
		}
	}
	if ( isset( $_POST[ "sellStock" ] ) and isset( $_POST[ "stockName" ] ) and isset( $_POST[ "stockQuantity" ] ) and isset( $_POST[ "sellingPrice" ] ) and isset( $_POST[ "boughtPrice" ] ) and isset( $_POST[ "boughtID" ] ) ) {
		$response = array( 'flag' => false, 'response' => 'error' );
		$stockName = strtoupper( input_cleaner( ( $_POST[ "stockName" ] ) ) );
		$stockQuantity = input_cleaner( ( $_POST[ "stockQuantity" ] ) );
		$sellingPrice = input_cleaner( ( $_POST[ "sellingPrice" ] ) );
		$boughtPrice = input_cleaner( ( $_POST[ "boughtPrice" ] ) );
		$boughtID = input_cleaner( ( $_POST[ "boughtID" ] ) );
		$isTransactionLimitOver = $obj->checkTransactionLimit( $stockName );
		if ( $isTransactionLimitOver == "Transaction Done" ) {
			echo "<script type=\"text/javascript\">
			 alert(\"One transaction already done today for stock $stockName.\");
			  window.location = \"../../SellStock/index.php\"
			  </script>";
			exit();
		}
		$insertData = $obj->sellStock( $stockName, $stockQuantity, $boughtID, $boughtPrice, $sellingPrice );
		if ( $insertData == "Insertion Successful" ) {
			echo "<script type=\"text/javascript\">
			 alert(\"Stock Sold.\");
			  window.location = \"../../SellStock/index.php\"
			  </script>";
			exit();
		}
	}
?>