
<?php
require_once('config.php');

// Fetch customer data
$qryCustomers = "SELECT id, first_name, last_name FROM customers";
$rsCustomers = $dbConn->query($qryCustomers);
$fetchCustomerData = $rsCustomers->fetch_all(MYSQLI_ASSOC);

// Fetch dropdown data (Head, Chest, Hands, Legs)
$tables = ['Head', 'Chest', 'Hands', 'Legs'];
$fetchDropdownData = [];
foreach ($tables as $table) {
    $qry = "SELECT id, name FROM $table";
    $rs = $dbConn->query($qry);
    $fetchDropdownData[$table] = $rs->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>W3.CSS Template</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background:black">
<header class="header">
    <div class="w3-center"></div>
</header>

<div class="w3-center">
    <div class="w3-container w3-theme">
        <div class="w3-row">
            <div class="w3-half w3-container" style="margin-top: 3em;">
                <label>Head</label>
                <select id="head-list">
                    <option value="">----</option>
                    <?php foreach ($fetchDropdownData['Head'] as $headData): ?>
                        <option value="<?= $headData['id'] ?>"><?= $headData['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label>Chest</label>
                <select id="chest-list">
                    <option value="">----</option>
                    <?php foreach ($fetchDropdownData['Chest'] as $chestData): ?>
                        <option value="<?= $chestData['id'] ?>"><?= $chestData['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label>Hands</label>
                <select id="hands-list">
                    <option value="">----</option>
                    <?php foreach ($fetchDropdownData['Hands'] as $handsData): ?>
                        <option value="<?= $handsData['id'] ?>"><?= $handsData['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label>Legs</label>
                <select id="legs-list">
                    <option value="">----</option>
                    <?php foreach ($fetchDropdownData['Legs'] as $legsData): ?>
                        <option value="<?= $legsData['id'] ?>"><?= $legsData['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w3-half w3-container" style="margin-left: -10em">
                <!-- Ajax content will be displayed here -->
                <div id="head-data"></div>
                <div id="chest-data"></div>
                <div id="hands-data"></div>
                <div id="legs-data"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Set default dropdown selections
        $('#head-list, #chest-list, #hands-list, #legs-list').prop('selectedIndex', 0);

});

$(document).ready(function () {
    // Function to handle AJAX requests
    function handleAjaxRequest(elementId, phpScript) {
        $("#" + elementId).change(function () {
            $("#loader").show();
            var getUserID = $(this).val();
            if (getUserID !== '0') {
                $.ajax({
                    type: 'GET',
                    url: phpScript,
                    data: {[elementId.replace('-list', '_id')]: getUserID},
                    success: function (data) {
                        $("#" + elementId.replace('-list', '-data')).html(data);
                        $("#loader").hide();
                    }
                });
            } else {
                $("#" + elementId.replace('-list', '-data')).html('');
                $("#loader").hide();
            }
        });
    }

    // Call the handleAjaxRequest function for each dropdown
    handleAjaxRequest("customer-list", "ajax.php");
    handleAjaxRequest("head-list", "getHead.php");
    handleAjaxRequest("chest-list", "getChest.php");
    handleAjaxRequest("hands-list", "getHands.php");
    handleAjaxRequest("legs-list", "getLegs.php");
});
</script>
</body>
</html>