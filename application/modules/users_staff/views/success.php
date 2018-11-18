<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Username:</b></td>
					<td><?php echo $record->userName ?></td>
				</tr>
				<?php 
					if($record->is_new == 'yes'){ ?>
						<tr>
							<td><b>Code:</b></td>
							<td> <?php echo $record->userPass ?> </td>
						</tr>
						<?php
					}
				?>
				<tr>
					<td><b>Firstname:</b> </td>
					<td> <?php echo $record->fn ?> </td>
				</tr>
				<tr>
					<td><b>Middlename:</b> </td>
					<td> <?php echo $record->mn ?> </td>
				</tr>
				<tr>
					<td><b>Lastname:</b> </td>
					<td> <?php echo $record->ln ?> </td>
				</tr>
				<tr>
					<td><b>Birthdate:</b> </td>
					<td> <?php echo $record->dob ?> </td>
				</tr>
				<tr>
					<td><b>Sex:</b> </td>
					<td> <?php echo $record->sex ?> </td>
				</tr>
				<tr>
					<td><b>Address:</b> </td>
					<td> <?php echo $record->address ?> </td>
				</tr>
				<tr>
					<td><b>Contact number:</b> </td>
					<td> <?php echo $record->cn ?> </td>
				</tr>
				<tr>
					<td><b>Email:</b> </td>
					<td> <?php echo $record->email ?> </td>
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
		    		title: 'Staff successfully added!',
		    		add: '<?php echo base_url() ?>users/staff/form',
		    		edit: '<?php echo base_url()."users/staff/form/".$record->staffID ?>',
		    		list: '<?php echo base_url() ?>users/staff'
		    	},

		    }


		});


	}, false);

</script>

