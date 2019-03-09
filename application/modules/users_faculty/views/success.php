<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td colspan="2" style="color: darkgray">
						<span class="icon">
							<i class="fa fa-info-circle"></i>
						</span>
						<?php 
							if($mailStat == 'sent'){
								echo "Login details successfully sent to ".$record['facInfo']->email;
							}else{
								echo "Login details not sent";
							}
						?>
					</td>
				</tr>
				<tr>
					<td><b>Firstname:</b> </td>
					<td> <?php echo $record['facInfo']->fn ?> </td>
				</tr>
				<tr>
					<td><b>Middlename:</b> </td>
					<td> <?php echo $record['facInfo']->mn ?> </td>
				</tr>
				<tr>
					<td><b>Lastname:</b> </td>
					<td> <?php echo $record['facInfo']->ln ?> </td>
				</tr>
				<tr>
					<td><b>Birthdate:</b> </td>
					<td> <?php echo $record['facInfo']->dob ?> </td>
				</tr>
				<tr>
					<td><b>Sex:</b> </td>
					<td> <?php echo $record['facInfo']->sex ?> </td>
				</tr>
				<tr>
					<td><b>Address:</b> </td>
					<td> <?php echo $record['facInfo']->address ?> </td>
				</tr>
				<tr>
					<td><b>Contact number:</b> </td>
					<td> <?php echo $record['facInfo']->cn ?> </td>
				</tr>
				<tr>
					<td><b>Email:</b> </td>
					<td> <?php echo $record['facInfo']->email ?> </td>
				</tr>
				<tr>
					<td><b>Specialization:</b> </td>
					<td> <?php echo $record['facInfo']->special ?> </td>
				</tr>
				<tr>
					<td><b>Subjects:</b> </td>
					<td>
						<?php 
							foreach($record['specs'] as $spec){
								echo '<li>';
								echo $spec->specDesc;
								echo '</li>';
							}
						?> 
					</td>
				</tr>
				<tr>
					<td><b>Status:</b> </td>
					<td>
						<?php 
							if($record['facInfo']->status == 1){ ?>
								<span class="tag is-success">Active</span>
								<?php
							}else{ ?>
								<span class="tag is-danger">Inactive</span>
								<?php
							}
						?>
					</td>
				</tr>
			</table>
		</div>
		<div style="text-align: center">
			<a :href="page.add" class="button is-primary" style="width: 100px">Add New</a>
			<a :href="page.edit" class="button is-primary" style="width: 100px">Edit</a>
			<a :href="page.list" class="button is-primary" style="width: 100px">Go to list</a>
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
		    		title: 'Faculty successfully added!',
		    		add: '<?php echo base_url() ?>users/faculty/form',
		    		edit: '<?php echo base_url()."users/faculty/form/".$record['facInfo']->facID ?>',
		    		list: '<?php echo base_url() ?>users/faculty'
		    	},

		    }


		});


	}, false);

</script>

