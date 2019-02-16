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

		.table {
		  border-collapse: collapse;
		  width: 100%;
		}

		th, td {
		  padding: 3px;
		}
		.myhr{
			width: 55%; height: 1px; color: black
		}
	</style>
</head>
<body>
	<img src="<?php echo base_url(); ?>assets/img/banner.png">
		<div style="text-align: center">
			<?php 
			echo "<b>Report Card ".$data['term']."</b><br>"; 
			echo "as of ".date("F j, Y");
			?>
		</div>
	<br><br>
	<table style="width: 65%">
		<tr>
			<td>
				<?php 
					echo '<b>Name:</b> '.$student->ln.', '.$student->fn.' '; if($student->mn){ echo $student->mn.'.';}
				?>
			</td>
			<td>
				<?php 
					echo '<b>Course:</b> '.$student->courseCode;
				?>
			</td>
			<td>
				<?php 
					echo '<b>Year:</b> '.$student->yearDesc;
				?>
			</td>
		</tr>
	</table>
	<br>
	
			
	<table border="1" class="table">
		<tr class="tbl-headers">
           <th>Subject</th>
          <th>Instructor</th>
          <th>Final Grade</th>
          <th>Units Earned</th>
        </tr>
		<?php 
		//grade * unit then add tanan divide no. of units
			$gwa = 0;
			$total_units = 0;
			$arr = [];
			foreach($data['class'] as $c){ ?>
				<tr>
					<td> <?php echo $c['class']->classCode;?> </td>
					<td> <?php echo $c['class']->faculty ?> </td>
					<td> <?php echo $c['equiv'] ?> </td>
					<td> <?php echo $c['class']->units ?> </td>
				</tr>
				<?php
				$total_units += $c['class']->units;
				$x = $c['equiv'] * $c['class']->units;
				$arr[] = $x;
			}
		?>	
	</table>
	<?php 
		$y = array_sum($arr);
		$gwa = $y / $total_units;
	?>
	<br>
	<b>GWA:</b> <?php echo $gwa; ?> 
	<br><br><br><br><br>

	<table style="width: 100%;">
		<tr>
			<td style="text-align: center">
				<?php echo $data['releasedby']; ?> <br>
				<hr class="myhr">
				<b>RELEASED BY</b>
			</td>
			<td style="text-align: center">
				<?php echo date("Y/m/d"); ?> <br>
				<hr class="myhr">
				<b>DATE RELEASED</b>
			</td>
		</tr>
	</table>


	

</body>
</html>