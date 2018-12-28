<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report</title>
	<style>
		body {
		  font-size:10px;
		}
		.tbl-headers{
     		 background-color: #f2f2f2 
   		}
   		table, td, th {  
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
	
	<img src="<?php echo base_url(); ?>assets/img/banner.png">

	<div style="text-align: center">
			<b>LIST OF <?php echo strtoupper($type) ?> ACCOUNTS<br>
			S.Y <?php echo $data['term'] ?> <br>
			as of <?php echo date("F j, Y"); ?><br><br>
	</div>
	<br><br>
	
	<?php 

		if($type == 'paid'){ ?>
			<table>
				<tr>
					<th>No.</th>
					<th>Name</th>
				</tr>
				<?php 
					$ctr = 1;
					foreach($data['students'] as $student){
						echo "<tr>";
							echo "<td style='width: 10%'>".$ctr."</td>";
							echo "<td>".$student->name."</td>";
						echo "</tr>";
						++$ctr;
					}
				?>
			</table>
			<?php
		}else{ ?>
			<table style="width: 70%">
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>
						<?php if($type == 'unpaid'){echo "Balance";}else{echo "Amount";} ?>
					</th>
				</tr>
				<?php 
					$ctr = 1;
					$tot_amount = 0;
					foreach($data['students'] as $student){ ?>
						<tr>
							<td style="width: 10%"> <?php echo $ctr ?> </td>
							<td> <?php echo $student->name ?> </td>
							<td> <?php echo $student->amount ?> </td>
						</tr>
						<?php
						$tot_amount += $student->amount;
						++$ctr;
					}
				?>
				<tr>
					<td></td>
					<td><b>Total Amount:</b> </td>
					<td> <b> <?php echo $tot_amount; ?></b></td>
				</tr>
			</table>
			<?php
		}

	?>
	
	
</body>
</html>