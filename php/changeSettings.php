<?php
	date_default_timezone_set( 'Asia/Kolkata' );
	include "../db/connection.php";
	class Process extends Database
	{
		public function updateSetting( $id, $value )
		{
			$updateSetting = $this->conn->prepare( 'UPDATE settings SET setting_value = ? WHERE id = ?' );
			$updateSetting->bind_param( 'ss', $value, $id );
			if ( $updateSetting->execute() ) {
				return "Updation Successful";
			}
		}
	}
	$obj = new Process;
	if ( isset( $_POST[ "updateSettings" ] ) and isset( $_POST[ "settingID" ] ) and isset( $_POST[ "setting_value" ] ) ) {
		$response = array( 'flag' => false, 'response' => 'error' );
		$settingID = input_cleaner( ( $_POST[ "settingID" ] ) );
		$setting_value = input_cleaner( ( $_POST[ "setting_value" ] ) );
		$updateData = $obj->updateSetting( $settingID, $setting_value );
		if ( $updateData == "Updation Successful" ) {
			echo "<script type=\"text/javascript\">
			 alert(\"Setting Updated.\");
			  window.location = \"../../Settings/index.php\"
			  </script>";
			exit();
		}
	}
?>