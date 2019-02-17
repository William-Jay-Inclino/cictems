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
			<?php echo $data['term'] ?> <br>
			as of <?php echo date("F j, Y"); ?><br><br>
	</div>
	<br><br>
	
	<?php 

		if($type == 'paid'){ ?>
			<table border="1">
				<tr class="tbl-headers">
					<th>No.</th>
					<th>Name of Student</th>
					<th>Course</th>
					<th>Year</th>
					<th>Fees Paid</th>
				</tr>
				<?php 
					$ctr = 1;
					$tot_amount = 0;
					foreach($data['students'] as $student){
						$tot_amount += $student['student']->amount;
						echo "<tr>";
							echo "<td style='width: 10%'>".$ctr."</td>";
							echo "<td>".$student['student']->name."</td>";
							echo "<td>".$student['student']->courseCode."</td>";
							echo "<td>".$student['student']->yearDesc."</td>";
							echo "<td>";
								$total_fees = count($student['fees']) - 1;
								$feeCtr = 0;
								foreach($student['fees'] as $fee){ 
									echo $fee->feeName.' ('.$fee->amount.')';
									if($total_fees != $feeCtr){
										echo ", ";
									}
									++$feeCtr;
								}
							echo "</td>";
						echo "</tr>";
						++$ctr;
					}
				?>
			</table>
			 <br>
			<b>Total Amount: </b> <?php echo $tot_amount; ?>
			<?php
		}else{ ?>
			<table border="1">
				<tr class="tbl-headers">
					<th>No.</th>
					<th>Name of Student</th>
					<th>Course</th>
					<th>Year</th>
					<th>
						<?php if($type == 'unpaid'){echo "Balance";}else{echo "Amount";} ?>
					</th>
					<th>Breakdown</th>
				</tr>
				<?php 
					$ctr = 1;
					$tot_amount = 0;
					foreach($data['students'] as $student){ ?>
						<tr>
							<td style="width: 10%"> <?php echo $ctr ?> </td>
							<td> <?php echo $student['student']->name ?> </td>
							<td> <?php echo $student['student']->courseCode ?> </td>
							<td> <?php echo $student['student']->yearDesc ?> </td>
							<td> <?php echo $student['student']->amount ?> </td>
							<td>
								<?php 
									$total_fees = count($student['fees']) - 1;
									$feeCtr = 0;
									foreach($student['fees'] as $fee){ 
										echo $fee->feeName.' ('.$fee->amount.')';
										if($total_fees != $feeCtr){
											echo ", ";
										}
										++$feeCtr;
									}
								?>
							</td>
						</tr>
						<?php
						$tot_amount += $student['student']->amount;
						++$ctr;
					}
				?>
			</table> <br>
			<b>Total Amount: </b> <?php echo $tot_amount; ?>
			<?php
		}

	?>
	
	
</body>
</html>