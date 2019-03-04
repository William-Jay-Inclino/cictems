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
	<div style="text-align: center;">
		<?php 
			$with = '';
			if($data['prospectus']->prosDesc){
				$with = ' with ';
			}
			echo "<b>COLLEGE OF ICT & ENGINEERING</b><br><br>";
			echo '<b>'.$data['prospectus']->description.$with.$data['prospectus']->prosDesc.'</b><br>'; 
			echo "Effective School Year ".$data['prospectus']->effectivity.' [K + 12] Compliant <br>';
			echo "Revised Curriculum ".$data['prospectus']->prosDesc2.'<br>';
			echo "as of ".$data['prospectus']->updated_at;
		?>
	</div>
	<br><br>
	
	<?php 
		foreach($data['subjects'] as $subjects){ ?>
			<table border="1">
				<tr>
					<th colspan="6"><?php echo $subjects['term'] ?></th>
				</tr>
				<tr class="tbl-headers">
					<th style="width: 20%">Course Code</th>
					<th style="width: 30%">Descriptive Title</th>
					<th colspan="3" style="width: 30%; text-align: center">Units</th>
					<th style="width: 20%">Pre-requisites</th>
				</tr>
				<tr class="tbl-headers">
					<th></th>
					<th></th>
					<th style="text-align: center">lec</th>
					<th style="text-align: center">lab</th>
					<th style="text-align: center">total</th>
					<th></th>
				</tr>
				<?php 
					$total_sub = count($subjects['subjects']) - 1;
					$ctr = 0;
					foreach($subjects['subjects'] as $subject){  ?>
						<tr>
							<td style="color: <?php echo $subject['subject']->specColor ?>"><?php echo $subject['subject']->subCode; ?></td>
							<td style="color: <?php echo $subject['subject']->specColor ?>"><?php echo $subject['subject']->subDesc; ?></td>
							<td style="color: <?php echo $subject['subject']->specColor ?>; text-align: center"><?php echo $subject['lec']; ?></td>
							<td style="color: <?php echo $subject['subject']->specColor ?>; text-align: center"><?php echo $subject['lab']; ?></td>
							<td style="color: <?php echo $subject['subject']->specColor ?>; text-align: center"><?php echo $subject['subject']->total_units; ?></td>
							<td style="color: <?php echo $subject['subject']->specColor ?>">
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
						</tr>
						<?php
						++$ctr;
					}
				?>
				<tr>
					<td></td>
					<td></td>
					<th style="text-align: center" colspan="3">Total units: <?php echo $subjects['tot_units'] ?></th>
					<th></th>
				</tr>
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
								<td style="color: <?php echo $spec['specColor'] ?>"> <?php echo $spec['specDesc'] ?> </td>
								<td style="color: <?php echo $spec['specColor'] ?>"> 
									<?php 
										if($spec['total']){
											echo $spec['total']; 
										}else{
											echo "0";
										}
									?> 
								</td>
								<td style="color: <?php echo $spec['specColor'] ?>">units</td>
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