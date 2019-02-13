<style>
	.is-note{
        color: #9c9fa6
      }
      .fa-sm{
        font-size: 8px;
      }
</style>
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
			<button class="button is-danger" v-on:click="is_safe_delete">
				<i class="fa fa-trash"></i>
			</button>
			<button class="button is-link is-pulled-right" @click="confirmRequest">Confirm</button>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Role:</b> </td>
					<td> {{role}} </td>
				</tr>
				<tr>
					<td><b>Username:</b> </td>
					<td> {{userName}} </td>
				</tr>
				<tr>
					<td><b>Name:</b> </td>
					<td> {{name}} </td>
				</tr>
				<tr>
					<td><b>Email:</b> </td>
					<td> {{email}} </td>
				</tr>
			</table>
			<div v-if="roleID == '5'">
              <hr>
              <h6 class="title is-6 is-note">Student/s</h6>
              <p v-for="student of students">
                <i class="fa fa-circle fa-sm"></i> {{student.name}}
              </p>
            </div>
		</div>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		new Vue({
		    el: '#app',
		    data: {
		    	id: '<?php echo $record->regID ?>',
		    	uID: '<?php echo $record->uID ?>',
		    	roleID: '<?php echo $record->roleID ?>',
		    	userName: '<?php echo $record->userName ?>',
		    	name: '<?php echo $record->ln.", ".$record->fn." ".$record->mn ?>',
		    	email: '<?php echo $record->email ?>',
		    	page:{
		    		list: '<?php echo base_url() ?>users/registration'
		    	},
		    	students: []
		    },
		    created(){
		    	if(this.roleID == '5'){
		    		this.fetchStudents()
		    	}
		    },
		    computed: {
		    	role(){
	    			let role = 'Student'
	    			const roleID = this.roleID
	    			if(roleID == '2'){
	    				role = 'Faculty'
	    			}else if(roleID == '3'){
	    				role = 'Staff'
	    			}else if(roleID == '5'){
	    				role = 'Guardian'
	    			}
	    			return role
		    	}
		    },
		    methods: {
		    	fetchStudents(){
		    		this.$http.get('<?php echo base_url() ?>registration/fetchStudents/'+this.id)
		        	.then(response => {
		        		this.students = response.body
					 })
		    	},
		    	is_ok_confirm(){
		    		const roleID = this.roleID
		    		if(roleID == 4){
		    			this.$http.get('<?php echo base_url() ?>registration/is_ok_confirm/'+this.uID)
			        	.then(response => {
			        		const c = response.body
			        		if(c == 0){
			        			this.confirmRequest()
			        		}else if(c == 1){
			        			swal('Student has already a user', {
							      icon: 'error',
							    })
			        		}else{
			        			alert('Something went wrong! Error: '+c)
			        			window.location.href = '<?php echo base_url() ?>users/registration/show/'+this.id
			        		}
						 })
		    		}
		    	},
		    	confirmRequest(){
	    			swal({
					  title: "Are you sure?",
					  icon: "info",
					  buttons: {
					  	cancel: true,
					  	Yes: true
					  }
					})
					.then((yes) => {
					  if (yes) {
					  	this.$http.get('<?php echo base_url() ?>registration/confirmRequest/'+this.id)
			        	.then(response => {
			        		const c = response.body
			        		swal("Success", "User successfully registered!", "success")
			        		.then((x) => {
							  window.location.href = this.page.list
							})
						 })
					  }
					})
		    	},
		    	is_safe_delete(){
		    		const id = this.id

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
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>registration/delete/'+id)
		        	.then(response => {
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

