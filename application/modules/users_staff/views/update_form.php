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
			<div class="field">
			  <label class="label">Name</label>
			  <div class="columns">
			  	<div class="column">
			  		<div class="control">
					  	<input class="input" type="text" v-model.trim="form.fn" pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" placeholder="Firstname">
				  	</div>
				  	<p class="help has-text-danger">
						{{error.fn}}
					</p>
			  	</div>
			  	<div class="column">
			  		<div class="control">
					  	<input class="input" type="text" v-model.trim="form.mn" pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" placeholder="Middlename">
				  	</div>
			  	</div>
			  	<div class="column">
			  		<div class="control">
					  	<input class="input" type="text" v-model.trim="form.ln" pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" placeholder="Lastname">
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
				  	<input class="input" type="date" v-model="form.dob">
			  </div>
			  	<p class="help has-text-danger">
					{{error.dob}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Sex</label>
			  <div class="control">
				  	<multiselect v-model="form.sex" track-by="sex" label="sex" :options="sex"></multiselect>
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
			<div class="field">
			  <label class="label">Contact number</label>
			  <div class="control">
				  	<input type="text" class="input" v-model.trim="form.cn" onpaste="return false;" onKeyPress="if(this.value.length==11 && event.keyCode>47 && event.keyCode < 58)return false;">
			  </div>
			  	<p class="help has-text-danger">
					{{error.cn}}
				</p>
			</div>
			<div class="field">
			  	<label class="label">Email</label>
			  	<div class="control">
				  	<input class="input" type="email" v-model.trim="form.email" placeholder="ex. nightfury@gmail.com">
			  	</div>
			  	<p class="help has-text-danger">
					{{error.email}}
				</p>
			</div>
			<br>
			<button class="button is-link is-pulled-right" v-on:click="submitForm">Submit</button>
			<br><br>
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
			        		if(c == 'exist'){
			        			swal('Username already exist!', {
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
		        },

		        showOpt(val){
		        	this.options = true
		        	if(val == 'yes'){
		        		this.form.un = ''
		        		this.form.pw = ''
		        		this.show_email = true
		        		this.optClass = {'button is-primary is-outlined': true}
		        		this.optClass2 = {'button is-primary': true}
		        	}else{
		        		this.form.email = ''
		        		this.show_email = false
		        		this.optClass = {'button is-primary': true}
		        		this.optClass2 = {'button is-primary is-outlined': true}
		        	}
		        },
		        validEmail(email){
		        	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      				return re.test(email);
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

