<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Day:</b> </td>
					<td> <?php echo $record->dayDesc ?> </td>
				</tr>
				<tr>
					<td><b>No. of days:</b> </td>
					<td> <?php echo $record->dayCount ?> </td>
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
		    		title: 'Day successfully added!',
		    		add: '<?php echo base_url() ?>maintenance/day/form',
		    		edit: '<?php echo base_url()."maintenance/day/form/".$record->dayID ?>',
		    		list: '<?php echo base_url() ?>maintenance/day'
		    	},

		    }


		});


	}, false);

</script>

