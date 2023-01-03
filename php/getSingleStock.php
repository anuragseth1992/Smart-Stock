<?php
	class Process extends Database
	{
		public function get_stockDetails( $stockID )
		{
			$getStockDetails = $this->conn->prepare( 'SELECT id,name,price,stock_date FROM stock_details WHERE id = ?' );
			$getStockDetails->bind_param( 's', $stockID );
			$getStockDetails->execute();
			$result = $getStockDetails->get_result();
			$row = $result->fetch_row();
			return $row;
		}
	}
	$obj = new Process;
	if ( isset( $_POST[ 'editStockdetails' ] ) ) {
		$stockID = $_POST[ 'detailID' ];
		$getData = $obj->get_stockDetails( $stockID );
		$getData[ 3 ] = date( "d/m/Y", strtotime( $getData[ 3 ] ) );
	} else {
		echo "<script type=\"text/javascript\">
			  alert(\"Invalid Access\");
			  window.location = \"../ViewStocks/index.php\"
			  </script>";
	}
?>