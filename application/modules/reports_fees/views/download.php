<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
	<style>
		body {
		  font-size:12px;
		}
	</style>
</head>
<body>
	
	<img src="<?php echo base_url(); ?>assets/img/banner.png">

	<div class="has-text-centered">
			<b>LIST OF <?php echo strtoupper($type) ?> ACCOUNTS<br>
			S.Y <?php echo $data['term'] ?> <br>
			as of <?php echo date("F j, Y"); ?><br><br>
	</div>
	<br><br>
	
	<?php 

		if($type == 'paid'){ ?>
			<table class="table" style="width: 50%">
				<tr>
					<th>No.</th>
					<th>Name</th>
				</tr>
				<?php 
					$ctr = 1;
					foreach($data['students'] as $student){
						echo "<tr>";
							echo "<td>".$ctr."</td>";
							echo "<td>".$student->name."</td>";
						echo "</tr>";
						++$ctr;
					}
				?>
			</table>
			<?php
		}else{ ?>
			<table class="table" style="width: 70%">
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
							<td> <?php echo $ctr ?> </td>
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