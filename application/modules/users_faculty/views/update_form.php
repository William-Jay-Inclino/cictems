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
		    		title: 'Update Faculty',
		    		list: '<?php echo base_url() ?>users/faculty',
		    		show: '<?php echo base_url()."users/faculty/show/".$record['facInfo']->facID ?>'
		    	},
		    	form: {
		    		id: '<?php echo $record["facInfo"]->facID ?>',
		    		fn: '<?php echo $record["facInfo"]->fn ?>',
		    		mn: '<?php echo $record["facInfo"]->mn ?>',
		    		ln: '<?php echo $record["facInfo"]->ln ?>',
		    		dob: '<?php echo $record["facInfo"]->dob ?>',
		    		sex: {sex: '<?php echo $record["facInfo"]->sex ?>'},
		    		address: '<?php echo $record["facInfo"]->address ?>',
		    		cn: '<?php echo $record["facInfo"]->cn ?>',
		    		email: '<?php echo $record["facInfo"]->email ?>',
		    		spec: [],
		    		special: '<?php echo $record["facInfo"]->special ?>'
		    	},
		    	error: {
		    		fn: '',
		    		ln: '',
		    		sex: '',
		    		email: '',
		    		dob: '',
		    		specDesc: '',
		    		special: '',
		    	},
		    	sex: [{sex: 'Male'},{sex: 'Female'}],
		    	specs: []
		    },
		    created(){
		    	this.fetchSpec()
		    	this.populateSpec()
		    },
		    methods: {
		    	populateSpec(){
		    		this.$http.get('<?php echo base_url() ?>users_faculty/populateSpec/'+this.form.id)
		        	.then(response => {
		        		this.form.spec = response.body
					 })
		    	},
		    	fetchSpec(){
		    		this.$http.get('<?php echo base_url() ?>users_faculty/fetchSpec')
		        	.then(response => {
		        		this.specs = response.body
					 })
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>users_faculty/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c == 'error'){
			        			swal('Error', 'Gmail already exist!', {
							      icon: 'error',
							    });
			        		}else if(c == 'success'){
			        			swal('Faculty successfull updated', {
							      icon: 'success',
							    }).then((x) => {
								  if (x) {
								    window.location.href = this.page.show
								  }
								})
			        		}
						 }, e => {
						 	console.log(e.body)

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

