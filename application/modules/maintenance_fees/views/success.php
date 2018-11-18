<style>
	.my-btn{
		width: 100px;
	}
</style>

<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Term:</b> </td>
					<td> <?php echo $record->term ?> </td>
				</tr>
				<tr>
					<td><b>Fee:</b> </td>
					<td> <?php echo $record->feeName ?> </td>
				</tr>
				<tr>
					<td><b>Description:</b> </td>
					<td> <?php echo $record->feeDesc ?> </td>
				</tr>
				<tr>
					<td><b>Amount:</b> </td>
					<td> <?php echo $record->amount ?> </td>
				</tr>
				<tr>
					<td><b>Due date:</b> </td>
					<td> <?php echo $record->dueDate ?> </td>
				</tr>
				<tr>
					<td><b>Term:</b> </td>
					<td> 
						<?php 
							if($record->feeStatus == 'ongoing'){
								echo "<span class='tag is-link'>On going</span>";
							}else if($record->feeStatus == 'done'){
								echo "<span class='tag is-success'>Done</span>";
							}else{
								echo "<span class='tag is-danger'>Cancelled</span>";
							}
						?> 
					</td>
				</tr>
			</table>
		</div>
		<div style="text-align: center">
			<a :href="page.add" class="button is-primary my-btn">Add New</a>
			<a :href="page.edit" class="button is-primary my-btn">Edit</a>
			<a :href="page.list" class="button is-primary my-btn">Go to list</a>
			<a :href="page.involved" class="button is-primary my-btn">Add Involved</a>
		</div>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		new Vue({
		    el: '#app',
		    data: {
		    	page:{
		    		title: 'Fee successfully added!',
		    		add: '<?php echo base_url() ?>maintenance/fees/form',
		    		edit: '<?php echo base_url()."maintenance/fees/form/".$record->feeID ?>',
		    		list: '<?php echo base_url() ?>maintenance/fees',
		    		involved: '<?php echo base_url()."maintenance/fees/involved-students/".$record->feeID ?>'
		    	},

		    }


		});


	}, false);

</script>

