<div id="app" v-cloak>
<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Show</a></li>
		  </ul>
		</nav>
	</div>
	<div class="container" style="max-width: 600px;">
		<div class="box">
			<a class="button" :href="page.edit">
				<i class="fa fa-pencil"></i>
			</a>
			<button class="button is-danger" v-on:click="is_safe_delete">
				<i class="fa fa-trash"></i>
			</button>
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
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		new Vue({
		    el: '#app',
		    data: {
		    	id: '<?php echo $record->classID ?>',
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
		    		edit: '<?php echo base_url()."maintenance/class/form/".$record->classID ?>',
		    		list: '<?php echo base_url() ?>maintenance/class'
		    	},
		    },
		    methods: {
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>maintenance_class/is_safe_delete/' + id)
		        	.then(response => {
		        		const c = response.body
		        		if(c == 1){
		        			swal({
							  title: "Are you sure?",
							  text: "Once deleted, you will not be able to recover this record!",
							  icon: "warning",
							  buttons: {
							  	cancel: true,
							  	confirm: {
							  		closeModal: false
							  	}
							  },
							  dangerMode: true
							})
							.then((willDelete) => {
							  if (willDelete) {
							    this.deleteRec(id)
							  }
							})
		        		}else{
		        			swal("Unable to delete", "Class has record in other modules!", "error")
		        		}
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>maintenance_class/delete/'+id)
		        	.then(response => {
		        		swal('Poof! record has been deleted!', {
					      icon: 'success',
					    }).then((x) => {
						  if (x) {
						    window.location.href = this.page.list
						  }
						})
					 });
		    	}
		    }


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

