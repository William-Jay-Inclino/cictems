<style>
	.tbl-headers{
      background-color: #f2f2f2 
   }
   .table td {border: none !important;}
   .table tr:last-child{
	  border-bottom: solid 1px #ccc !important;
	} 
</style>
<section class="section">
	<div class="container">
		<h3 class="title is-3 my-title">Grades (Class)</h3>
		<?php 
			foreach($data as $c){ ?>
				<div class="box">
					<h6 class="title is-6"> <?php echo $c['term']; ?> </h6>
					<hr>
					<?php foreach($c['class2'] as $cc): ?>
						
						<div class="table__wrapper">
							<table class="table is-fullwidth">
								<tr class="tbl-headers">
									<!-- <th width="15%" rowspan="5" style="text-align: center; vertical-align: middle; background-color: white">
										<?php echo $cc['class']->classCode ?>
									</th> -->
									<th width="16.66%">Course code</th>
				                    <th width="16.66%">Description</th>
				                    <th width="16.66%">Day</th>
				                    <th width="16.66%">Time</th>
				                    <th width="16.66%">Room</th>
				                    <th width="16.66%">Instructor</th>
								</tr>
								<tr>
									<td> <?php echo $cc['class']->classCode ?> </td>
									<td> <?php echo $cc['class']->subDesc ?> </td>
									<td> <?php echo $cc['class']->day ?> </td>
									<td> <?php echo $cc['class']->class_time ?> </td>
									<td> 
										<?php 
											if($cc['class']->roomID == 0){
												echo "<span style='color: #ff3860;'>Unassigned<span>";
											}else{
												echo $cc['class']->roomName;	
											}
										?> 
									</td>
									<td> 
										<?php 
											if($cc['class']->facID == 0){
												echo "<span style='color: #ff3860;'>Unassigned<span>";
											}else{
												echo $cc['class']->ln.', '.$cc['class']->fn; 	
											}
										?> 
									</td>
								</tr>
								<tr class="tbl-headers">
									<th>Prelim</th>
				                     <th>Midterm</th>
				                     <th>Prefi</th>
				                     <th>Finals</th>
				                     <th>Final Grade</th>
				                     <th>Remarks</th>
								</tr>
								<tr>
									<td> <?php echo $cc['class']->prelim ?> &nbsp; </td>
									<td> <?php echo $cc['class']->midterm ?> </td>
									<td> <?php echo $cc['class']->prefi ?> </td>
									<td> <?php echo $cc['class']->final ?> </td>
									<td> <?php echo $cc['class']->finalgrade ?> </td>
									<td> <?php echo $cc['equiv'] ?> </td>
									<td> <?php echo $cc['class']->remarks ?> </td>
								</tr>
							</table>
						</div>
					<?php endforeach ?>
					
				</div>
				<?php 
			}
		?>
	</div>

</section>
