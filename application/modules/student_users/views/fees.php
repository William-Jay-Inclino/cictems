<section class="section">
	<div class="container">
		<h3 class="title is-3 my-title">My Fees</h3>
		<div class="box">
			<div class="table__wrapper">
				<table class="table is-fullwidth">
					<thead>
						<th>Fee Name</th>
						<th>Fee Amount</th>
						<th>Payable</th>
						<th>Receivable</th>
					</thead>
					<tbody>
						<?php 
							foreach($data as $d){ ?>
								<tr>
									<td> <?php echo $d->feeName ?> </td>
									<td> <?php echo $d->amount ?> </td>
									<td> <?php echo $d->payable ?> </td>
									<td> <?php echo $d->receivable ?> </td>
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
