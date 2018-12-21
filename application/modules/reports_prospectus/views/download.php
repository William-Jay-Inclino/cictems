<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
	<style>
		body {
		  font-size:10px;
		}
		.my-border{
			border: 1px solid black;
		}
		/*.table td:last-child{
			border: 1px solid black;
			border-bottom: 1px;
		}*/
		.tbl-headers{
     		 background-color: #f2f2f2 
   		}
	</style>
</head>
<body>

	<div class="has-text-centered">
		<?php 
			echo "WESTERN LEYTE COLLEGE OF ORMOC CITY, INC. <br>";
			echo "<b>COLLEGE OF ICT & ENGINEERING</b><br><br>";
			echo '<b>'.$data['prospectus']->description.' with G.R. #04 series of 2005'.'</b><br>'; 
			echo "Effective School Year ".$data['prospectus']->effectivity.' [K + 12] Compliant <br>';
			echo "Revised Curriculum No. 25 Series of 2015";
		?>
	</div>
	<br><br>
	
	<?php 
		foreach($data['subjects'] as $subjects){ ?>
			<table class="table my-border" style="width: 100%">
				<tr>
					<th colspan="4"><?php echo $subjects['term'] ?></th>
				</tr>
				<tr class="tbl-headers">
					<th>Course Code</th>
					<th>Descriptive Title</th>
					<th>Units</th>
					<th>Pre-requisites</th>
				</tr>
				<?php 
					$total_sub = count($subjects['subjects']) - 1;
					$ctr = 0;
					foreach($subjects['subjects'] as $subject){  ?>
						<tr <?php if($ctr == $total_sub){echo 'style="border: 1px solid black"';} ?>>
							<td>
								<?php 
									echo $subject['subject']->subCode; 
									if($subject['subject']->type == 'lab'){
										echo "<b>(lab)</b>";
									}
								?>
							</td>
							<td><?php echo $subject['subject']->subDesc; ?></td>
							<td><?php echo $subject['subject']->units; ?></td>
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
	
	<table style="font-size: 8px; width: 100%">
		<tr>
			<td>
				<table>
					<tr>
						<td>Prepared by: </td>
						<td>
							<br>
							<?php echo $data2['populate']->name.'<br>'.$data2['populate']->description; ?>
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="table my-border" style="font-size: 9px;width: 100%">
					<tr>
						<th colspan="3" style="text-align: center">SUMMARY OF COURSES</th>
					</tr>
					<?php 
						$total_specs = count($data2['specializations']) - 1;
						$g = 0;
						foreach($data2['specializations'] as $spec){ ?>
							<tr <?php if($g == $total_specs){echo 'style="border: 1px solid black"';} ?>>
								<td> <?php echo $spec['specDesc'] ?> </td>
								<td> <?php echo $spec['total'] ?> </td>
								<td>units</td>
							</tr>
							<?php ++$g;
						}
					?>
				</table>
			</td>
		</tr>
	</table>

</body>
</html>