<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Grade Sheet</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
	<style>
		body {
		  font-size:12px;
		  /*padding: 0;
		  font-family: 'Raleway', sans-serif;
		  -webkit-font-smoothing: antialiased !important;*/
		}
		.is-centered th {
		    text-align: center;
		    vertical-align: middle;
		}
		.is-centered td {
		    text-align: center;
		}
		.my-border{
			border: 1px solid black;
		}
		.table td{
			border: 1px solid black;
			border-bottom: 1px;
		}
	</style>
</head>
<body>

	<!-- <section class="section"> -->
		<div class="has-text-centered">
				<b>WESTERN LEYTE COLLEGE<br>
				A. Bonifacio St., Ormoc City <br>
				Tel. Nos (053) 255-8549; 561-5310<br><br>
				GRADE SHEET</b>
		</div>
		<br>
		<table style="width: 100%;">
			<tr>
				<th><?php echo $data['class']->subCode ?></th>
				<th><?php echo $data['class']->subDesc ?></th>
				<th><?php echo $data['sem'].' ' ?></th>
				<th><?php echo $data['sy'] ?></th>
			</tr>
			<tr>
				<td>Course Code</td>
				<td>Descriptive Title</td>
				<td>Semester</td>
				<td>S.Y</td>
			</tr>
		</table>
		<br><br>

		<table class="table is-centered my-border" style="width: 100%;">
			<tr>
				<th>No.</th>
				<th style="text-align: left">Student's Name</th>
				<th>Prelim</th>
				<th>Midterm</th>
				<th>SFinal</th>
				<th>Final</th>
				<th colspan="2">Final Grade</th>
				<th>REMARKS</th>	
			</tr>
			<?php 
				$ctr = 1;
				foreach($data['students'] as $student){ ?>
					
					<tr>
						<td> <?php echo $ctr; ?> </td>
						<td style="text-align: left"> <?php echo $student->name; ?> </td>
						<td> <?php echo $student->prelim; ?> </td>
						<td> <?php echo $student->midterm; ?> </td>
						<td> <?php echo $student->prefi; ?> </td>
						<td> <?php echo $student->final; ?> </td>
						<td> <?php echo $student->finalgrade; ?> </td>
						<td> 
							<?php 
								if(($student->equiv == NULL || $student->equiv == '') && $student->remarks != 'INCOMPLETE'){
									echo "5.0";
								}else{
									echo $student->equiv;
								} 
							?> 
						</td>
						<td> <?php echo $student->remarks; ?> </td>
					</tr>

					<?php ++$ctr;
				}

			?>
		</table>
		
		
		<?php 
			$tot = count($data['grades']);
			$per = 3;
			$per_row = $tot / 3;
			$start = 0;
			$end = 10; 
		?>
		
		<table class="table">
			<tr>
				<th colspan="3" style="text-align: left">GRADING SYSTEM</th>
			</tr>

			<tr>
				<?php 
					while(--$per >= 0){ ?>
						<td>
							<table>
								<?php 
									for($i = $start; $i < $end; ++$i){ 
										if($i < $tot){
											?>
											<tr>
												<th> <?php echo $data['grades'][$i]['metric'] ?> </th>
												<td> <?php echo $data['grades'][$i]['grade'] ?> </td>
											</tr>
											<?php	
										}
										
									}	

									if($per == 0){ ?>	
										<tr>
											<th>5.0</th>
											<td>Failed</td>
										</tr>
										<tr>
											<th>INC</th>
											<td>Incomplete</td>
										</tr>
										<?php
									}

								?>
								
							</table>	
						</td>
						<?php
						$start = $end;
						$end = $end + 10;
					}
				?>
				
			</tr>
		</table>
		<table class="table" style="width: 100%">
			<tr>
				<td style="text-align: right">Submitted by:</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php echo $data['class']->faculty; ?> <br>
					College Instructor
				</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php 
						echo  "Mrs. Cheryl M. Tarre, DBA (cand)";
					?>
					<br>Dean
				</td>
				<td>
					<?php echo "Ms. Maricel Salibongcogon" ?> <br>
					College Registrar
				</td>
			</tr>
		</table>
<!-- 	</section> -->
	
</body>
</html>