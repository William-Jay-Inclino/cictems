<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-swatches/vue-swatches.min.css">
<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Subject Type:</b> </td>
					<td> <?php echo $record->specDesc ?> </td>
				</tr>
				<tr>
					<td><b>Prospectus:</b> </td>
					<td> <?php echo $record->prosCode ?> </td>
				</tr>
				<tr>
					<td><b>Color:</b> </td>
					<td> <swatches v-model="color" disabled></swatches> </td>
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
		Vue.component('swatches', window.VueSwatches.default)	
		new Vue({
		    el: '#app',
		    data: {
		    	page:{
		    		title: 'Specialization successfully added!',
		    		add: '<?php echo base_url() ?>maintenance/specialization/form',
		    		edit: '<?php echo base_url()."maintenance/specialization/form/".$record->specID ?>',
		    		list: '<?php echo base_url() ?>maintenance/specialization'
		    	},
		    	color: '<?php echo $record->specColor ?>'
		    }


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swatches/vue-swatches.min.js"></script>