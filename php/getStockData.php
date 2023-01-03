<?php
date_default_timezone_set('Asia/Kolkata');
class Process extends Database
{
	public function getStockData($stockname,$fromdate,$todate)
	{
		$getStockData = $this->conn->prepare('SELECT price,stock_date from stock_details WHERE name = ? AND stock_date BETWEEN ? AND ? ORDER BY stock_date');
		$getStockData->bind_param('sss', $stockname,$fromdate,$todate);
		$getStockData->execute();
		$result = $getStockData->get_result();
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
		return array('ChartDetailData'=>$dataForChart,'CalcData'=>$dataForCalc,'SumOfPrice'=>$sumOfPrice,'maxPrice'=>$maxPrice,'maxPriceDate'=>$maxPriceDate,'minPrice'=>$minPrice,'minPriceDate'=>$minPriceDate);
	}
	
	public function getTransactionData($stockname,$fromdate,$todate)
	{
		$type='Sold';
		$getTransactionData = $this->conn->prepare('SELECT t1.bought_price,t1.sold_price,t1.quantity,t1.transaction_date,t2.transaction_date as bought_date from stock_transactions t1, stock_transactions t2 WHERE t1.name = ? AND t1.type = ? AND t1.bought_id = t2.id AND t1.transaction_date BETWEEN ? AND ? ORDER BY transaction_date');
		$getTransactionData->bind_param('ssss', $stockname,$type,$fromdate,$todate);
		$getTransactionData->execute();
		$result = $getTransactionData->get_result();
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
		return array('dataForProfit'=>$dataForProfit,'totalProfit'=>$totalProfit);
	}
}
$obj = new Process;

if(isset($_POST['analyseStock'])){
		$stockName = input_cleaner($_POST['stockName']);
		$dateRange =explode('-',$_POST['dateRange']);
		$fromDate = date("Y-m-d", strtotime($dateRange[0]));
		$toDate = date("Y-m-d", strtotime($dateRange[1]));
		$calculatedMean = $avgOfDeviationSquaredSum = $deviationSquaredSum = 0;
		$getChartDetailDate = $getChartDetailPrice = array();
		$getProfitData = $obj->getTransactionData($stockName, $fromDate, $toDate );
		$getStockData = $obj->getStockData($stockName, $fromDate, $toDate );
		if(!empty($getStockData['ChartDetailData'])){
			$calculatedMean = $getStockData['SumOfPrice']/count($getStockData['ChartDetailData']);
			foreach($getStockData['CalcData'] as $value){
				$deviation = (float)$value['price'] - $calculatedMean;
				$deviationSquaredSum += $deviation*$deviation;
			}
			$avgOfDeviationSquaredSum = $deviationSquaredSum / count($getStockData['ChartDetailData']);
			$standardDeviation = round(sqrt($avgOfDeviationSquaredSum), 2);
			foreach($getStockData['ChartDetailData'] as $value){
				$getChartDetailDate[]=date("d-m", strtotime($value['date']));;
				$getChartDetailPrice[]=$value['price'];
			}
		}		
	} else {
		echo "<script type=\"text/javascript\">
			  alert(\"Invalid Access\");
			  window.location = \"../StockAnalysis/index.php\"
			  </script>";
	}
?>