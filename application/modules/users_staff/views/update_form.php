<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<div id="app" v-cloak>

<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li><a :href="page.show">Show</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Update Form</a></li>
		  </ul>
		</nav>
	</div>
	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-4 has-text-primary" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<form @submit.prevent="submitForm">
				<div class="field">
				  <label class="label">Name</label>
				  <div class="columns">
				  	<div class="column">
				  		<div class="control">
						  	<input class="input" type="text" v-model.trim="form.fn" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" placeholder="Firstname" required>
					  	</div>
					  	<p class="help has-text-danger">
							{{error.fn}}
						</p>
				  	</div>
				  	<div class="column">
				  		<div class="control">
						  	<input class="input" type="text" v-model.trim="form.mn" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" placeholder="Middlename">
					  	</div>
				  	</div>
				  	<div class="column">
				  		<div class="control">
						  	<input class="input" type="text" v-model.trim="form.ln" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" placeholder="Lastname" required>
					  	</div>
					  	<p class="help has-text-danger">
							{{error.ln}}
						</p>
				  	</div>
				  </div>
				</div>
				<div class="field">
				  <label class="label">Date of Birth</label>
				  <div class="control">
					  	<input class="input" type="date" v-model="form.dob" required>
				  </div>
				  	<p class="help has-text-danger">
						{{error.dob}}
					</p>
				</div>
				<div class="field">
				  <label class="label">Sex</label>
				  <div class="control">
					  	<multiselect v-model="form.sex" track-by="sex" label="sex" :options="sex" required></multiselect>
				  </div>
				  	<p class="help has-text-danger">
						{{error.sex}}
					</p>
				</div>
				<div class="field">
				  <label class="label">Address</label>
				  <div class="control">
					  	<textarea class="textarea" v-model.trim="form.address" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*"></textarea>
				  </div>
				  	<p class="help has-text-danger">
						{{error.address}}
					</p>
				</div>
				<label class="label">Contact number</label>
				<div class="field has-addons">
				  <div class="control">
				  	<input type="text" disabled class="input" readonly value="+63" style="width: 50px;">
				  </div>
				  <div class="control" style="width: 100%">
					  	<input type="text" class="input" v-model.trim="form.cn" pattern="^[1-9][0-9]*$" maxlength="10">
				  </div>
				  	<p class="help has-text-danger">
						{{error.cn}}
					</p>
				</div>
				<div class="field">
				  	<label class="label">Gmail</label>
				  	<div class="control">
					  	<input class="input" type="email" v-model.trim="form.email" pattern="(\W|^)[\w.+\-]*@gmail\.com(\W|$)">
				  	</div>
				  	<p class="help">
						<i>format: williamjay.inclino@gmail.com</i>
					</p>
				</div>
				<br>
				<button type="submit" class="button is-link is-pulled-right">Submit</button>
				<br><br>
			</form>
		</div>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		Vue.component('multiselect', window.VueMultiselect.default)	

		new Vue({
		    el: '#app',
		    data: {
		    	page:{
		    		title: 'Update Staff',
		    		list: '<?php echo base_url() ?>users/staff',
		    		show: '<?php echo base_url()."users/staff/show/".$record->staffID ?>'
		    	},
		    	form: {
		    		id: '<?php echo $record->staffID ?>',
		    		fn: '<?php echo $record->fn ?>',
		    		mn: '<?php echo $record->mn ?>',
		    		ln: '<?php echo $record->ln ?>',
		    		dob: '<?php echo $record->dob ?>',
		    		sex: {sex: '<?php echo $record->sex ?>'},
		    		address: '<?php echo $record->address ?>',
		    		cn: '<?php echo $record->cn ?>',
		    		email: '<?php echo $record->email ?>'
		    	},
		    	error: {
		    		fn: '',
		    		ln: '',
		    		sex: '',
		    		email: '',
		    		dob: ''
		    	},
		    	sex: [{sex: 'Male'},{sex: 'Female'}]
		    },
		    methods: {
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>users_staff/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c == 'error'){
			        			swal('Gmail already exist!', {
							      icon: 'error',
							    });
			        		}else{
			        			swal('Staff successfully updated', {
								    icon: 'success',
								}).then((x) => {
									if (x) {
										window.location.href = this.page.show
									}
								})
			        		}
			    
						 })
		        	}else{
		        		swal('Unable to submit. Please review the form', {
					      icon: 'warning',
					    });
		        	}
		        },
		        checkForm(f){
		        	let ok = true
		        	const errMsg = 'This field is required'
		        	if(!f.fn){
		        		this.error.fn = errMsg
		        		ok = false
		        	}else{
		        		this.error.fn = ''
		        	}
		        	if(!f.ln){
		        		this.error.ln = errMsg
		        		ok = false
		        	}else{
		        		this.error.ln = ''
		        	}
		        	if(!Date.parse(f.dob)){
		        		this.error.dob = errMsg
		        		ok = false
		        	}else{
		        		this.error.dob = ''
		        	}
		        	if(f.sex == null){
		        		this.error.sex = errMsg
		        		ok = false
		        	}else{
		        		this.error.sex = ''
		        	}

		        	return ok
		        }
		   },

		   http: {
            emulateJSON: true,
            emulateHTTP: true
    		}


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

