<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Grade Sheet</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
	<style>
		body {
		  font-size:12px;
		  padding: 0;
		  font-family: 'Raleway', sans-serif;
		  -webkit-font-smoothing: antialiased !important;
		}
		.is-centered th {
		    text-align: center;
		    vertical-align: middle;
		}
		.is-centered td {
		    text-align: center;
		    vertical-align: middle;
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
	<section class="hero has-text-centered">
		<div class="hero-body">
			<div class="container">
				<h1 class="title">
					WESTERN LEYTE COLLEGE
				</h1>
				<h2 class="subtitle">
					A. Bonifacio St., Ormoc City <br>
					Tel. Nos (053) 255-8549; 561-5310
				</h2>
			</div>
		</div>
	</section>

	<section class="section">
		<h2 class="subtitle has-text-centered">GRADE SHEET</h2>
		<br><br>
		
		<table class="is-centered" style="width: 100%;">
			<tr>
				<th><?php echo $data['class']->subCode ?></th>
				<th><?php echo $data['class']->subDesc ?></th>
				<td style="width: 15%"></td>
				<th><?php echo $data['sem'].'-' ?></th>
				<th><?php echo $data['sy'] ?></th>
			</tr>
			<tr>
				<td>Course Code</td>
				<td>Descriptive Title</td>
				<td></td>
				<td>Semester</td>
				<td>S.Y.</td>
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
						<td> <?php echo $student->equiv; ?> </td>
						<td> <?php echo $student->remarks; ?> </td>
					</tr>

					<?php ++$ctr;
				}

			?>
		</table>
		
		<br><br>
		
		<?php 
			$per = count($data['grades']) / 3;
			$r = $per + 1;
		?>

		<table class="table is-centered my-border">
			<tr>
				<th colspan="2">GRADING SYSTEM</th>
			</tr>

			<tr>
				<?php 
					$start = 0;
					$end = $per; 
					while(--$r >= 0){ 
						?>
						<td>
							<table>
								<?php 
								for($i = $start; $i <= $end; ++$i){ ?>
									<tr>
										<td> <?php echo $data['grades'][$i]['metric'] ?> </td>
										<td> <?php echo $data['grades'][$i]['grade'] ?> </td>
									</tr>
									<?php
								}
							?>
							</table>
						</td>
						<?php
						$start = $end;
						$end += $per;
					}
				?>
				
			</tr>

			
			
		</table>

	</section>
	
</body>
</html>