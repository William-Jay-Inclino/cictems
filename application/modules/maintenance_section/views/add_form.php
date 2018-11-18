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
		<h5 class="title is-4" style="text-align: center">{{ page.title }}</h5>
		<div class="box">
			<div class="field">
			  <label class="label">Section</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.sec" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
			  </div>
			  	<p class="help has-text-danger">
					{{error.sec}}
				</p>
			</div>
			<div class="field">
			  	<label class="label">Course</label>
			  	<div class="control">
				  	<multiselect v-bind="override" @input="fetchYears" v-model="form.course" track-by="courseID" label="courseCode" :options="courses" :allow-empty="false"></multiselect>
			  	</div>
			  	<p class="help has-text-danger">
					{{error.course}}
				</p>
			</div>
			<div class="field">
			  	<label class="label">Year</label>
			  	<div class="control">
				  	<multiselect v-bind="override" v-model="form.year" track-by="yearID" label="yearDesc" :options="years"></multiselect>
			  	</div>
			  	<p class="help has-text-danger">
					{{error.year}}
				</p>
			</div>
			<div class="field">
			  	<label class="label">Semester</label>
			  	<div class="control">
				  	<multiselect v-bind="override" v-model="form.sem" track-by="semID" label="semDesc" :options="sems"></multiselect>
			  	</div>
			  	<p class="help has-text-danger">
					{{error.sem}}
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
		    		title: 'Add Section',
		    		list: '<?php echo base_url() ?>maintenance/section',
		    		success: '<?php echo base_url() ?>maintenance/section/form-success/'
		    	},

		    	form: {
		    		sec: '',
		    		course: null,
		    		year: null,
		    		sem: null
		    	},
		    	error: {
		    		sec: '',
		    		course: '',
		    		year: '',
		    		sem: ''
		    	},
		    	courses: [],
		    	years: [],
		    	sems: []
		    },
		    created(){
		    	this.populate()
		    },
		    computed: {
		    	override() {
				    return {
				     tabIndex: 0,
				    }
				},
		    },
		    methods: {
		    	populate(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_section/populate')
		        	.then(response => {
		        		const c = response.body 
		        		this.courses = c.courses
		        		this.sems = c.sems
					 })
		    	},
		    	fetchYears(){
		    		this.form.year = null
		    		this.$http.get('<?php echo base_url() ?>maintenance_section/fetchYears/' + this.form.course.courseID)
		        	.then(response => {
		        		this.years = response.body
					 })
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_section/create',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Section already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			window.location.href = this.page.success + c.id
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
		        	if(!f.sec){
		        		this.error.sec = errMsg
		        		ok = false
		        	}else{
		        		this.error.sec = ''
		        	}
		        	if(f.course == null){
		        		this.error.course = errMsg
		        		ok = false
		        	}else{
		        		this.error.course = ''
		        	}
		        	if(f.year == null){
		        		this.error.year = errMsg
		        		ok = false
		        	}else{
		        		this.error.coursyear = ''
		        	}
		        	if(f.sem == null){
		        		this.error.sem = errMsg
		        		ok = false
		        	}else{
		        		this.error.sem = ''
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

