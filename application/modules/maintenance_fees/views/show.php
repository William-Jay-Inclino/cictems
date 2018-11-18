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
			<a :href="page.involved" class="button is-primary is-pulled-right">Manage Involved Students</a>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Term:</b> </td>
					<td> {{term.term}} </td>
				</tr>
				<tr>
					<td><b>Name of fee:</b> </td>
					<td> {{feeName}} </td>
				</tr>
				<tr>
					<td><b>Description:</b> </td>
					<td> {{feeDesc}} </td>
				</tr>
				<tr>
					<td><b>Amount:</b> </td>
					<td> {{amount}} </td>
				</tr>
				<tr>
					<td><b>Due Date:</b> </td>
					<td> {{dueDate}} </td>
				</tr>
				<tr>
					<td><b>Status:</b> </td>
					<td>
						<span v-if="feeStatus == 'ongoing'">
							<span class="tag is-link">On going</span>
						</span>
						<span v-else-if="feeStatus == 'done'">
							<span class="tag is-success">Done</span>
						</span>
						<span v-else>
							<span class="tag is-danger">Cancelled</span>
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
		    	id: '<?php echo $record->feeID ?>',
		    	term: {termID: '<?php echo $record->termID ?>', term: '<?php echo $record->term ?>'},
		    	feeName: '<?php echo $record->feeName ?>',
		    	feeDesc: '<?php echo $record->feeDesc ?>',
		    	amount: '<?php echo $record->amount ?>',
		    	dueDate: '<?php echo $record->dueDate ?>',
		    	feeStatus: '<?php echo $record->feeStatus ?>',
		    	page:{
		    		edit: '<?php echo base_url()."maintenance/fees/form/".$record->feeID ?>',
		    		list: '<?php echo base_url() ?>maintenance/fees',
		    		involved: '<?php echo base_url()."maintenance/fees/involved-students/".$record->feeID ?>'
		    	},
		    },
		    methods: {
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>maintenance_fees/is_safe_delete/' + id)
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
		        			swal("Unable to delete", "Fee has record in other modules!", "error")
		        		}
					 }, e => {
					 	console.log(e.body)
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>maintenance_fees/delete/'+id+'/'+this.term.termID)
		        	.then(response => {
		        		swal('Poof! record has been deleted!', {
					      icon: 'success',
					    }).then((x) => {
						  if (x) {
						    window.location.href = this.page.list
						  }
						})
					 }, e => {
					 	console.log(e.body)
					 })
		    	}
		    }


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

