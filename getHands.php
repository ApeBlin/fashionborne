<?php 
require_once('config.php');

if(isset($_GET['hands_id']) && is_numeric($_GET['hands_id']))
{
	$userID = intval($_GET['hands_id']);
	
	$qry = "select name, layer from Hands where id = ".$userID;

	$rs = $dbConn->query($qry);

	$fetchHandsData = $rs->fetch_ALL(MYSQLI_ASSOC);
	foreach ($fetchHandsData as $handsData) {
		echo $handsData['name'];
	}


	$rs->close();

	$dbConn->close();

		
}
?>