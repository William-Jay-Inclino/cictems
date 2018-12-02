<section class="section">
	<div class="container">
		<h3 class="title is-3 my-title">My Classes</h3>
		<div class="box">
			<div class="table__wrapper">
				<table class="table is-fullwidth is-centered">
					<thead>
						<tr>
							<th style="text-align: left">Subject Code</th>
							<th style="text-align: left">Description</th>
							<th colspan="2">Units</th>
							<th>Days</th>
							<th>Time</th>
							<th>Room</th>
							<th>Faculty</th>	
						</tr>
						<tr>
							<td></td>
							<td></td>
							<th>Lec</th>
							<th>Lab</th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($data as $d){ ?>
								<tr>
									<td style="text-align: left"> <?php echo $d->subCode ?> </td>
									<td style="text-align: left"> <?php echo $d->subDesc ?> </td>
									<td> <?php echo $d->lec ?> </td>
									<td> <?php echo $d->lab ?> </td>
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
