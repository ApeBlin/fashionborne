<?php 
require_once('config.php');

if(isset($_GET['legs_id']) && is_numeric($_GET['legs_id']))
{
	$userID = intval($_GET['legs_id']);
	
	$qry = "select name, img, layer from Legs where id = ".$userID;

	$rs = $dbConn->query($qry);

	$fetchLegsData = $rs->fetch_ALL(MYSQLI_ASSOC);
	foreach ($fetchLegsData as $legsData) {
        $image = '<img src="' . $legsData['img'] . '" style="z-index: ' . $legsData['layer'] . ';">';
	//	echo $legsData['name'];
		echo $image;
	}


	$rs->close();

	$dbConn->close();

		
}
?>