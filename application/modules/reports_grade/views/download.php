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
	<?php 
		echo "Name: ".$student->ln.', '.$student->fn.' '; if($student->mn){ echo $student->mn.'.';} 
	?>
	<br><br>
	<div style="text-align: center;">
		<?php 
			echo "<b>WESTERN LEYTE COLLEGE OF ORMOC CITY, INC. <br>";
			echo "COLLEGE OF ICT & ENGINEERING</b><br><br>";
			echo '<b>'.$data['prospectus']->description.' with G.R. #04 series of 2005'.'</b><br>'; 
			echo "Effective School Year ".$data['prospectus']->effectivity.' [K + 12] Compliant <br>';
			echo "Revised Curriculum No. 25 Series of 2015";
		?>
	</div>
	<br><br>
	
	<?php 
		foreach($data['subjects'] as $subjects){ ?>
			<table border="1">
				<tr>
					<th colspan="7"><?php echo $subjects['term'] ?></th>
				</tr>
				<tr class="tbl-headers">
					<th style="text-align: center; width: 6%">Grade</th>
					<th style="width: 15%">Course Code</th>
					<th style="width: 30%">Descriptive Title</th>
					<th style="text-align: center; width: 5%">Units</th>
					<th style="width: 15%">Pre-requisites</th>
					<th style="width: 14%">School Year</th>
					<th style="width: 15%">Semester</th>
				</tr>
				<?php 
					$total_sub = count($subjects['subjects']) - 1;
					$ctr = 0;
					foreach($subjects['subjects'] as $subject){  
							$x = ['','',''];
							if($subject['subject']->term){
								$x = explode('|',$subject['subject']->term);
							}
						?>
						<tr <?php if($ctr == $total_sub){echo 'style="border: 1px solid black"';} ?>>
							<td style="text-align: center">
								<?php 
									if($x[0] == 'Credit'){ ?>
										<img src="<?php echo base_url(); ?>assets/img/fa-check.png">
										<?php
									}else{
										if($subject['subject']->grade == '0.0'){
											echo "INC";
										}else{
											echo $subject['subject']->grade;
										}
									}
								?>
							</td>
							<td>
								<?php 
									echo $subject['subject']->subCode; 
									if($subject['subject']->type == 'lab'){
										echo "<b>(lab)</b>";
									}
								?>
							</td>
							<td><?php echo $subject['subject']->subDesc; ?></td>
							<td style="text-align: center"><?php echo $subject['subject']->units; ?></td>
							<td>
								<?php 
									foreach($subject['sub_req'] as $sr){
										if($sr->req_type == 2){
											echo "Corequisite ";
										}
										echo $sr->req_code;
									}
									if($subject['subject']->year_req){
										echo $subject['subject']->year_req.' Standing';
									} 
									echo $subject['subject']->nonSub_pre;
							 	?>
							</td>
							<td> <?php echo $x[1] ?> </td>
							<td> <?php echo $x[2] ?> </td>
						</tr>
						<?php
						++$ctr;
					}
				?>
			</table>
			<br>
			<?php
		}
	?>
	
	<table style="font-size: 8px;">
		<tr>
			<td width="40%">
				<table>
					<tr>
						<td>Prepared by: </td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<?php echo $data2['populate']->name.'<br>'.$data2['populate']->description; ?>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td style="text-align: right">
				<table style="font-size: 9px; width: 70%;" border="1">
					<tr class="tbl-headers">
						<th colspan="3" style="text-align: center">SUMMARY OF COURSES</th>
					</tr>
					<?php 
						$total_specs = count($data2['specializations']) - 1;
						$g = $total_units = 0;
						foreach($data2['specializations'] as $spec){ ?>
							<tr>
								<td> <?php echo $spec['specDesc'] ?> </td>
								<td> 
									<?php 
										if($spec['total']){
											echo $spec['total']; 
										}else{
											echo "0";
										}
									?> 
								</td>
								<td>units</td>
							</tr>
							<?php ++$g; $total_units += $spec['total'];
						}
					?>
					<tr style="border: 1px solid black">
						<th style="text-align: right">TOTAL:</th>
						<th> <?php echo $total_units; ?> </th>
						<th>UNITS</th>
					</tr>
				</table>
			</td>
		</tr>
	</table>

</body>
</html>