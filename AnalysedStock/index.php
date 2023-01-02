<?php
	include "../config.php";
	include "../php/getStockData.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SMART STOCK Home Page</title>
	<?php getStyleSheets(); ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php showNavbar(); ?>
	<?php displaySideMenu( 'stockAnalysis' ); ?>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-8">
						<h1 class="m-0">Analysis of <?php echo "$stockName in date range $fromDate to $toDate."; ?></h1>
					</div>
					<div class="col-sm-4">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Stock Analysis</a></li>
							<li class="breadcrumb-item active">Stock : <?php echo $stockName; ?></li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-6">
						<div class="small-box bg-info">
							<div class="inner">
								<h3><?php echo $getProfitData[ 'totalProfit' ]; ?>/-</h3>
								<p>Profit Made</p>
							</div>
							<div class="icon">
								<i class="ion ion-cash"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-success">
							<div class="inner">
								<h3><?php echo $calculatedMean; ?></h3>
								<p>Mean</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3><?php echo $standardDeviation; ?></h3>
								<p>Standard Deviation</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header border-0">
								<div class="d-flex justify-content-between">
									<h3 class="card-title">Stock detail Date Wise</h3>
								</div>
							</div>
							<div class="card-body">
								<div class="d-flex">
									<p class="d-flex flex-column">
										<span class="text-bold text-info"><?php echo $getStockData[ 'minPrice' ]; ?></span>
										<span class="text-info">Best date to purchase: <?php echo $getStockData[ 'minPriceDate' ]; ?> </span>
									</p>
									<p class="ml-auto d-flex flex-column text-right">
										<span class="text-bold text-green"><?php echo $getStockData[ 'maxPrice' ]; ?></span>
										<span class="text-green">Best date to sell: <?php echo $getStockData[ 'maxPriceDate' ]; ?></span>
									</p>
								</div>

								<div class="position-relative mb-4">
									<canvas id="visitors-chart" height="200"></canvas>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-header border-0">
								<h3 class="card-title">Selling Transactions</h3>
							</div>
							<div class="card-body table-responsive p-0">
								<table class="table table-striped table-valign-middle">
									<thead>
									<tr>
										<th>Selling Date</th>
										<th>Bought Price(Date)</th>
										<th>Selling Price</th>
										<th>Profit/Loss Per Share</th>
										<th>Shares Sold</th>
										<th>Total Profit/Loss</th>
									</tr>
									</thead>
									<tbody>
									<?php
										foreach ( $getProfitData[ 'dataForProfit' ] as $currentRow ) {
											$bought_price = $currentRow[ 'bought_price' ];
											$sold_price = $currentRow[ 'sold_price' ];
											$quantity = $currentRow[ 'quantity' ];
											$transaction_date = $currentRow[ 'transaction_date' ];
											$bought_date = $currentRow[ 'bought_date' ];
											$percent = $currentRow[ 'percent' ];
											$total = $currentRow[ 'total' ];
											echo "<tr>
												<td>$transaction_date</td>
												<td>$bought_price($bought_date)</td>
												<td>$sold_price</td>";
											if ( $currentRow[ 'profitOrLoss' ] == "Profit" ) {
												echo "<td>
													  <span class='badge bg-success'>
														<i class='fas fa-arrow-up'></i>
														$percent%
													  </span>
													</td>
													<td>$quantity</td>
													<td>
													  <span class='text-success mr-1'>
														$total/-
													  </span>
													</td>
													<tr>
													";
											} else {
												echo "<td>
													  <small class='badge bg-danger'>
														<i class='fas fa-arrow-up'></i>
														$percent%
													  </small>
													</td>
													<td>$quantity</td>
													<td>
													  <small class='text-danger mr-1'>
														<i class='fas fa-arrow-down'></i>
														$total/-
													  </small>
													</td>
													<tr>
													";
											}
										}
									?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php footerBar(); ?>
</div>
<?php getJSFiles(); ?>
<script src='../plugins/chart.js/Chart.min.js'></script>
<script>
	$( function (){
		'use strict'

		var ticksStyle = {
			fontColor: '#495057',
			fontStyle: 'bold'
		}

		var mode = 'index'
		var intersect = true


		var $visitorsChart = $( '#visitors-chart' )
		var dateArrayForDetails =<?php echo json_encode( $getChartDetailDate );?>;
		var priceArrayForDetails =<?php echo json_encode( $getChartDetailPrice );?>;
		var visitorsChart = new Chart( $visitorsChart, {
			data: {
				labels: dateArrayForDetails,
				datasets: [{
					type: 'line',
					data: priceArrayForDetails,
					backgroundColor: 'transparent',
					borderColor: '#007bff',
					pointBorderColor: '#007bff',
					pointBackgroundColor: '#007bff',
					fill: false
				}]
			},
			options: {
				maintainAspectRatio: false,
				tooltips: {
					mode: mode,
					intersect: intersect
				},
				hover: {
					mode: mode,
					intersect: intersect
				},
				legend: {
					display: false
				},
				scales: {
					yAxes: [{
						// display: false,
						gridLines: {
							display: true,
							lineWidth: '4px',
							color: 'rgba(0, 0, 0, .2)',
							zeroLineColor: 'transparent'
						},
						ticks: $.extend( {
							beginAtZero: true,
							suggestedMax: <?php echo $getStockData[ 'maxPrice' ];?>
						}, ticksStyle )
					}],
					xAxes: [{
						display: true,
						gridLines: {
							display: false
						},
						ticks: ticksStyle
					}]
				}
			}
		} )
	} )
</script>
</body>
</html>
