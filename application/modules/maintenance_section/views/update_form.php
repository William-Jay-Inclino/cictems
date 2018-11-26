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
				  	<multiselect @input="fetchYears" v-model="form.course" track-by="courseID" label="courseCode" :options="courses"></multiselect>
			  	</div>
			  	<p class="help has-text-danger">
					{{error.course}}
				</p>
			</div>
			<div class="field">
			  	<label class="label">Year</label>
			  	<div class="control">
				  	<multiselect v-model="form.year" track-by="yearID" label="yearDesc" :options="years"></multiselect>
			  	</div>
			  	<p class="help has-text-danger">
					{{error.year}}
				</p>
			</div>
			<div class="field">
			  	<label class="label">Semester</label>
			  	<div class="control">
				  	<multiselect v-model="form.sem" track-by="semID" label="semDesc" :options="sems"></multiselect>
			  	</div>
			  	<p class="help has-text-danger">
					{{error.sem}}
				</p>
			</div>
			<br>
			<button class="button is-link is-pulled-right" v-on:click="submitForm">Save changes</button>
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
		    		title: 'Edit Section',
		    		list: '<?php echo base_url() ?>maintenance/section',
		    		show: '<?php echo base_url()."maintenance/section/show/".$record->secID ?>'
		    	},

		    	form: {
		    		id: '<?php echo $record->secID ?>',
		    		sec: '<?php echo $record->secName ?>',
		    		course: {courseID: '<?php echo $record->courseID ?>',courseCode: '<?php echo $record->courseCode ?>'},
		    		year: {yearID: '<?php echo $record->yearID ?>',yearDesc: '<?php echo $record->yearDesc ?>'},
		    		sem: {semID: '<?php echo $record->semID ?>',semDesc: '<?php echo $record->semDesc ?>'},
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
		    	this.fetchYears(0)
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
		    	fetchYears(val){
		    		if(val != 0){
		    			this.form.year = null
		    		}
		    		this.$http.get('<?php echo base_url() ?>maintenance_section/fetchYears/' + this.form.course.courseID)
		        	.then(response => {
		        		this.years = response.body
					 })
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_section/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Section already exist', {
							      icon: 'warning',
							    })
			        		}else{
			        			swal('Section successfull updated', {
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

