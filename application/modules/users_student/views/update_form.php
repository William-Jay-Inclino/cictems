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
				  <label class="label">Course</label>
				  <div class="control">
					  	<multiselect v-model="form.course" track-by="courseID" label="courseCode" :options="courses" required></multiselect>
				  </div>
				  	<p class="help has-text-danger">
						{{error.course}}
					</p>
				</div>
				<div class="field">
				  <label class="label">Prospectus</label>
				  <div class="control">
					  	<multiselect v-model="form.pros" track-by="prosID" label="prosCode" :options="prospectuses" required></multiselect>
				  </div>
				  	<p class="help has-text-danger">
						{{error.pros}}
					</p>
				</div>
				<div class="field">
				  <label class="label">Yearlevel</label>
				  <div class="control">
					  	<multiselect v-model="form.year" track-by="yearID" label="yearDesc" :options="years" required></multiselect>
				  </div>
				  	<p class="help has-text-danger">
						{{error.year}}
					</p>
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
					  	<textarea class="textarea" v-model.trim="form.address" pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*"></textarea>
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
				  	<label class="label">Email</label>
				  	<div class="control">
					  	<input class="input" type="email" v-model.trim="form.email" placeholder="ex. nightfury@gmail.com">
				  	</div>
				  	<p class="help has-text-danger">
						{{error.email}}
					</p>
				</div>
				<br>
				<button type="submit" class="button is-link is-pulled-right">Submit</button>
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
		    		title: 'Update Student',
		    		list: '<?php echo base_url() ?>users/student',
		    		current_url: '<?php echo base_url() ?>users/student/form/',
		    		show: '<?php echo base_url()."users/student/show/".$record->studID ?>'
		    	},

		    	form: {
		    		id: '<?php echo $record->studID ?>',
		    		controlNo: '<?php echo $record->controlNo ?>',
		    		fn: '<?php echo $record->fn ?>',
		    		mn: '<?php echo $record->mn ?>',
		    		ln: '<?php echo $record->ln ?>',
		    		year: {yearID: '<?php echo $record->yearID ?>', yearDesc: '<?php echo $record->yearDesc ?>'},
		    		course: {courseID: '<?php echo $record->courseID ?>', courseCode: '<?php echo $record->courseCode ?>'},
		    		pros: {prosID: '<?php echo $record->prosID ?>', prosCode: '<?php echo $record->prosCode ?>'},
		    		dob: new Date('<?php echo $record->dob ?>').toISOString().slice(0,10),
		    		sex: {sex: '<?php echo $record->sex ?>'},
		    		address: '<?php echo $record->address ?>',
		    		cn: '<?php echo $record->cn ?>',
		    		email: '<?php echo $record->email ?>'
		    	},
		    	error: {
		    		fn: '',
		    		ln: '',
		    		year: '',
		    		course: '',
		    		pros: '',
		    		sex: '',
		    		email: ''
		    	},
		    	prospectuses: [],
		    	years: [],
		    	courses: [],
		    	sex: [{sex: 'Male'},{sex: 'Female'}]
		    },
		    created(){
		    	this.fetchCourses()
		    	this.fetchProspectuses(this.form.course.courseID)
		    	this.fetchYears(this.form.pros.prosID)
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
		    	}
		  //   	override() {
				//     return {
				//      tabIndex: 0,
				//     }
				// }
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
		        		this.$http.post('<?php echo base_url() ?>users_student/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c == 'error'){
			        			swal('Cannot change prospectus. Student has already a grade', {
							      icon: 'warning',
							    });
			        		}else if(c == 'success'){
			        			swal('Student successfull updated', {
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

		        	if(f.email && !this.validEmail(f.email)){
		        		this.error.email = 'Please enter valid email'
			        	ok = false
		        	}else{
		        		this.error.email = ''
		        	}

		        	return ok
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

