<?php 
require_once('config.php');

if(isset($_GET['chest_id']) && is_numeric($_GET['chest_id']))
{
	$userID = intval($_GET['chest_id']);
	
	$qry = "select name, layer from Chest where id = ".$userID;

	$rs = $dbConn->query($qry);

	$fetchChestData = $rs->fetch_ALL(MYSQLI_ASSOC);
	foreach ($fetchChestData as $chestData) {
	}

    echo $chestData['name'] .'<br>';

	$rs->close();

	$dbConn->close();

		
}
?>