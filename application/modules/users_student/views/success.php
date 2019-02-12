<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Control No:</b> </td>
					<td> <?php echo $record->controlNo ?> </td>
				</tr>
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
					<td><b>Yearlevel:</b> </td>
					<td> <?php echo $record->yearDesc ?> </td>
				</tr>
				<tr>
					<td><b>Course:</b> </td>
					<td> <?php echo $record->courseCode ?> </td>
				</tr>
				<tr>
					<td><b>Prospectus:</b> </td>
					<td> <?php echo $record->prosCode ?> </td>
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
					<td> <?php echo '+63'.$record->cn ?> </td>
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
		    		title: 'Student successfully added!',
		    		add: '<?php echo base_url() ?>users/student/form',
		    		edit: '<?php echo base_url()."users/student/form/".$record->studID ?>',
		    		list: '<?php echo base_url() ?>users/student'
		    	},

		    }


		});


	}, false);

</script>

