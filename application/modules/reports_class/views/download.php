<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
	
	<style>
		body {
		  font-size:10px;
		}
		.my-border{
			border: 1px solid black;
		}
		.tbl-headers{
     		 background-color: #ffdd57 
   		}
   		table, td, th {  
		  border: 1px solid #ff3860;
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
	<div class="has-text-centered has-text-link" style="font-size: 16px;">
		<b>
		<?php 
			echo "CLASS SCHEDULE - College of ICT & Engineering<br>";
			echo "SY: ".$term->schoolYear." - ".$term->semDesc.'<br>';
			echo "As of ".date("F j, Y");
		?>
		</b>
	</div>
	<br><br>
	<?php 
		foreach($data as $d){ ?>
			<table>
				<tr>
					<th style="color: #3273dc">SECTION: </th>
					<th style="color: #3273dc; background-color: #ffdd57 "> <?php echo $d['secName'] ?> </th>
					<th colspan="4"></th>
				</tr>
				<tr class="tbl-headers">
					<th style="color: #ff3860; width: 15%">Course Code</th>
					<th style="color: #ff3860; width: 20%">Course Description</th>
					<th style="color: #ff3860; width: 10%; text-align: center">Days</th>
					<th style="color: #ff3860; width: 20%; text-align: center">Time</th>
					<th style="color: #ff3860; width: 15%; text-align: center">Room</th>
					<th style="color: #ff3860; width: 20%; text-align: center">Instructor</th>
				</tr>
				<?php 
					foreach($d['classes'] as $class){ ?>
						
						<tr>
							<td style="color: #3273dc;"> <?php echo $class->classCode ?> </td>
							<td style="color: #3273dc;"> <?php echo $class->subDesc ?> </td>
							<td style="color: #3273dc; text-align: center"> <?php echo $class->day ?> </td>
							<td style="color: #3273dc; text-align: center"> <?php echo $class->class_time ?> </td>
							<td style="color: #3273dc; text-align: center"> <?php echo $class->roomName ?> </td>
							<td style="color: #3273dc; text-align: center"> <?php echo $class->faculty ?> </td>
						</tr>

						<?php
					}
				?>
			</table>
			<br>
			<?php
		}
	?>
</body>
</html>