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
			<b>
				Midterm Grades <br>
				<?php 
				echo 'SY '.$data['term']."<br>"; 
				echo "as of ".date("F j, Y");
				?>
			</b>
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
           <th>Code</th>
          <th>Description</th>
          <th style="text-align: center;">Units</th>
          <th>Instructor</th>
          <th>Grade</th>
        </tr>
		<?php 
			foreach($data['class'] as $c){ ?>
				<tr>
					<td> 
						<?php 
							echo $c['class']->classCode;
						?> 
					</td>
					<td> <?php echo $c['class']->subDesc ?> </td>
					<td style="text-align: center"> <?php echo $c['class']->units ?> </td>
					<td> <?php echo $c['class']->faculty ?> </td>
					<td> <?php echo $c['class']->midterm ?> </td>
				</tr>
				<?php
			}
		?>
						
	</table>

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