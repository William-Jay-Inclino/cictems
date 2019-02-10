<style>
	.tbl-headers{
      background-color: #f2f2f2 
   }
   /*.table td {border: none !important;}
   .table tr:last-child{
	  border-bottom: solid 1px #ccc !important;
	} */
	.row-5{
      width: 5%;
   }
   .row-10{
      width: 5%;
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
					<div class="table__wrapper">
						<table class="table is-fullwidth is-bordered is-centered">
							<thead>
								<tr class="tbl-headers">
					                <th class="row-10" style="text-align: left">Code</th>
					                <th class="row-10" style="text-align: left">Description</th>
					                <th class="row-10" style="text-align: left">Instructor</th>
					                <th class="row-5">PR</th>
					                <th class="row-5">MD</th>
					                <th class="row-5">SF</th>
					                <th class="row-5">F</th>
					                <th class="row-5">FG</th>
					                <th class="row-5">Equiv</th>
					                <th class="row-10">Remarks</th>
					            </tr>
							</thead>
							<tbody>
								<?php 
								foreach($c['class2'] as $cc){ ?>
									<tr>
										<td style="text-align: left"> 
											<?php 
												echo $cc['class']->classCode;
												if($cc['class']->type == 'lab'){
													echo "<b>(lab)</b>";
												}
											?> 

										</td>
										<td style="text-align: left"> <?php echo $cc['class']->subDesc ?> </td>
										<td style="text-align: left"> 
											<?php 
												if($cc['class']->facID == 0){
													echo "<span style='color: #ff3860;'>Unassigned<span>";
												}else{
													echo $cc['class']->ln.', '.$cc['class']->fn; 	
												}
											?> 
										</td>
										<td> <?php echo $cc['class']->prelim ?> &nbsp; </td>
										<td> <?php echo $cc['class']->midterm ?> </td>
										<td> <?php echo $cc['class']->prefi ?> </td>
										<td> <?php echo $cc['class']->final ?> </td>
										<td> <?php echo $cc['class']->finalgrade ?> </td>
										<td> <?php echo $cc['equiv'] ?> </td>
										<td> <?php echo $cc['class']->remarks ?> </td>
									</tr>
									
									<?php
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
				
				<?php
			}
		?>
		
		
	</div>

</section>
