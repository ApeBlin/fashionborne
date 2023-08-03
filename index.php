
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
<style>

body{
	font-family:verdana;
	font-size:14px;
	background:#d6c173;
}

.container{
	width:1120px;
	margin:0 auto;
	border:1px solid #eeeeee;
	background:#ffffff;
	padding:10px;
}

h1{
	text-align:center;
	color:#c04e22;
	
}
table{
	border:1px solid #eeeeee;
	border-collapse: collapse;
	width:100%;
}

table th{
	border:1px solid #eeeeee;
	text-align:center;
	color:#c04e22;
	height:40px;
}
table td{
	border:1px solid #eeeeee;
	padding:5px;
	
}

#loader{
	display:none;
	margin-top:10px;
}

#customer-data{
	position: absolute;
}
#chest-data{
	position: absolute;
}

#customer-list{
	height:30px;
	width:250px;
}

</style>
</head>
<body>

<div class="container">
	<!--<h1>Jquery Ajax Dropdown (onchange) Example in PHP</h1>-->
	<h1>Fashionborne</h1>
	
	<div>
		<label>test</label>
		<select id="customer-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchAllData as $customerData)
			{
				$customerID = $customerData['id'];
				$createFullName = $customerData['first_name']." ".$customerData['last_name'];
				echo '<option value = "'.$customerID.'">'.$createFullName.'</option>';
			} 
			?>
		</select>
		<label>Head</label>
		<select id="head-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchHeadData as $headData)
			{
				echo '<option value = "'.$headData['id'].'">'.$headData['name'].'</option>';			} 
			?>
		</select>
		<br>
		<label>Chest</label>
		<select id="chest-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchChestData as $chestData)
			{
				echo '<option value = "'.$chestData['id'].'">'.$chestData['name'].'</option>';			} 
			?>
		</select>
		<label>Hands</label>
		<select id="hands-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchHandsData as $handsData)
			{
				echo '<option value = "'.$handsData['id'].'">'.$handsData['name'].'</option>';			} 
			?>
		</select>
		<label>Legs</label>
		<select id="legs-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchLegsData as $legsData)
			{
				echo '<option value = "'.$legsData['id'].'">'.$legsData['name'].'</option>';			} 
			?>
	</div>
	
	<img src="img/ajax-loader.gif" id="loader">
	
	<div id="customer-data">
	</div>
	<div id="chest-data">
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
</script>


</body>
</html>