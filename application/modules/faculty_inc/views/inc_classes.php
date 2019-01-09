<style>
	.is-note{
       color: #9c9fa6
     }
</style>
<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a href="<?php echo base_url() ?>incomplete">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Classes</a></li>
		  </ul>
		</nav>
		<div class="box">
			<h5 class="title is-5">
				<table class="table">
					<tr>
						<td class="is-note">Name:</td>
						<td> <?php echo $record->name; ?> </td>
					</tr>
					<tr>
						<td class="is-note">Control No:</td>
						<td> <?php echo $record->controlNo; ?> </td>
					</tr>
				</table>
			</h5>
		</div>
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<th>Class Code</th>
					<th>Description</th>
					<th>School Year</th>
					<th>Semester</th>
					<th>Comply</th>
				</thead>
				<tbody>
					<?php 
						foreach ($classes as $class) { ?>		
							<tr>
								<td><?php echo $class->classCode ?></td>
								<td><?php echo $class->subDesc ?></td>
								<td><?php echo $class->schoolYear ?></td>
								<td><?php echo $class->semDesc ?></td>
								<td>
									<a href="<?php echo base_url().'inc-grades/completion/'.$class->classID.'/'.$studID.'/'.$class->termID ?>" class="button is-outlined is-primary"><i class="fa fa-angle-double-right fa-lg"></i></a>
								</td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>

</section>

