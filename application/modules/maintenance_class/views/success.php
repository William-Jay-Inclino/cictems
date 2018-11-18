<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Term:</b> </td>
					<td> {{term}} </td>
				</tr>
				<tr>
					<td><b>Class code:</b> </td>
					<td> {{classCode}} </td>
				</tr>
				<tr>
					<td><b>Subject Description:</b> </td>
					<td> {{subDesc}} </td>
				</tr>
				<tr>
					<td><b>Prospectus:</b> </td>
					<td> {{prosCode}} </td>
				</tr>
				<tr>
					<td><b>Day:</b> </td>
					<td> {{dayDesc}} </td>
				</tr>
				<tr>
					<td><b>Time:</b> </td>
					<td> {{class_time}} </td>
				</tr>
				<tr>
					<td><b>Room:</b> </td>
					<td> {{roomName}} </td>
				</tr>
				<tr>
					<td><b>Section:</b> </td>
					<td> {{secName}} </td>
				</tr>
				<tr>
					<td><b>Faculty:</b> </td>
					<td> {{faculty}} </td>
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
		    	term: '<?php echo $record->term ?>',
		    	classCode: '<?php echo $record->classCode ?>',
		    	prosCode: '<?php echo $record->prosCode ?>',
		    	subDesc: '<?php echo $record->subDesc ?>',
		    	dayDesc: '<?php echo $record->dayDesc ?>',
		    	class_time: '<?php echo $record->class_time ?>',
		    	roomName: '<?php echo $record->roomName ?>',
		    	secName: '<?php echo $record->secName ?>',
		    	faculty: '<?php echo $record->faculty ?>',
		    	page:{
		    		title: 'Class successfully added!',
		    		add: '<?php echo base_url() ?>maintenance/class/form',
		    		edit: '<?php echo base_url()."maintenance/class/form/".$record->classID ?>',
		    		list: '<?php echo base_url() ?>maintenance/class'
		    	},

		    }


		});


	}, false);

</script>

