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
   		.row-5{
	      width: 5%;
	   }
	   .row-10{
	      width: 5%;
	   }
	</style>
</head>
<body>
	<?php 
		echo "Name: ".$student->ln.', '.$student->fn.' '; if($student->mn){ echo $student->mn.'.';} 
	?>
	<br><br>
	<div style="text-align: center">
		<?php 
			echo "<b>WESTERN LEYTE COLLEGE OF ORMOC CITY, INC. <br>";
			echo "COLLEGE OF ICT & ENGINEERING</b>";

		?>
	</div>
	<br><br>
	
	<?php 
		foreach($data as $d){ ?>
			
			<table border="1">
				<tr>
					<th colspan="10"> <?php echo $d['term'] ?> </th>
				</tr>
				<tr class="tbl-headers">
		            <th class="row-10">Code</th>
                  <th class="row-10">Description</th>
                  <th class="row-10">Instructor</th>
                  <th class="row-5">PR</th>
                  <th class="row-5">MD</th>
                  <th class="row-5">SF</th>
                  <th class="row-5">F</th>
                  <th class="row-5">FG</th>
                  <th class="row-5">Equiv</th>
                  <th style="width: 10%">Remarks</th>
		        </tr>
				<?php 
					$total_rec = count($d['class2']) - 1;
					$ctr = 0;
					foreach($d['class2'] as $c){ ?>
						<tr <?php if($ctr == $total_rec){echo 'style="border: 1px solid black"';} ?>>
							<td class="row-10"> 
								<?php 
									echo $c['class']->classCode;
									if($c['class']->type == 'lab'){
										echo "<b>(lab)</b>";
									}
								?> 
							</td>
							<td> <?php echo $c['class']->subDesc ?> </td>
							<td> <?php echo $c['class']->faculty ?> </td>
							<td> <?php echo $c['class']->prelim ?> </td>
							<td> <?php echo $c['class']->midterm ?> </td>
							<td> <?php echo $c['class']->prefi ?> </td>
							<td> <?php echo $c['class']->final ?> </td>
							<td> <?php echo $c['class']->finalgrade ?> </td>
							<td> <?php echo $c['equiv'] ?> </td>
							<td> 
								<b>
								<?php 
									if($c['class']->remarks == 'Incomplete'){
										echo "INC";
									}else{
										echo $c['class']->remarks;
									}
								?> 
								</b>
							</td>
						</tr>
						<?php 
						++$ctr;
					}
				?>
								
			</table>

			<?php
		}
	?>

	

</body>
</html>