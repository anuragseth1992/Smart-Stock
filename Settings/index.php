<?php
	include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Settings</title>
	<?php getStyleSheets(); ?>
	<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php showNavbar(); ?>
	<?php displaySideMenu( 'setting' ); ?>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Settings</h1>
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
								<h3 class="card-title">Settings Page</h3>
							</div>
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>Serial No.</th>
										<th>Setting Name</th>
										<th>Description</th>
										<th>Value</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php
										$getStockDetails = "SELECT * FROM settings ORDER BY id";
										$result = mysqli_query( $con, $getStockDetails );
										$serialNo = 1;
										while ( $row = mysqli_fetch_array( $result ) ) {
											$settingID = $row[ 'id' ];
											$name = $row[ 'name' ];
											$description = $row[ 'description' ];
											$value = $row[ 'setting_value' ];
											echo "
											<tr><form method='POST' enctype='multipart/form-data' action='../php/changeSettings.php/'>
												<input type='hidden' name='settingID' value='$settingID'/>
												<td>$serialNo</td>
												<td>$name</td>
												<td>$description</td>
												<td><input type='text' name='setting_value' value='$value' required/></td>
												<td> <button type='submit' name='updateSettings' class='btn btn-info'>Edit</button></td>
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
										<th>Setting Name</th>
										<th>Description</th>
										<th>Value</th>
										<th>Action</th>
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
