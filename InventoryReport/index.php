<?php
	include "../config.php";
	include "../php/getInventoryReport.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inventory Report</title>
	<?php getStyleSheets(); ?>
	<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php showNavbar(); ?>
	<?php displaySideMenu( 'inventoryReport' ); ?>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Inventory Report</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Report</a></li>
							<li class="breadcrumb-item active">Inventory Report</li>
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
								<h3 class="card-title">Inventory Report</h3>
							</div>
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Serial No.</th>
										<th>Name</th>
										<th>Lot/Date</th>
										<th>Price</th>
										<th>Quantity</th>
									</tr>
									</thead>
									<tbody>
									<?php
										$serialNo = 1;
										while ( $row = $getData->fetch_array( MYSQLI_ASSOC ) ) {
											$name = $row[ 'name' ];
											$date = $row[ 'transaction_date' ];
											$price = $row[ 'bought_price' ];
											$inventory = $row[ 'remaining_quantity' ];
											echo "
											<tr>
												<td>$serialNo</td>
												<td>$name</td>
												<td>$date</td>
												<td>$price/-</td>
												<td>$inventory</td>
											</tr>
											";
											$serialNo++;
										}
									?>
									</tbody>
									<tfoot>
									<tr>
										<th>Serial No.</th>
										<th>Name</th>
										<th>Lot/Date</th>
										<th>Price</th>
										<th>Quantity</th>
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
