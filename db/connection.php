<?php
	define( "HOST", "localhost" );
	define( "USER", "root" );
	define( "PASSWORD", "" );
	define( "DB", "smart_stock" );
	$con = mysqli_connect( HOST, USER, PASSWORD, DB );
	class Database
	{
		public $conn;

		function __construct()
		{
			$this->conn = mysqli_connect( HOST, USER, PASSWORD, DB );
			if ( !$this->conn ) {
				echo "Connecting Error " . mysqli_connect_error();
			}
		}
	}
	function input_cleaner( $input )
	{
		$input = trim( $input );
		$input = stripslashes( $input );
		$input = htmlspecialchars( $input );
		return $input;
	}

?>
