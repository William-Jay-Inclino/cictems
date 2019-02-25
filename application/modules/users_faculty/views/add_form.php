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
					  	<multiselect v-model="form.sex" track-by="sex" label="sex" :options="sex" required pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$"></multiselect>
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
					  	<input class="input" type="email" v-model.trim="form.email" pattern="(\W|^)[\w.+\-]*@gmail\.com(\W|$)" required>
				  </div>
				  	<p class="help">
						<i>format: williamjay.inclino@gmail.com</i>
					</p>
				</div>
				<div class="field">
				  <label class="label">Subjects</label>
				  <div class="control">
					  	<multiselect :multiple="true" v-model="form.spec" track-by="specID" label="specDesc" :options="specs"></multiselect>
				  </div>
				  	<p class="help has-text-danger">
						{{error.spec}}
					</p>
				</div>
				<div class="field">
				  <label class="label">Specialization</label>
				  <div class="control">
					  	<input class="input" type="text" v-model.trim="form.special">
				  </div>
				  	<p class="help has-text-danger">
						{{error.special}}
					</p>
				</div>
				<br>
				<button type="submit" :class="{'button is-link is-pulled-right': true, 'is-loading': isLoading}">Submit</button>
			</form>
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
		    		title: 'Add Faculty',
		    		list: '<?php echo base_url() ?>users/faculty',
		    		success: '<?php echo base_url() ?>users/faculty/form-success/'
		    	},
		    	isLoading: false,
		    	form: {
		    		fn: '',
		    		mn: '',
		    		ln: '',
		    		dob: '',
		    		sex: null,
		    		address: '',
		    		cn: '',
		    		email: '',
		    		spec: null,
		    		special: ''
		    	},
		    	error: {
		    		fn: '',
		    		ln: '',
		    		sex: '',
		    		email: '',
		    		dob: '',
		    		spec: '',
		    		special: ''
		    	},
		    	sex: [{sex: 'Male'},{sex: 'Female'}],
		    	specs: []
		    },
		    created(){
		    	this.fetchSpec()
		    },
		    computed: {
		  //   	override() {
				//     return {
				//      tabIndex: 0,
				//     }
				// },
		    },
		    methods: {
		    	fetchSpec(){
		    		this.$http.get('<?php echo base_url() ?>users_faculty/fetchSpec')
		        	.then(response => {
		        		this.specs = response.body
					 })
		    	},
		        submitForm() {
		        	this.isLoading = true
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>users_faculty/create',f)
			        	.then(response => {
			        		this.isLoading = false
			        		const c = response.body
			        		if(c == 'error'){
			        			swal('Error', "Gmail already exist!", 'error')
			        		}else{
			        			window.location.href = this.page.success + c
			        		}
						 }, e => {
						 	console.log(e.body);

						 })
		        	}else{
		        		this.isLoading = false
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
		        	if(!f.special){
		        		this.error.special = errMsg
		        		ok = false
		        	}else{
		        		this.error.special = ''
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
		        	if(f.spec == null){
		        		this.error.spec = errMsg
		        		ok = false
		        	}else{
		        		this.error.spec = ''
		        	}
		        	if(!f.email){
	        			this.error.email = errMsg
	        			ok = false
	        		}else{
	        			this.error.email = ''
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

