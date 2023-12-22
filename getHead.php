<?php 
require_once('config.php');

if(isset($_GET['head_id']) && is_numeric($_GET['head_id']))
{
	$userID = intval($_GET['head_id']);
	
	$qry = "select name, img, layer from Head where id = ".$userID;

	$rs = $dbConn->query($qry);

	$fetchHeadData = $rs->fetch_ALL(MYSQLI_ASSOC);
	foreach ($fetchHeadData as $headData) {
        $image = '<img src="' . $headData['img'] . '" style="z-index: ' . $headData['layer'] . ';">';
		echo $headData['name'];
		echo $image;
	}


	$rs->close();

	$dbConn->close();

		
}
?>