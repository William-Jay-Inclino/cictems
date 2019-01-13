<section class="section">
	<div class="container">
		<h3 class="title is-3 my-title">My Classes</h3>
		<div class="box">
			<div class="table__wrapper">
				<table class="table is-fullwidth">
					<thead>
						<tr>
							<th>Subject Code</th>
							<th>Description</th>
							<th>Units</th>
							<th>Days</th>
							<th>Time</th>
							<th>Room</th>
							<th>Faculty</th>	
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data as $d){ ?>
								<tr>
									<td> 
										<?php 
											echo $d->subCode ;
											if($d->type == 'lab'){echo "<b>(lab)</b>";}
										?> 
									</td>
									<td> <?php echo $d->subDesc ?> </td>
									<td> <?php echo $d->units ?> </td>
									<td> <?php echo $d->dayDesc ?> </td>
									<td> <?php echo $d->class_time ?> </td>
									<td> <?php echo $d->roomName ?> </td>
									<td> <?php echo $d->faculty ?> </td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</section>
