<?php 
require_once('config.php');

if(isset($_GET['customer_id']) && is_numeric($_GET['customer_id']))
{
	$userID = intval($_GET['customer_id']);
	
	$qry = "select first_name from customers where id = ".$userID;

	$rs = $dbConn->query($qry);

	$fetchAllData = $rs->fetch_ALL(MYSQLI_ASSOC);
	

	echo "ass";

	$rs->close();

	$dbConn->close();

		
}
?>