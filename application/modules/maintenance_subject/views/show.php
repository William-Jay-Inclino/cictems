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
					<td><b>Subject Code:</b> </td>
					<td> {{subCode}} </td>
				</tr>
				<tr>
					<td><b>Description:</b> </td>
					<td> {{subDesc}} </td>
				</tr>
				<tr>
					<td><b>Prospectus:</b> </td>
					<td> {{prosCode}} </td>
				</tr>
				<tr>
					<td><b>Lecture:</b> </td>
					<td> {{lec}} </td>
				</tr>
				<tr>
					<td><b>Laboratory:</b> </td>
					<td> {{lab}} </td>
				</tr>
				<tr>
					<td><b>Year:</b> </td>
					<td> {{yearDesc}} </td>
				</tr>
				<tr>
					<td><b>Semester:</b> </td>
					<td> {{semDesc}} </td>
				</tr>
				<tr>
					<td><b>Prerequisite:</b> </td>
					<td> 
						{{year_req}} &nbsp;
						<span v-if="reqs.length != 0" v-for="req in reqs">
							<span v-if="req.req_type == 1">
								{{req.req_code}} &nbsp;
							</span>
						</span>
					</td>
				</tr>
				<tr>
					<td><b>Corequisite:</b> </td>
					<td>
						<span v-if="reqs.length != 0" v-for="req in reqs">
							<span v-if="req.req_type == 2">
								{{req.req_code}}
							</span>
						</span>
					</td>
				</tr>
				<tr>
					<td><b>Type:</b> </td>
					<td> {{specDesc}} </td>
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
		    	id: '<?php echo $record->subID ?>',
		    	subCode: '<?php echo $record->subCode ?>',
		    	subDesc: '<?php echo $record->subDesc ?>',
		    	prosCode: '<?php echo $record->prosCode ?>',
		    	lec: '<?php echo $record->lec ?>',
		    	lab: '<?php echo $record->lab ?>',
		    	year_req: '<?php echo $record->year_req ?>',
		    	semDesc: '<?php echo $record->semDesc ?>',
		    	yearDesc: '<?php echo $record->yearDesc ?>',
		    	specDesc: '<?php echo $record->specDesc ?>',
		    	reqs: [],
		    	page:{
		    		edit: '<?php echo base_url()."maintenance/subject/form/".$record->subID ?>',
		    		list: '<?php echo base_url() ?>maintenance/subject'
		    	},
		    },
		    created(){
		    	this.fetch_requisites()
		    },	
		    methods: {
		    	fetch_requisites(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_requisites/'+this.id)
		        	.then(response => {
		        		console.log(response.body)
		        		this.reqs = response.body
					 })
		    	},
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/is_safe_delete/' + id)
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
		        			swal("Unable to delete", "Subject has record in other modules!", "error")
		        		}
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/delete/'+id)
		        	.then(response => {
		        		console.log(response.body)
		        		swal('Poof! record has been deleted!', {
					      icon: 'success',
					    }).then((x) => {
						  if (x) {
						    window.location.href = this.page.list
						  }
						})
					 })
		    	}
		    }


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

