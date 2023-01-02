<?php
	include "../config.php";
	include "../php/getSavedStock.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Analyse Stock</title>
	<?php getStyleSheets(); ?>
	<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
	<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/enterdata.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php showNavbar(); ?>
	<?php displaySideMenu( 'stockAnalysis' ); ?>

	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Analyse Stock</h1>
					</div>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="col-md-12">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Fill the search form to analyse stock.</h3>
						</div>
						<form enctype="multipart/form-data" method="post" id="analyzeStock"
						      action="../AnalysedStock/index.php">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Stock Name:</label>
											<select class="form-control select2bs4" id="stockName" name="stockName"
											        style="width: 100%;">
												<?php
													while ( $row = $getSavedStock->fetch_array( MYSQLI_ASSOC ) ) {
														$stockName = $row[ 'name' ];
														echo "<option>$stockName</option>";
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Date:</label>
											<div class="input-group">
												<div class="input-group-prepend">
													  <span class="input-group-text">
														<i class="far fa-calendar-alt"></i>
													  </span>
												</div>
												<input type="text" class="form-control float-right" id="dateRange"
												       name="dateRange">
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<button type="submit" name="analyseStock" class="btn btn-primary">Search
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	</div>
	</section>
</div>
<?php footerBar(); ?>
</div>

<?php getJSFiles(); ?>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../plugins/select2/js/select2.full.min.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>

<script>
	$( function (){
		$( '#dateRange' ).daterangepicker();
		$( '.select2' ).select2();
		$( '.select2bs4' ).select2( {
			theme: 'bootstrap4'
		} );

	} )
	$( "#dateRange" ).change( function (){
		$.ajax( {
			url: "../php/checkCalculations.php",
			method: "POST",
			data: $( "#checkCalculations" ).serialize(),
			success: function ( data ){
				if ( data['flag'] == true ) {
					Toast.fire( {
						icon: 'success',
						title: 'The stock has been updated successfully.'
					} )
				} else {
					Toast.fire( {
						icon: 'error',
						title: 'There was issue while updating stock. Please contact administrator for the same.'
					} )
				}
			},
			dataType: "json"
		} )
	} );
</script>

</body>
</html>
