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
			<a :href="page.edit" class="button">
				<i class="fa fa-pencil"></i>
			</a>
			<button class="button is-danger" v-on:click="is_safe_delete">
				<i class="fa fa-trash"></i>
			</button>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Room:</b> </td>
					<td> {{rn}} </td>
				</tr>
				<tr>
					<td><b>Location:</b> </td>
					<td> {{loc}} </td>
				</tr>
				<tr>
					<td><b>Capacity:</b> </td>
					<td> {{cap}} </td>
				</tr>
				<tr>
					<th>Status: </th>
					<td>
						<span v-if="stat == 'active'">
							<span class="tag is-success">Active</span>
						</span>
						<span v-else>
							<span class="tag is-danger">Inactive</span>
						</span>
					</td>
				</tr>
				<tr>
					<th>Room usage: </th>
					<td>
						<?php foreach($record['specs'] as $spec): 
								
								echo $spec->specDesc.'<br>';
							
						 	  endforeach; ?>
					</td>
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
		    	id: '<?php echo $record['room']->roomID ?>',
		    	rn: '<?php echo $record['room']->roomName ?>',
		    	loc: '<?php echo $record['room']->roomLoc ?>',
		    	cap: '<?php echo $record['room']->capacity ?>',
		    	stat: '<?php echo $record['room']->status ?>',
		    	page:{
		    		edit: '<?php echo base_url()."maintenance/room/form/".$record['room']->roomID ?>',
		    		list: '<?php echo base_url() ?>maintenance/room'
		    	},
		    },
		    methods: {
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>maintenance_room/is_safe_delete/' + id)
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
		        			swal("Unable to delete", "Room has record in other modules!", "error")
		        		}
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>maintenance_room/delete/'+id)
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

