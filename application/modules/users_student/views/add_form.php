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
			  <label class="label">Control number</label>
			  <div class="control">
				  	<input type="number" class="input" v-model.number.trim="form.controlNo" onpaste="return false;" onKeyPress="if(this.value.length==10 && event.keyCode>47 && event.keyCode < 58)return false;">
			  </div>
			  	<p class="help has-text-danger">
					{{error.controlNo}}
				</p>
			</div>
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
			  <label class="label">Course</label>
			  <div class="control">
				  	<multiselect v-bind="override" v-model="form.course" track-by="courseID" label="courseCode" :options="courses"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.course}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Prospectus</label>
			  <div class="control">
				  	<multiselect v-bind="override" v-model="form.pros" track-by="prosID" label="prosCode" :options="prospectuses"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.pros}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Yearlevel</label>
			  <div class="control">
				  	<multiselect v-bind="override" v-model="form.year" track-by="yearID" label="yearDesc" :options="years"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.year}}
				</p>
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
				  	<multiselect v-bind="override" v-model="form.sex" track-by="sex" label="sex" :options="sex"></multiselect>
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
		    		title: 'Add Student',
		    		list: '<?php echo base_url() ?>users/student',
		    		current_url: '<?php echo base_url() ?>users/student/form',
		    		success: '<?php echo base_url() ?>users/student/form-success/'
		    	},

		    	form: {
		    		controlNo: '',
		    		fn: '',
		    		mn: '',
		    		ln: '',
		    		year: null,
		    		course: null,
		    		pros: null,
		    		sex: null,
		    		dob: '',
		    		address: '',
		    		cn: '',
		    		email: ''
		    	},
		    	error: {
		    		fn: '',
		    		ln: '',
		    		year: '',
		    		course: '',
		    		pros: '',
		    		sex: ''
		    	},
		    	prospectuses: [],
		    	years: [],
		    	courses: [],
		    	sex: [{sex: 'Male'},{sex: 'Female'}]
		    },
		    created(){
		    	this.fetchCourses()
		    },
		    watch: {
		    	course(val){
		    		this.form.pros = null
		    		this.form.year = null
		    		this.prospectuses = []
		    		if(val != null){
		    			this.fetchProspectuses(val.courseID)
		    		}
		    	},
		    	prospectus(val){
		    		this.form.year = null
		    		this.years = []
		    		if(val != null){
		    			this.fetchYears(val.prosID)
		    		}
		    	}
		    },
		    computed: {
		    	course(){
		    		return this.form.course
		    	},
		    	prospectus(){
		    		return this.form.pros
		    	},
		    	override() {
				    return {
				     tabIndex: 0,
				    }
				}
		    },
		    methods: {
		    	fetchCourses(){
		    		this.$http.get('<?php echo base_url() ?>users_student/get_courses')
		    		.then(response => {
		    			this.courses = response.body
		    		})
		    	},
		    	fetchProspectuses(courseID){
		    		this.$http.get('<?php echo base_url() ?>users_student/get_prospectuses/' + courseID)
		    		.then(response => {
		    			this.prospectuses = response.body
		    		})
		    	},
		    	fetchYears(prosID){
		    		this.$http.get('<?php echo base_url() ?>users_student/get_years/' + prosID)
		    		.then(response => {
		    			this.years = response.body
		    		})
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>users_student/create',f)
			        	.then(response => {
			        		const c = response.body
			        		if(c.output == 'success'){
			        			window.location.href = this.page.success + c.studID
			        		}else{
			        			alert('Error: '+ c)
			        			window.location.href = this.page.current_url
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
		        	if(f.fn == ''){
		        		this.error.fn = errMsg
		        		ok = false
		        	}else{
		        		this.error.fn = ''
		        	}
		        	if(f.ln == ''){
		        		this.error.ln = errMsg
		        		ok = false
		        	}else{
		        		this.error.ln = ''
		        	}
		        	if(f.course == null){
		        		this.error.course = errMsg
		        		ok = false
		        	}else{
		        		this.error.course = ''
		        	}
		        	if(f.pros == null){
		        		this.error.pros = errMsg
		        		ok = false
		        	}else{
		        		this.error.pros = ''
		        	}
		        	if(f.year == null){
		        		this.error.year = errMsg
		        		ok = false
		        	}else{
		        		this.error.year = ''
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

