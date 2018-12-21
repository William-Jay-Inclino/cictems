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
			<a :href="page.credit" class="button is-primary is-pulled-right">Credit Subjects</a>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Role: </b></td>
					<td>Student</td>
				</tr>
				<tr>
					<td><b>Control No:</b> </td>
					<td> {{controlNo}} </td>
				</tr>
				<tr>
					<td><b>Firstname:</b> </td>
					<td> {{fn}} </td>
				</tr>
				<tr>
					<td><b>Middlename:</b> </td>
					<td> {{mn}} </td>
				</tr>
				<tr>
					<td><b>Lastname:</b> </td>
					<td> {{ln}} </td>
				</tr>
				<tr>
					<td><b>Yearlevel:</b> </td>
					<td> {{yearDesc}} </td>
				</tr>
				<tr>
					<td><b>Course:</b> </td>
					<td> {{courseCode}} </td>
				</tr>
				<tr>
					<td><b>Prospectus:</b> </td>
					<td> {{prosCode}} </td>
				</tr>
				<tr>
					<td><b>Birthdate:</b> </td>
					<td> {{dob}} </td>
				</tr>
				<tr>
					<td><b>Sex:</b> </td>
					<td> {{sex}} </td>
				</tr>
				<tr>
					<td><b>Address:</b> </td>
					<td> {{address}} </td>
				</tr>
				<tr>
					<td><b>Contact number:</b> </td>
					<td> {{cn}} </td>
				</tr>
				<tr>
					<td><b>Email:</b> </td>
					<td> {{email}} </td>
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
		    	id: '<?php echo $record->studID ?>',
		    	controlNo: '<?php echo $record->controlNo ?>',
		    	fn: '<?php echo $record->fn ?>',
		    	mn: '<?php echo $record->mn ?>',
		    	ln: '<?php echo $record->ln ?>',
		    	courseCode: '<?php echo $record->courseCode ?>',
		    	prosCode: '<?php echo $record->prosCode ?>',
		    	yearDesc: '<?php echo $record->yearDesc ?>',
		    	address: '<?php echo $record->address ?>',
		    	dob: '<?php echo $record->dob ?>',
		    	sex: '<?php echo $record->sex ?>',
		    	cn: '<?php echo $record->cn ?>',
		    	email: '<?php echo $record->email ?>',
		    	page:{
		    		edit: '<?php echo base_url()."users/student/form/".$record->studID ?>',
		    		list: '<?php echo base_url() ?>users/student',
		    		credit: '<?php echo base_url()."users/student/credit-subjects/".$record->studID ?>'
		    	},
		    },
		    methods: {
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>users_student/is_safe_delete/' + id)
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
		        			swal("Unable to delete", "Student has record in other modules!", "error")
		        		}
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>users_student/delete/'+id)
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

