<style>
	.btn-width{
		width: 90px;
	}
	.my-fs{
		font-size: 14px;
	}
</style>

<section class="section">
	<div class="container">

		<div class="columns">
			<div class="column">
				<h5 class="title is-5 has-text-success">
					Section successfully created!
				</h5>
			</div>
			<div class="column">
				<div class="is-pulled-right">
					<a href="<?php echo base_url() ?>maintenance/class/form-batch" class="button is-primary btn-width"> Add New </a>
					<a href="<?php echo base_url() ?>maintenance/class/form-batch/<?php echo $record[0]->secID.'/'.$record[0]->termID ?>" class="button is-primary btn-width"> Edit </a>
					<a href="<?php echo base_url() ?>maintenance/class" class="button is-primary btn-width"> Go to list </a>
				</div>
			</div>
		</div>

		<div class="box">
			<div class="columns">
				<div class="column">
					<label class="label">Term</label>
					<p class="my-fs"> <?php echo $record[0]->term ?> </p>
				</div>
				<div class="column">
					<label class="label">Prospectus</label>
					<p class="my-fs"> <?php echo $record[0]->prosCode ?> </p>
				</div>
				<div class="column">
					<label class="label">Year</label>
					<p class="my-fs"> <?php echo $record[0]->yearDesc ?> </p>
				</div>
			</div>
		</div>
		<div class="box" v-show="ready">
			<div class="column is-4">
				<label class="label">Section</label>
				<p class="my-fs"> <?php echo $record[0]->secName ?> </p>
			</div>
			<hr>
			<table class="table is-fullwidth is-centered">
				<thead>
					<tr>
						<th width="10%">Code</th>
						<th width="25%">Description</th>
						<th width="20%">Time</th>
						<th width="10%">Day</th>
						<th width="15%">Room</th>
						<th width="20%">Instructor</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach($record as $r){ ?>
							<tr>
								<td> <?php echo $r->subCode ?> </td>
								<td> <?php echo $r->subDesc ?> </td>
								<td> <?php echo $r->class_time ?> </td>
								<td> <?php echo $r->dayDesc ?> </td>
								<td> <?php echo $r->roomName ?> </td>
								<td> <?php echo $r->faculty ?> </td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>

</section>