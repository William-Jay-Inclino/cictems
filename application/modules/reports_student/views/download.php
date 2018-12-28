<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report</title>
	<style>
		body {
		  font-size:12px;
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
			<b>LIST OF ENROLLED STUDENTS <?php if($data['courseCode']){echo "(".$data['courseCode'].")";} ?> <br>
			<?php 
				if($data['faculty']){
					echo "of ".$data['faculty']->name;
					if($data['faculty']->mn){
						echo " ".$data['faculty']->mn.". ";
					}
				}
				if($data['subCode']){echo "in ".$data['subCode']." <br>";} 
			?>
			S.Y <?php echo $data['term'] ?> <br>
			as of <?php echo date("F j, Y"); ?><br><br>
	</div>
	<br><br>
	
	<table class="table" style="width: 100%">
		<tr>
			<th>No.</th>
			<th>Name</th>
			<?php if($course == 'all-courses'){
				echo "<th>Course</th>";
			} ?>
			<th>Year</th>
		</tr>
		<?php 
			$ctr = 1;
			foreach($data['students'] as $student){ ?>
				<tr>
					<td><?php echo $ctr; ?></td>
					<td><?php echo $student->name; ?></td>
					<?php  
						if($course == 'all-courses'){
							echo "<td>".$student->courseCode."</td>";
						}
					?>
					<td><?php echo $student->yearDesc; ?></td>
				</tr>

				<?php ++$ctr;
			}
		?>
	</table>

	
</body>
</html>