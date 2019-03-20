<section class="section">
	<div class="container">
		<h3 class="title is-3 my-title">Grades (Prospectus)</h3>
		<div class="hero-body has-text-centered">
			<h4 class="title is-4"> <?php echo $data['prospectus']->description ?> </h4>
			<h5 class="subtitle is-5">Effectivity <?php echo $data['prospectus']->effectivity ?></h5>
		</div>
		<h5 class="subtitle is-5 has-text-centered">Curriculum Structure</h5>
		
		<?php 
			foreach($data['subjects'] as $subject){ ?>
				<div class="box">
	             <h6 class="title is-6">
	                <?php echo $subject['term'] ?>
	             </h6>
	             <hr>
	             <div class="table__wrapper">
		             <table class="table is-fullwidth is-bordered">
		                <thead>
		                   <th width="5%">Grade</th>
		                   <th width="15%">Subject Code</th>
		                   <th width="30%">Description</th>
		                   <th width="5%">Units</th>
		                   <th width="20%">Prerequisites</th>
		                   <th width="13%">School Year</th>
		                   <th width="12%">Semester</th>
		                </thead>
		                <tbody>
							<?php 

								foreach($subject['subjects'] as $row){
									if(!$row['subject']->term){
										$term = ['','',''];
									}else{
										$term = explode('|', $row['subject']->term); 
									}
									?>
									
									<tr>
										<th>
											<?php 
												if($row['subject']->grade == '0.0'){
													echo "INC";
												}else{
													echo $row['subject']->grade;
												}
											?>
										</th>
										<td> <?php echo $row['subject']->subCode ?> </td>
										<td> <?php echo $row['subject']->subDesc ?> </td>
										<td> <?php echo $row['subject']->units ?> </td>
										<td>
											<?php 
												foreach($row['sub_req'] as $sr){
													if($sr->req_type == 2){
														echo "Corequisite ";
													}
													echo $sr->req_code;
												}
												if($row['subject']->year_req){
													echo $row['subject']->year_req.' Standing';
												} 
												echo $row['subject']->nonSub_pre;
										 	?>
										</td>
										<td> <?php echo $term[1] ?> </td>
										<td> <?php echo $term[2] ?> </td>
									</tr>

									<?php
								}

							?>

		                </tbody>
		             </table>
	         	</div>
	          </div>
	          <br>
				<?php
			}
		?>

          

	</div>

</section>
