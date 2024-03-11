<?php 
require_once('config.php');

if(isset($_GET['hands_id']) && is_numeric($_GET['hands_id']))
{
	$userID = intval($_GET['hands_id']);
	
	$qry = "select name, layer, img from Hands where id = ".$userID;

	$rs = $dbConn->query($qry);

	$fetchHandsData = $rs->fetch_ALL(MYSQLI_ASSOC);
	foreach ($fetchHandsData as $handsData) {
        $image = '<img src="' . $handsData['img'] . '" style="z-index: ' . $handsData['layer'] . ';">';
	//	echo $handsData['name'];
		echo $image;
	}


	$rs->close();

	$dbConn->close();

		
}
?>