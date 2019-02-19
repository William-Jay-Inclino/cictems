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
		<b>
			LIST OF CANCELLED ACADEMIC ACTIVITIES <br>
			<?php echo 'SY '.$data['term']; ?> <br>
			as of <?php echo date("F j, Y"); ?><br><br>
		</b>
	</div>
	<br><br>
	
	<?php 

		foreach($data['fees'] as $fee){ ?>
			<table style="width: 100%">
				<tr>
					<td>
						<?php 
							echo '<b>'.$fee['fee']->feeName.'</b>'; 
							if($fee['fee']->trans_feeID != 0){
								echo " transferred to <b>".$fee['fee']->trans_feeName.'</b>';
							}
						?>
					</td>
					<th style="text-align: right">
						<?php echo $fee['fee']->date_cancelled; ?>
					</th>
				</tr>
			</table>
			<br>
			<table border="1" style="width: 100%">
				<tr class="tbl-headers">
					<th width="5%" style="text-align: center">#</th>
					<th width="31%">Name of Student</th>
					<th width="16%">Course</th>
					<th width="16%">Year</th>
					<th width="16%">Amount</th>
					<th width="16%">OR #</th>
				</tr>
				<?php 
					$ctr = 1;
					foreach($fee['students'] as $s){ ?>
						<tr>
							<td style="text-align: center"> <?php echo $ctr; ?> </td>
							<td> <?php echo $s->name; ?> </td>
							<td> <?php echo $s->courseCode; ?> </td>
							<td> <?php echo $s->yearDesc; ?> </td>
							<td> <?php echo $s->amount; ?> </td>
							<td> <?php echo $s->or_number; ?> </td>
						</tr>
						<?php
						++$ctr;
					}
				?>
			</table>
			<br><br>
			<?php
		}

	?>

</body>
</html>