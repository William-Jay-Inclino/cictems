<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Report</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
	<style>
		body {
		  font-size:12px;
		}
	</style>
</head>
<body>
	
	<img src="<?php echo base_url(); ?>assets/img/banner.png">

	<div class="has-text-centered">
		<?php 
			echo '<b>'.$data['prospectus']->description.' with G.R. #04 series of 2005'.'</b><br>'; 
			echo "Effective School Year ".$data['prospectus']->effectivity.' [K + 12] Compliant <br>';
			echo "Revised Curriculum No. 25 Series of 2015";
		?>
	</div>
	<br><br>
	
	<?php 
		foreach($data['subjects'] as $subjects){ ?>
			<table class="table" style="width: 100%">
				<caption style="text-align: left"> <?php echo $subjects['term'] ?> </caption>
				<tr>
					<th>Course Code</th>
					<th>Descriptive Title</th>
					<th>Units</th>
					<th>Pre-requisites / Remarks</th>
				</tr>
				<?php 
					foreach($subjects['subjects'] as $subject){ 
						echo "<tr>";
							echo "<td>";
								echo $subject['subject']->subCode.' ';
								if($subject['subject']->type == 'lab'){
									echo "<b>(lab)</b>";
								}
							echo "</td>";
							echo "<td>".$subject['subject']->subdesc."</td>";
							echo "<td>".$subject['subject']->units."</td>";
							echo "<td>";
								foreach($subject['sub_req'] as $sr){
									if($sr->req_type == 2){
										echo "Corequisite". $sr->req_code;
									}
									if($subject['subject']->year_req){
										echo $subject['subject']->year_req.' Standing';
									} 
									echo $subject['subject']->nonSub_pre;
								}
							echo "</td>";
						echo "</tr>";
					}
				?>
			</table>
			<br>
			<?php
		}
	?>

</body>
</html>