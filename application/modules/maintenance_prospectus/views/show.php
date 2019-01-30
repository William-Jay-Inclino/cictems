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
					<td><b>Prospectus Code:</b> </td>
					<td> {{pc}} </td>
				</tr>
				<tr>
					<td><b>Course:</b> </td>
					<td> {{course}} </td>
				</tr>
				<tr>
					<td><b>CMO #:</b> </td>
					<td> {{desc}} </td>
				</tr>
				<tr>
					<td><b>Effectivity:</b> </td>
					<td> {{effect}} </td>
				</tr>
				<tr>
					<td><b>duration:</b> </td>
					<td> {{duration}} </td>
				</tr>
				<tr>
					<td><b>Type:</b> </td>
					<td> {{type}} </td>
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
		    	id: '<?php echo $record->prosID ?>',
		    	pc: '<?php echo $record->prosCode ?>',
		    	desc: '<?php echo $record->prosDesc ?>',
		    	course: '<?php echo $record->courseCode ?>',
		    	effect: '<?php echo $record->effectivity ?>',
		    	duration: '<?php echo $record->duration ?>',
		    	type: '<?php echo $record->prosType ?>',
		    	page:{
		    		edit: '<?php echo base_url()."maintenance/prospectus/form/".$record->prosID ?>',
		    		list: '<?php echo base_url() ?>maintenance/prospectus'
		    	},
		    },
		    methods: {
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>maintenance_prospectus/is_safe_delete/' + id)
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
		        			swal("Unable to delete", "Prospectus has record in other modules!", "error")
		        		}
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>maintenance_prospectus/delete/'+id)
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

