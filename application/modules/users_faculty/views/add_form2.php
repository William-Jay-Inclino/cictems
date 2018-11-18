<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<div id="app" v-cloak>

<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Add Form</a></li>
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
			  <label class="label">Does faculty have email?</label>
			  <div class="control">
				  	<button :class="optClass" v-on:click="showOpt('no')">No</button>
				  	<button :class="optClass2" v-on:click="showOpt('yes')">Yes</button>
			  </div>
			</div>
			<div v-if="options">
				<div class="field" v-if="show_email">
				  <label class="label">Email</label>
				  <div class="control">
					  	<input class="input" type="email" v-model.trim="form.email" placeholder="ex. nightfury@gmail.com">
				  </div>
				  	<p class="help has-text-danger">
						{{error.email}}
					</p>
				</div>
				<div v-else>
					<div class="field">
					  <label class="label">Username</label>
					  <div class="control">
						  	<input class="input" type="text" v-model.trim="form.un">
					  </div>
					  	<p class="help has-text-danger">
							{{error.un}}
						</p>
					</div>
					<div class="field">
					  <label class="label">Password</label>
					  <div class="control">
						  	<input class="input" type="password" v-model.trim="form.pw">
					  </div>
					  	<p class="help has-text-danger">
							{{error.pw}}
						</p>
					</div>
				</div>
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
		    	options: false,
		    	show_email: false,
		    	optClass: {'button is-primary is-outlined': true},
		    	optClass2: {'button is-primary is-outlined': true},
		    	page:{
		    		title: 'Add Faculty',
		    		list: '<?php echo base_url() ?>users/faculty',
		    		success: '<?php echo base_url() ?>users/faculty/form-success/'
		    	},
		    	form: {
		    		fn: '',
		    		mn: '',
		    		ln: '',
		    		dob: '',
		    		sex: null,
		    		address: '',
		    		cn: '',
		    		email: '',
		    		un: '',
		    		pw: ''
		    	},
		    	error: {
		    		fn: '',
		    		ln: '',
		    		sex: '',
		    		email: '',
		    		dob: '',
		    		un: '',
		    		pw: ''
		    	},
		    	sex: [{sex: 'Male'},{sex: 'Female'}]
		    },
		    created(){

		    },
		    watch: {

		    },
		    methods: {
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>users_faculty/create',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c == 'exist'){
			        			swal('Username already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			window.location.href = this.page.success + c
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
		        	
		        	if(this.options == true){
		        		if(this.show_email == true){
			        		if(f.email == ''){
			        			this.error.email = errMsg
			        			ok = false
			        		}else if(!this.validEmail(f.email)){
			        			this.error.email = 'Please enter valid email'
			        			ok = false
			        		}else{
			        			this.error.email = ''
			        		}
			        	}else{
			        		if(!f.un){
			        			this.error.un = errMsg
			        			ok = false
			        		}else{
			        			this.error.un = ''
			        		}
			        		if(!f.pw){
			        			this.error.pw = errMsg
			        			ok = false
			        		}else{
			        			this.error.pw = ''
			        		}
			        	}
		        	}else{
		        		swal('Please answer the question. Does faculty have email?', {
					      icon: 'warning',
					    });
					    ok = false
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

