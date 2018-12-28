<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report</title>
	<style>
		body {
		  font-size:10px;
		}
		.my-border{
			border: 1px solid black;
		}
		.tbl-headers{
     		 background-color: #f2f2f2 
   		}
   		table, td, th {  
   			border: 1px solid black;
		  	text-align: left;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		}

		th, td {
		  padding: 3px;
		}
	</style>
</head>
<body>
	<div style="text-align: center;">
		<p style="font-size: 16px; font-weight: bold">Payment Logs</p>
		<p>
			<b>Date:</b>
			<?php 
			if($date_log['from'] == $date_log['to']){
				echo $date_log['from'];
			}else{
				echo $date_log['from'].' to '.$date_log['to'];

			}
			?>
		</p>	
	</div>
	<br><br>
	<table class="my-border">
		<tr class="tbl-headers">
			<th>Date</th>
			<th>OR#</th>
			<th>Student</th>
			<th>User</th>
			<th>Fee</th>
			<th>Amount</th>
			<th>Action</th>
		</tr>
		<?php  

			foreach($data as $d){ ?>
				<tr>
					<td> <?php echo $d->paidDate; ?> </td>
					<td> <?php echo $d->or_number; ?> </td>
					<td> <?php echo $d->student; ?> </td>
					<td> <?php echo $d->faculty; ?> </td>
					<td> <?php echo $d->feeName; ?> </td>
					<td> <?php echo $d->amount; ?> </td>
					<td> <?php echo $d->action; ?> </td>
				</tr>

				<?php
			}

		?>
	</table>
	

</body>
</html>