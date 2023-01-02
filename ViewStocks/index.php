<?php
	include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Stock Details</title>
	<?php getStyleSheets(); ?>
	<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php showNavbar(); ?>
	<?php displaySideMenu( 'viewStocks' ); ?>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>View Stock Details</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Stock Details</a></li>
							<li class="breadcrumb-item active">View Stock Details</li>
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
								<h3 class="card-title">View all stock details entered till date.</h3>
							</div>
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Serial No.</th>
										<th>Stock Name</th>
										<th>Date</th>
										<th>Price(INR)</th>
										<th>Edit</th>
									</tr>
									</thead>
									<tbody>
									<?php
										$getStockDetails = "SELECT * FROM stock_details ORDER BY id DESC";
										$result = mysqli_query( $con, $getStockDetails );
										$serialNo = 1;
										while ( $row = mysqli_fetch_array( $result ) ) {
											$stockID = $row[ 'id' ];
											$name = $row[ 'name' ];
											$price = $row[ 'price' ];
											$date = $row[ 'stock_date' ];
											echo "
											<tr><form method='POST' enctype='multipart/form-data' action='../UpdateStocks/'>
												<input type='hidden' name='detailID' value='$stockID'/>
												<td>$serialNo</td>
												<td>$name</td>
												<td>$date</td>
												<td>$price</td>
												<td> <button type='submit' name='editStockdetails' class='btn btn-sm btn-info btn-raised rippler rippler-inverse'><i class='fa fa-edit'></i></button></td>
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
										<th>Date</th>
										<th>Price(INR)</th>
										<th>Edit</th>
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
