
<?php 
require_once('config.php');

$qry = "select id, first_name, last_name from customers";
$rs = $dbConn->query($qry);
$fetchAllData = $rs->fetch_all(MYSQLI_ASSOC);

$qry2 = "select id, name from Chest";
$rs2 = $dbConn->query($qry2); // Fetch data for the second dropdown (Chest)
$fetchChestData = $rs2->fetch_all(MYSQLI_ASSOC);
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
	margin-top:10px;
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
	<h1>Customer Info Search</h1>
	
	<div>
		<label>Select Customer</label>
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
		<label>Chest</label>
		<select id="customer-list">
			<option value=""> ----</option>
			<?php
			foreach($fetchChestData as $chestData)
			{
				$chestID = $chestData['id'];
				$createFullName = $customerData['first_name']." ".$customerData['last_name'];
				echo '<option value = "'.$chestID.'">'.$chestData['name'].'</option>';			} 
			?>
		</select>
	</div>
	
	<img src="img/ajax-loader.gif" id="loader">
	
	<div id="customer-data">
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
</script>


</body>
</html>