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
			<button class="button is-danger" v-on:click="is_safe_delete" v-if="termStat == 'inactive'">
				<i class="fa fa-trash"></i>
			</button>
			<button class="button is-primary is-pulled-right" v-on:click="set_active" v-if="termStat == 'inactive'">Set Active</button>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>School Year:</b> </td>
					<td> {{schoolYear}} </td>
				</tr>
				<tr>
					<td><b>Semester:</b> </td>
					<td> {{semDesc}} </td>
				</tr>
				<tr>
					<td><b>Status:</b> </td>
					<td>
						<span v-if="termStat=='active'">
							<span class="tag is-success">Active</span>
						</span>
						<span v-else>
							<span class="tag is-danger">Inactive</span>
						</span>
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
		    	id: '<?php echo $record->termID ?>',
		    	termStat: '<?php echo $record->termStat ?>',
		    	schoolYear: '<?php echo $record->schoolYear ?>',
		    	semDesc: '<?php echo $record->semDesc ?>',
		    	page:{
		    		edit: '<?php echo base_url()."maintenance/term/form/".$record->termID ?>',
		    		list: '<?php echo base_url() ?>maintenance/term',
		    		show: '<?php echo base_url()."maintenance/term/show/".$record->termID ?>'
		    	},
		    },
		    methods: {
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>maintenance_term/is_safe_delete/' + id)
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
		        		}else if(c == 2){
		        			swal("Unable to delete", "Term is still active!", "error")
		        		}else{
		        			swal("Unable to delete", "Term has record in other modules!", "error")
		        		}
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>maintenance_term/delete/'+id)
		        	.then(response => {
		        		console.log(response.body);
		        		swal('Poof! record has been deleted!', {
					      icon: 'success',
					    }).then((x) => {
						  if (x) {
						    window.location.href = this.page.list
						  }
						})
					 }, e => {
					 	console.log(e.body);

					 });
		    	},
		    	set_active(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_term/set_active/'+this.id)
		        	.then(response => {
		        		// this.termStat = 'active'
		        		swal('Status successfully activated', {
					      icon: 'success',
					    })
					    .then((x) => {
					    	window.location.href = this.page.show
					    })
					 });
		    	}
		    }


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

