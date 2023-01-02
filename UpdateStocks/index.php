<?php
	include "../config.php";
	include "../php/getSingleStock.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Stock Details</title>
	<?php getStyleSheets(); ?>
	<link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
	<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/enterdata.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php showNavbar(); ?>
	<?php displaySideMenu( 'addStocks' ); ?>

	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Update Stock Details</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Stocks</a></li>
							<li class="breadcrumb-item active">Update Stocks</li>
						</ol>
					</div>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="col-md-12">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Update Stock Details</h3>
						</div>
						<form onsubmit="return false" method="post" id="updateSingleStock">
							<input type="hidden" name="stockID" value="<?php echo $getData[ 0 ]; ?>"/>
							<div class="card-body">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="stockName">Stock Name:</label>
											<input type="text" class="form-control" id="stockName" name="stockName"
											       placeholder="Enter Stock Name" value="<?php echo $getData[ 1 ]; ?>"
											       required>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Date:</label>
											<div class="input-group date" id="reservationdate"
											     data-target-input="nearest">
												<input type="text" class="form-control datetimepicker-input"
												       data-target="#reservationdate" name="stockDate"
												       value="<?php echo $getData[ 3 ]; ?>" required/>
												<div class="input-group-append" data-target="#reservationdate"
												     data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="stockPrice">Stock Price(INR):</label>
											<input type="number" class="form-control" id="stockPrice" name="stockPrice"
											       placeholder="Enter Stock Price" value="<?php echo $getData[ 2 ]; ?>"
											       required>
										</div>
									</div>
									<div class="col-md-2">
										<button type="submit" class="btn btn-primary">Submit</button>
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
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
	$( function (){
		bsCustomFileInput.init();
	} );
	$( function (){
		$( '#reservationdate' ).datetimepicker( {
			format: 'L'
		} );
	} );
</script>
</body>
</html>
