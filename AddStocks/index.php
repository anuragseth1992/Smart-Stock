<?php 
	include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Stock Details</title>
  <?php  getStyleSheets();?>
	<link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
	<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/enterdata.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php showNavbar(); ?> 
	<?php displaySideMenu('addStocks'); ?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Stock Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Stocks</a></li>
              <li class="breadcrumb-item active">Add Stock Details</li>
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
                <h3 class="card-title">Add Single Stock Details</h3>
              </div>
              <form onsubmit="return false" method="post" id="addSingleStock">
                <div class="card-body">
					<div class="row">
						<div class="col-md-4">
						  <div class="form-group">
							<label for="stockName">Stock Name:</label>
							<input type="text" class="form-control" id="stockName" name="stockName" placeholder="Enter Stock Name" required>
						  </div>
						</div>
						  
						  <div class="col-md-4">
							  <div class="form-group">
								<label>Date:</label>
								<div class="input-group date" id="reservationdate" data-target-input="nearest">
									<input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="stockDate" required/>
									<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							  </div>
						  </div>
						  <div class="col-md-4">
							  <div class="form-group">
								<label for="stockPrice">Stock Price(INR):</label>
								<input type="number" class="form-control" id="stockPrice" name="stockPrice" placeholder="Enter Stock Price" required>
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
          <div class="col-md-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bulk CSV Upload</h3>
              </div>
              <form class="form-horizontal"  action="../php/addSingleStock.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
				<div class="row">
						<div class="col-md-4">
						  <div class="form-group">
							<label for="downloadCSV">Download Sample:</label>
							<input type="button" class="form-control btn btn-secondary" id="downloadCSV" name="downloadCSV" value="Download" />
						  </div>
						</div>
						  <div class="col-md-4">
							  <div class="form-group">
								<label for="uploadCSV">Choose File:</label>
								<div class="input-group">
								  <div class="custom-file">
									<input type="file" class="custom-file-input" name="file" id="file">
									<label class="custom-file-label" for="uploadCSV">Choose file</label>
								  </div>
								</div>
							  </div>
						  </div>
						  <div class="col-md-4">
							  <div class="form-group">
								<label for="uploadCSV">File Upload:</label>
								  <button  type="submit" class="form-control btn btn-success" id="uploadCSV" name="UploadStockDetails" data-loading-text="Loading..." >Upload</button>
								</div>
							  </div>
						  </div>
					</div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </section>
  </div>
<?php footerBar();?>
</div>

<?php getJSFiles();?>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
	$(function () {
	  bsCustomFileInput.init();
	});
	$(function () {
		$('#reservationdate').datetimepicker({
			format: 'L'
		});
	});
	
	
const download = function (data) {
    const blob = new Blob([data], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.setAttribute('href', url);
    a.setAttribute('download', 'downloadStockDetails.csv');
    a.click();
}
 
const csvmaker = function (data) {
    csvRows = [];
    const headers = Object.keys(data);
    csvRows.push(headers.join(','));
    const values = Object.values(data).join(',');
    csvRows.push(values);
    return csvRows.join('\n');
}
 
const get = async function () {
     const data = {
        StockName: '',
        StockDate: '',
        StockPrice: ''
    }
    const csvdata = csvmaker(data);
    download(csvdata);
}
const btn = document.getElementById('downloadCSV');
btn.addEventListener('click', get);
</script>
</body>
</html>
