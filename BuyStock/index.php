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
	<?php displaySideMenu( 'buyStock' ); ?>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Buy Stock</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Stock Transactions</a></li>
							<li class="breadcrumb-item active">Buy Stock</li>
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
								<h3 class="card-title">Buy Stock as per latest price.</h3>
							</div>
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Serial No.</th>
										<th>Stock Name</th>
										<th>Latest Price(INR)</th>
										<th>Shares</th>
										<th>Buy</th>
									</tr>
									</thead>
									<tbody>
									<?php
										$serialNo = 1;
										while ( $row = $getToBuyData->fetch_array( MYSQLI_ASSOC ) ) {
											$detailID = $row[ 'id' ];
											$name = $row[ 'name' ];
											$price = $row[ 'price' ];
											echo "
											<tr><form method='POST' enctype='multipart/form-data' action='../php/stockTransactions.php/'>
												<input type='hidden' name='detailID' value='$detailID'/>
												<input type='hidden' name='stockName' value='$name'/>
												<input type='hidden' name='currentPrice' value='$price'/>
												<td>$serialNo</td>
												<td>$name</td>
												<td>$price/-</td>
												<td><input type='number' name='stockQuantity' required/></td>
												<td><button type='submit' name='buyStock' class='btn btn-info'>Buy</button>
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
										<th>Latest Price(INR)</th>
										<th>Shares</th>
										<th>Buy</th>
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
