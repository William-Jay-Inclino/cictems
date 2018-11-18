<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Prospectus Code:</b> </td>
					<td> <?php echo $record->prosCode ?> </td>
				</tr>
				<tr>
					<td><b>Description:</b> </td>
					<td> <?php echo $record->prosDesc ?> </td>
				</tr>
				<tr>
					<td><b>Course Code:</b> </td>
					<td> <?php echo $record->courseCode ?> </td>
				</tr>
				<tr>
					<td><b>Duration:</b> </td>
					<td> <?php echo $record->duration ?> </td>
				</tr>
				<tr>
					<td><b>Effectivity:</b> </td>
					<td> <?php echo $record->effectivity ?> </td>
				</tr>
				<tr>
					<td><b>Type:</b> </td>
					<td> <?php echo $record->prosType ?> </td>
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
		    		title: 'Prospectus successfully added!',
		    		add: '<?php echo base_url() ?>maintenance/prospectus/form',
		    		edit: '<?php echo base_url()."maintenance/prospectus/form/".$record->prosID ?>',
		    		list: '<?php echo base_url() ?>maintenance/prospectus'
		    	},

		    }


		});


	}, false);

</script>

