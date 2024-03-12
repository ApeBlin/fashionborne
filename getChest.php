<?php 
require_once('config.php');

if(isset($_GET['chest_id']) && is_numeric($_GET['chest_id']))
{
	$userID = intval($_GET['chest_id']);
	
	$qry = "select name, layer, img from Chest where id = ".$userID;

	$rs = $dbConn->query($qry);

	$fetchChestData = $rs->fetch_ALL(MYSQLI_ASSOC);
	foreach ($fetchChestData as $chestData) {
        $image = '<img src="' . $chestData['img'] . '" style="z-index: ' . $chestData['layer'] . ';">';
	//	echo $chestData['name'];
		echo $image;
	}
	$rs->close();
	$dbConn->close();	
}
?>