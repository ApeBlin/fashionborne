<?php 
require_once('config.php');

if(isset($_GET['legs_id']) && is_numeric($_GET['legs_id']))
{
	$userID = intval($_GET['legs_id']);
	
	$qry = "select name, layer from Legs where id = ".$userID;

	$rs = $dbConn->query($qry);

	$fetchLegsData = $rs->fetch_ALL(MYSQLI_ASSOC);
	foreach ($fetchLegsData as $legsData) {
	    echo $legsData['name'];
	}


	$rs->close();

	$dbConn->close();

		
}
?>