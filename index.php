
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

#topSwag {
  position:relative;
  left: ;
  top: 31px;
  width: 744px;
  height: 81px;
}

body{
	position: inherit;
	font-family:verdana;
	font-size:14px;
	background-image: url(assets/right.png);
	background-repeat: no-repeat;
    background-size: cover;
}

.container{
	width:1300px;
	margin:0 auto;
	padding:10px;
	color:#ffffff;
}
.dropdown-box{
	margin-top: 100px;
	position: relative;
}

h1{
	text-align:center;
	color:#c04e22;
	
}

#loader{
	display:none;
	margin-top:10px;
}

#customer-data{
	position: absolute;
}
#head-data{
	position: absolute;
}
#chest-data{
	position: absolute;
}
#hands-data{
	position: absolute;
}
#legs-data{
	position: absolute;
}


#customer-list{
	height:30px;
	width:250px;
}
#head-list{
	height:25px;
	width:200px;
	margin-left: 26px;
	margin-bottom: 5px;
}
#chest-list{
	height:25px;
	width:200px;
	margin-left: 23px;
	margin-bottom: 5px;
}
#hands-list{
	height:25px;
	width:200px;
	margin-left: 18px;
	margin-bottom: 5px;
}
#legs-list{
	height:25px;
	width:200px;
	margin-left: 30px;
	margin-bottom: 5px;
}

</style>
</head>
<body>
	
<div class="container">
	<!--<h1>Jquery Ajax Dropdown (onchange) Example in PHP</h1>-->
	<img id="topSwag" src="assets/topSwag.png">	
	<div class="dropdown-box">
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
		<br>
		<label>Head</label>
		<select id="head-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchHeadData as $headData)
			{
				echo '<option value = "'.$headData['id'].'">'.$headData['name'].'</option>';
			} 
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
		<br>
		<label>Hands</label>
		<select id="hands-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchHandsData as $handsData)
			{
				echo '<option value = "'.$handsData['id'].'">'.$handsData['name'].'</option>';			} 
			?>
		</select>
		<br>
		<label>Legs</label>
		<select id="legs-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchLegsData as $legsData)
			{
				echo '<option value = "'.$legsData['id'].'">'.$legsData['name'].'</option>';			} 
			?>
		</select>
	</div>
	
	<img src="img/ajax-loader.gif" id="loader">
	
	<div id="customer-data">
	</div>
	<div id="head-data">
	</div>
	<div id="chest-data">
	</div>
	<div id="hands-data">
	</div>
	<div id="legs-data">
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