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
			<?php 
				if($roleID == 1){ ?>
					<a class="button is-primary is-pulled-right" :href="page.rights">
						Access Rights
					</a>
					<?php
				}
			?>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Role: </b></td>
					<td>Faculty</td>
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
					<td><b>Contact #:</b> </td>
					<td> {{cn}} </td>
				</tr>
				<tr>
					<td><b>Gmail:</b> </td>
					<td> {{mail}} </td>
				</tr>
				<tr>
					<th>Specialization</th>
					<td> {{special}} </td>
				</tr>
				<tr>
					<td><b>Subjects:</b> </td>
					<td>
						<?php
							$len = count($record['specs']) - 1;
							$ctr = 0;
							foreach($record['specs'] as $spec){ ?>
									<li> <?php echo $spec->specDesc; ?> </li>
								<?php 
							}
						?>
					</td>
				</tr>
				<tr>
					<td><b>Has Classes:</b> </td>
					<td>
						<?php 
							if($record['facInfo']->has_classes == ''){ ?>
								<span class="tag is-danger">None</span>
								<?php
							}else{ ?>
								<span class="tag is-success">Yes</span>
								<?php
							}
						?>
					</td>
				</tr>
				<tr>
					<td><b>Status:</b> </td>
					<td> <?php echo $record['facInfo']->status ?> </td>
				</tr>
			</table>
			<a @click="sendLogin" href="javascript:void(0)">Send Login Details</a>
		</div>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		new Vue({
		    el: '#app',
		    data: {
		    	id: '<?php echo $record["facInfo"]->facID ?>',
		    	fn: '<?php echo $record["facInfo"]->fn ?>',
		    	mn: '<?php echo $record["facInfo"]->mn ?>',
		    	ln: '<?php echo $record["facInfo"]->ln ?>',
		    	dob: '<?php echo $record["facInfo"]->dob ?>',
		    	sex: '<?php echo $record["facInfo"]->sex ?>',
		    	address: '<?php echo $record["facInfo"]->address ?>',
		    	cn: '<?php echo $record["facInfo"]->cn ?>',
		    	mail: '<?php echo $record["facInfo"]->email ?>',
		    	status: '<?php echo $record["facInfo"]->status ?>',
		    	special: '<?php echo $record["facInfo"]->special ?>',
		    	page:{
		    		edit: '<?php echo base_url()."users/faculty/form/".$record["facInfo"]->facID ?>',
		    		rights: '<?php echo base_url()."users/faculty/access-rights/".$record["facInfo"]->facID ?>',
		    		list: '<?php echo base_url() ?>users/faculty'
		    	},
		    },
		    methods: {
		    	sendLogin(){
		    		if(this.mail){
		    			swal('Info', "Login details will be send to "+this.mail, 'info')
		    			swal({
						  title: "Info",
						  text: "Login details will be send to "+this.mail,
						  icon: "info",
						  buttons: {
						  	confirm: {
						  		closeModal: false
						  	}
						  },
						  closeOnClickOutside: false
						})
			    		.then(send => {
			    			if(send){
			    				this.$http.post('<?php echo base_url() ?>users_faculty/sendLogin', {id: this.id})
					        	.then(res => {
					        		console.log(res.body)
					        		if(res.body == 'error'){
					        			swal('Mail not send!', "Please check your internet connection and try again", 'warning')
					        		}else if(res.body == 'success'){
					        			swal('Success!', "Login details successfully send to "+this.mail+"!", 'success')
					        		}	
								 }, e => {
								 	console.log(e.body)

								 })
			    			}
			    		})	
		    		}else{
		    			swal('Warning', "Faculty has no gmail", 'warning');
		    		}
		    		
		    	},
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>users_faculty/is_safe_delete/' + id)
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
		        			swal("Unable to delete", "Faculty has record in other modules!", "error")
		        		}
					 }, e => {
					 	console.log(e.response.body)
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>users_faculty/delete/'+id)
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
		    },

		   http: {
            emulateJSON: true,
            emulateHTTP: true
    		}


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

