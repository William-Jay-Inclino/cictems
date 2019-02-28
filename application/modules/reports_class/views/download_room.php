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
     		 background-color: #ffdd57 
   		}
   		table, td, th {  
		  border: 1px solid #ff3860;
		  text-align: center;
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
	<div style="font-size: 16px; text-align: center; color: #3273dc">
		<b>
		<?php 
			echo "ROOM SCHEDULES - College of ICT & Engineering<br>";
			echo "SY: ".$term->schoolYear." - ".$term->semDesc.'<br>';
			echo "As of ".$date_updated;
		?>
		</b>
	</div>
	<br><br>
	<?php 
		foreach($data as $d){ ?>
			<table>
				<tr>
					<th style="color: #3273dc; text-align: left">ROOM: </th>
					<th style="color: #3273dc; background-color: #ffdd57; text-align: left "> 
						<?php 
							if($d['roomName'] == ''){
								echo "Unassigned";
							}else{
								echo $d['roomName'];
							}
						?> 
					</th>
					<th colspan="4"></th>
				</tr>
				<tr class="tbl-headers">
					<th style="color: #ff3860; width: 20%">Course Code</th>
					<th style="color: #ff3860; width: 25%">Course Description</th>
					<th style="color: #ff3860; width: 10%;">Days</th>
					<th style="color: #ff3860; width: 15%;">Time</th>
					<th style="color: #ff3860; width: 15%;">Instructor</th>
					<th style="color: #ff3860; width: 15%;">Section</th>
				</tr>
				<?php 
					foreach($d['classes'] as $class){ ?>
						
						<tr>
							<td style="color: #3273dc;"> <?php echo $class->classCode ?> </td>
							<td style="color: #3273dc;"> <?php echo $class->subDesc ?> </td>
							<td style="color: #3273dc;"> <?php echo $class->day ?> </td>
							<td style="color: #3273dc;"> <?php echo $class->class_time ?> </td>
							<td style="color: #3273dc;"> 
								<?php 
									if($class->ln == ''){
										echo "<span style='color: #ff3860;'>Unassigned<span>";
									}else{
										echo $class->ln.', '.$class->fn; 	
									}
								?> 
							</td>
							<td style="color: #3273dc;"> <?php echo $class->secName ?> </td>
						</tr>
						<?php
						if($class->mergeClass){ ?>
							<tr>
								<td colspan="6" style="color: #ff3860; text-align: left"> <?php echo $class->mergeClass ?> </td>
							</tr>
							<?php
						}
					}
				?>
			</table>
			<br>
			<?php
		}
	?>
</body>
</html>