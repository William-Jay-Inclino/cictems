<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report</title>
	
	<style>
		body {
		  font-size:14px;
		}
		.my-border{
			border: 1px solid black;
		}
   		table, td, th {  
		  border: 1px solid black;
		  text-align: center;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		}

		th, td {
		  padding: 10px;
		}
	</style>
</head>
<body>
	<img src="<?php echo base_url(); ?>assets/img/banner.png">
	<div style="text-align: center; font-size: 16px;">
		<b>
			CANDIDATE FOR <br>
			DEAN'S HONOR LIST <br>
			SY: <?php echo $term->schoolYear.' - '.$term->semDesc ?>
		</b>
	</div>
	<br>
	<table>
		<tr>
			<th>Name of Student</th>
			<th>Course & Year</th>
			<th>General Weighted Average (GWA)</th>
			<th>Percentage discount on Tuition</th>
		</tr>
		<?php 
			$i = 1;
			foreach($data as $d){ ?>
				<tr>
					<td> <?php echo $i.'. '.$d['student']->name ?> </td>
					<td> <?php echo $d['student']->courseCode.' - '.$d['student']->yearDesc; ?> </td>
					<td> <?php echo $d['gwa'] ?> </td>
					<td> <?php echo $d['discount'] ?> </td>
				</tr>
				<?php 
				++$i;
			}
		?> 
	</table>
</body>
</html>