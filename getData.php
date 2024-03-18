<?php 
require_once('config.php');

// Check if the parameter is set and numeric
if(isset($_GET['item_id']) && is_numeric($_GET['item_id'])) {
    // Sanitize the input
    $itemID = intval($_GET['item_id']);
    
    // Determine the table based on the parameter name
    $table = '';
    switch ($_GET['type']) {
        case 'chest':
            $table = 'Chest';
            break;
        case 'hands':
            $table = 'Hands';
            break;
        case 'head':
            $table = 'Head';
            break;
        case 'legs':
            $table = 'Legs';
            break;
        default:
            // Invalid type, exit
            exit;
    }
    
    // Prepare the SQL query
    $qry = "SELECT name, img, layer FROM $table WHERE id = $itemID";
    
    // Execute the query
    $rs = $dbConn->query($qry);

    // Fetch the data
    $fetchData = $rs->fetch_all(MYSQLI_ASSOC);

    // Output the data as HTML
    foreach ($fetchData as $data) {
        $image = '<img src="' . $data['img'] . '" style="z-index: ' . $data['layer'] . ';">';
        echo $image;
    }

    // Close the result set and database connection
    $rs->close();
    $dbConn->close();
}
?>
