<?php
date_default_timezone_set('Asia/Kolkata');
class Process extends Database
{
	public function getStockData($stockname,$fromdate,$todate)
	{
		$stmt1 = $this->conn->prepare('SELECT price,stock_date from stock_details WHERE name = ? AND stock_date BETWEEN ? AND ? ORDER BY stock_date');
		$stmt1->bind_param('sss', $stockname,$fromdate,$todate);
		$stmt1->execute();
		$result = $stmt1->get_result();
		$key=1;
		$sumOfPrice = $maxPrice = $maxPriceDate = $minPrice = $minPriceDate = 0;
		$dataForChart = $dataForCalc = array();
		while($row = mysqli_fetch_array($result)){
			$sumOfPrice += $row[0];
			$dataForCalc[$key]['price']= $dataForChart[$key]['price']=$row[0];
			$dataForChart[$key]['date']=$row[1];
			if($key == 1 ){
				$maxPrice = $minPrice = $row[0];
				$maxPriceDate= $minPriceDate=$row[1];
			} else if($maxPrice<$row[0]){
				$maxPrice = $row[0];
				$maxPriceDate=$row[1];
			} else if($minPrice>$row[0]){
				$minPrice = $row[0];
				$minPriceDate=$row[1];
			}
			$key++;
		}
		if(empty($dataForChart)){
			echo "<script type=\"text/javascript\">
			 alert(\"No record found for the given date. Please change the date range and try again.\");
			  window.location = \"../StockAnalysis/index.php\"
			  </script>"; 
			  exit();
		}
		
		return array('ChartDetailData'=>$dataForChart,'CalcData'=>$dataForCalc,'SumOfPrice'=>$sumOfPrice,'maxPrice'=>$maxPrice,'maxPriceDate'=>$maxPriceDate,'minPrice'=>$minPrice,'minPriceDate'=>$minPriceDate);
	}
	
	public function getTransactionData($stockname,$fromdate,$todate)
	{
		$type='Sold';
		$stmt1 = $this->conn->prepare('SELECT t1.bought_price,t1.sold_price,t1.quantity,t1.transaction_date,t2.transaction_date as bought_date from stock_transactions t1, stock_transactions t2 WHERE t1.name = ? AND t1.type = ? AND t1.bought_id = t2.id AND t1.transaction_date BETWEEN ? AND ? ORDER BY transaction_date');
		$stmt1->bind_param('ssss', $stockname,$type,$fromdate,$todate);
		$stmt1->execute();
		$result = $stmt1->get_result();
		$key=1;
		$totalProfit = 0;
		$dataForProfit = array();
		while($row = mysqli_fetch_array($result)){
			$dataForProfit[$key]['bought_price']=$row[0];
			$dataForProfit[$key]['sold_price']=$row[1];
			$dataForProfit[$key]['quantity']=$row[2];
			$dataForProfit[$key]['transaction_date']=$row[3];
			$dataForProfit[$key]['bought_date']=$row[4];
			$profitOrLoss = "Profit";
			if($row[0]>$row[1])
			{
				$diff = $row[0]-$row[1];
				$profitOrLoss = "Loss";
			} else {
				$diff = $row[1]-$row[0];
			}
			$avg = ($row[0]+$row[1])/2;
			$percent = round(($diff/$avg)*100,2);
			$total = $row[2]*$diff;
			if($profitOrLoss == "Profit"){
				$totalProfit += $total;
			}
			$dataForProfit[$key]['profitOrLoss']=$profitOrLoss;
			$dataForProfit[$key]['percent']=$percent;
			$dataForProfit[$key]['total']=$total;
			$key++;
		}
		if(empty($dataForProfit)){
			echo "<script type=\"text/javascript\">
			 alert(\"No record found for the given date. Please change the date range and try again.\");
			  window.location = \"../StockAnalysis/index.php\"
			  </script>"; 
			  exit();
		}
		return array('dataForProfit'=>$dataForProfit,'totalProfit'=>$totalProfit);
	}
}
$obj = new Process;

if(isset($_POST['analyseStock'])){
		$stockName = input_cleaner($_POST['stockName']);
		$dateRange =explode('-',$_POST['dateRange']);
		$fromDate = date("Y-m-d", strtotime($dateRange[0]));
		$toDate = date("Y-m-d", strtotime($dateRange[1]));
		$getProfitData = $obj->getTransactionData($stockName, $fromDate, $toDate );
		$getStockData = $obj->getStockData($stockName, $fromDate, $toDate );
		$calculatedMean = $getStockData['SumOfPrice']/count($getStockData['ChartDetailData']);
		$deviationSquaredSum = 0;
		foreach($getStockData['CalcData'] as $value){
			$deviation = (float)$value['price'] - $calculatedMean;
			$deviationSquaredSum += $deviation*$deviation;
		}
		$avgOfDeviationSquaredSum = $deviationSquaredSum / count($getStockData['ChartDetailData']);
		$standardDeviation = sqrt($avgOfDeviationSquaredSum);
		$getChartDetailDate = $getChartDetailPrice = array();
		foreach($getStockData['ChartDetailData'] as $value){
			$getChartDetailDate[]=date("d-m", strtotime($value['date']));;
			$getChartDetailPrice[]=$value['price'];
		}
	}
?>