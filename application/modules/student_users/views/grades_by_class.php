<style>
	.tbl-headers{
      background-color: #f2f2f2 
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
						<table class="table is-fullwidth is-bordered">
							<tr class="tbl-headers">
								<th>Code</th>
			                    <th>Description</th>
			                    <th>Day</th>
			                    <th>Time</th>
			                    <th>Room</th>
			                    <th>Instructor</th>
			                    <th>PR</th>
			                    <th>MD</th>
			                    <th>SF</th>
			                    <th>F</th>
			                    <th>FG</th>
			                    <th>Equiv</th>
			                    <th>Remarks</th>
							</tr>
							<?php 
								foreach($c['class2'] as $cc){ ?>
									<td> <?php echo $cc['class']->classCode ?> </td>
									<td> <?php echo $cc['class']->subDesc ?> </td>
									<td> <?php echo $cc['class']->day ?> </td>
									<td> <?php echo $cc['class']->class_time ?> </td>
									<td> <?php echo $cc['class']->roomName ?> </td>
									<td> <?php echo $cc['class']->faculty ?> </td>
									<td> <?php echo $cc['class']->prelim ?> </td>
									<td> <?php echo $cc['class']->midterm ?> </td>
									<td> <?php echo $cc['class']->prefi ?> </td>
									<td> <?php echo $cc['class']->final ?> </td>
									<td> <?php echo $cc['class']->finalgrade ?> </td>
									<td> <?php echo $cc['equiv'] ?> </td>
									<td> <?php echo $cc['class']->remarks ?> </td>
									<?php
								}
							?>
						</table>
					</div>
				</div>
				<?php 
			}
		?>
	</div>

</section>
