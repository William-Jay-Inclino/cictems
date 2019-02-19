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
			<b>LIST OF ENROLLED STUDENTS <br>
			<?php 
				if($data['course']){
					echo $data['course'].'<br>';
				} 
				if($data['yearDesc']){
					echo $data['yearDesc'].'<br>';
				} 
				if($data['faculty']){
					echo $data['faculty']->name;
					if($data['faculty']->mn){
						echo " ".$data['faculty']->mn.".";
					}
					echo "<br>";
				}
				if($data['subCode']){echo $data['subCode']." <br>";} 
			?>
			S.Y <?php echo $data['term'] ?> <br>
			as of <?php echo date("F j, Y"); ?><br><br>
	</div>
	<br><br>
	<table>
		<tr>
			<th style="width: 5%">No.</th>
			<th style="width: 30%">Name of Student</th>
			<?php if($course == 'all-courses'){
				echo "<th>Course</th>";
			} ?>
			<?php if($year == 'all-years'){
				echo "<th>Year</th>";
			} ?>
			<th>Gender</th>
			<th>Birth date</th>
			<th style="width: 30%">Address</th>
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
					<?php  
						if($year == 'all-years'){
							echo "<td>".$student->yearDesc."</td>";
						}
					?>
					<td>
						<?php if($student->sex == 'Male'){
							echo "M";
						}else{
							echo "F";
						} ?>
					</td>
					<td> <?php echo $student->dob; ?> </td>
					<td> <?php echo $student->address; ?> </td>
				</tr>
				
				<?php ++$ctr;
			}
		?>
		<tr> <td>&nbsp;</td> </tr>
		<tr>
			<td colspan="6">
				<b>Total no. of Enrolled Students: </b><?php echo $ctr; ?>
			</td>
		</tr>
	</table>

	
</body>
</html>