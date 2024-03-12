
<?php 
require_once('config.php');

$qry = "select id, first_name, last_name from customers";
$rs = $dbConn->query($qry);
$fetchAllData = $rs->fetch_all(MYSQLI_ASSOC);

$qryHead = "select id, name from Head";
$rsHead = $dbConn->query($qryHead); // Fetch data for the dropdown (Head)
$fetchHeadData = $rsHead->fetch_all(MYSQLI_ASSOC);

$qryChest = "select id, name from Chest";
$rsChest = $dbConn->query($qryChest); // Fetch data for the dropdown (Chest)
$fetchChestData = $rsChest->fetch_all(MYSQLI_ASSOC);

$qryHands = "select id, name from Hands";
$rsHands = $dbConn->query($qryHands); // Fetch data for the dropdown (Hands)
$fetchHandsData = $rsHands->fetch_all(MYSQLI_ASSOC);

$qryLegs = "select id, name from Legs";
$rsLegs = $dbConn->query($qryLegs); // Fetch data for the dropdown (Legs)
$fetchLegsData = $rsLegs->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="styles.css"> 
</head>
<body style="background:black">
	<header class="header">
		<div class="w3-center">
		</div>
	</header>
<div class="w3-center">
	<div class="w3-container w3-theme">
		<div class="w3-row">
			<div class="w3-half w3-container" style="margin-top: 3em;" >
			<label>Head</label>
				<select id="head-list">
					<option value=""> ----</option>
					<?php
					foreach($fetchHeadData as $headData)
					{	echo '<option value = "'.$headData['id'].'">'.$headData['name'].'</option>';} 
					?>
				</select>
			<br>
			<label>Chest</label>
				<select id="chest-list">
					<option value=""> ----</option>
					<?php
					foreach($fetchChestData as $chestData)
					{	echo '<option value = "'.$chestData['id'].'">'.$chestData['name'].'</option>';} 
					?>
				</select>
			<br>
				<label>Hands</label>
				<select id="hands-list">
					<option value=""> ----</option>
					<?php
					foreach($fetchHandsData as $handsData)
					{	echo '<option value = "'.$handsData['id'].'">'.$handsData['name'].'</option>';} 
					?>
				</select>
			<br>
				<label>Legs</label>
				<select id="legs-list">
					<option value=""> ----</option>
					<?php
					foreach($fetchLegsData as $legsData)
					{	echo '<option value = "'.$legsData['id'].'">'.$legsData['name'].'</option>';} 
					?>
				</select>
			</div>
				<div class="w3-half w3-container" style="margin-left: -10em">
						<!--Jquery Ajax Dropdown (onchange) in PHP-->
						<!--<div id="customer-data"> <img src="assets/nude.png"></div>-->
						<div id="head-data"></div>
						<div id="chest-data"></div>
						<div id="hands-data"></div>
						<div id="legs-data"></div>
				</div>
		</div>
	</div>

	





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
    // Get the dropdown element by its ID
    var customerDropdown = document.getElementById("customer-list");
	var headDropdown = document.getElementById("head-list");
    var chestDropdown = document.getElementById("chest-list");
    var handsDropdown = document.getElementById("hands-list");
    var legsDropdown = document.getElementById("legs-list");

    
    // Reset the dropdown selection to the default option (index 0)
    customerDropdown.selectedIndex = 0;
	headDropdown.selectedIndex = 0;
	chestDropdown.selectedIndex = 0;
	handsDropdown.selectedIndex = 0;
	legsDropdown.selectedIndex = 0;
});
</script>

<script>
	$(document).ready(function(){
		
		$("#customer-list").change(function(){
				
				$("#loader").show();
				
				var getUserID = $(this).val();
				
				if(getUserID != '0')
				{
					$.ajax({
						type: 'GET',
						url: 'ajax.php',
						data: {customer_id:getUserID},
						success: function(data){
							$("#loader").hide();
							$("#customer-data").html(data);
						}
					});
				}
				else
				{
					$("#customer-data").html('');
					$("#loader").hide();
				}
		});
		
	});
	$(document).ready(function(){
		
		$("#head-list").change(function(){
				
				$("#loader").show();
				
				var getUserID = $(this).val();
				
				if(getUserID != '0')
				{
					$.ajax({
						type: 'GET',
						url: 'getHead.php',
						data: {head_id:getUserID},
						success: function(data){
							$("#loader").hide();
							$("#head-data").html(data);
						}
					});
				}
				else
				{
					$("#head-data").html('');
					$("#loader").hide();
				}
		});
		
	});
	$(document).ready(function(){
		
		$("#chest-list").change(function(){
				
				$("#loader").show();
				
				var getUserID = $(this).val();
				
				if(getUserID != '0')
				{
					$.ajax({
						type: 'GET',
						url: 'getChest.php',
						data: {chest_id:getUserID},
						success: function(data){
							$("#loader").hide();
							$("#chest-data").html(data);
						}
					});
				}
				else
				{
					$("#chest-data").html('');
					$("#loader").hide();
				}
		});
		
	});
	$(document).ready(function(){
		
		$("#hands-list").change(function(){
				
				$("#loader").show();
				
				var getUserID = $(this).val();
				
				if(getUserID != '0')
				{
					$.ajax({
						type: 'GET',
						url: 'getHands.php',
						data: {hands_id:getUserID},
						success: function(data){
							$("#loader").hide();
							$("#hands-data").html(data);
						}
					});
				}
				else
				{
					$("#hands-data").html('');
					$("#loader").hide();
				}
		});
		
	});
	$(document).ready(function(){
		
		$("#legs-list").change(function(){
				
				$("#loader").show();
				
				var getUserID = $(this).val();
				
				if(getUserID != '0')
				{
					$.ajax({
						type: 'GET',
						url: 'getLegs.php',
						data: {legs_id:getUserID},
						success: function(data){
							$("#loader").hide();
							$("#legs-data").html(data);
						}
					});
				}
				else
				{
					$("#legs-data").html('');
					$("#loader").hide();
				}
		});
		
	});
</script>


</body>
</html>