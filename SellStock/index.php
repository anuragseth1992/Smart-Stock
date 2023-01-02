<?php
	include "../config.php";
	include "../php/getStockToBuyOrSell.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Stock Transactions</title>
	<?php getStyleSheets(); ?>
	<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php showNavbar(); ?>
	<?php displaySideMenu( 'sellStock' ); ?>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Sell Stock</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Stock Transactions</a></li>
							<li class="breadcrumb-item active">Sell Stock</li>
						</ol>
					</div>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Sell Stock as per latest price.</h3>
							</div>
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Serial No.</th>
										<th>Stock Name</th>
										<th>Bought Price(INR)</th>
										<th>Latest Selling Price(INR)</th>
										<th>Inventory</th>
										<th>Shares</th>
										<th>Sell</th>
									</tr>
									</thead>
									<tbody>
									<?php
										$serialNo = 1;
										foreach ( $getToSellData as $currentLot ) {
											$boughtID = $currentLot[ 'tid' ];
											$name = $currentLot[ 'name' ];
											$boughtPrice = $currentLot[ 'bought_price' ];
											$inventory = $currentLot[ 'remaining_quantity' ];
											$sellingPrice = $currentLot[ 'selling_price' ];
											echo "
											<tr><form method='POST' enctype='multipart/form-data' action='../php/stockTransactions.php/'>
												<input type='hidden' name='boughtID' value='$boughtID'/>
												<input type='hidden' name='stockName' value='$name'/>
												<input type='hidden' name='boughtPrice' value='$boughtPrice'/>
												<input type='hidden' name='sellingPrice' value='$sellingPrice'/>
												<td>$serialNo</td>
												<td>$name</td>
												<td>$boughtPrice/-</td>
												<td>$sellingPrice/-</td>
												<td>$inventory</td>
												<td><input type='number' name='stockQuantity' required/></td>
												<td><button type='submit' name='sellStock' class='btn btn-success'>Sell</button>
												</form>
											</tr>
											";
											$serialNo++;
										}
									?>
									</tbody>
									<tfoot>
									<tr>
										<th>Serial No.</th>
										<th>Stock Name</th>
										<th>Bought Price(INR)</th>
										<th>Latest Selling Price(INR)</th>
										<th>Inventory</th>
										<th>Shares</th>
										<th>Sell</th>
									</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php footerBar(); ?>
</div>
<?php getJSFiles(); ?>
<?php getTableJSFiles(); ?>

<script>
	$( function (){
		$( "#example1" ).DataTable( {
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		} ).buttons().container().appendTo( '#example1_wrapper .col-md-6:eq(0)' );

	} );
</script>
</body>
</html>
