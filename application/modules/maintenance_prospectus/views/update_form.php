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
			  <label class="label">Prospectus Code</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.pc" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
			  </div>
			  	<p class="help has-text-danger">
					{{error.pc}}
				</p>
			</div>
			<div class="field">
			  	<label class="label">Course</label>
			  	<div class="control">
				  	<multiselect v-model="form.course" track-by="courseID" label="courseCode" :options="courses"></multiselect>
			  	</div>
			  	<p class="help has-text-danger">
					{{error.course}}
				</p>
			</div>
			<div class="field">
			  <label class="label">CM0 #</label>
			  <div class="control">
			  		<input class="input" type="text" v-model.trim="form.desc" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
			  </div>
			</div>
			<div class="field">
			  <label class="label">Effectivity</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.effect" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
			  </div>
			  	<p class="help has-text-danger">
					{{error.effect}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Duration</label>
			  <div class="control">
				  	<input type="number" class="input" v-model.number.trim="form.duration" onpaste="return false;" onKeyPress="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58)return false;">
			  </div>
			  	<p class="help has-text-danger">
					{{error.duration}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Type</label>
			  <div class="control">
				  	<multiselect v-model="form.type" track-by="type" label="type" :options="types"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.type}}
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
		    		title: 'Edit Prospectus',
		    		list: '<?php echo base_url() ?>maintenance/prospectus',
		    		show: '<?php echo base_url()."maintenance/prospectus/show/".$record->prosID ?>'
		    	},

		    	form: {
		    		id: '<?php echo $record->prosID ?>',
		    		pc: '<?php echo $record->prosCode ?>',
		    		desc: '<?php echo $record->prosDesc ?>',
		    		course: {courseID: '<?php echo $record->courseID ?>',courseCode: '<?php echo $record->courseCode ?>'},
		    		duration: '<?php echo $record->duration ?>',
		    		effect: '<?php echo $record->effectivity ?>',
		    		type: {type: '<?php echo $record->prosType ?>'}
		    	},
		    	error: {
		    		pc: '',
		    		course: '',
		    		duration: '',
		    		effect: '',
		    		type: ''
		    		
		    	},
		    	courses: [],
		    	types: [{type: 'New'},{type: 'Old'}]
		    },
		    created(){
		    	this.fetchCourse()
		    },
		    methods: {
		    	fetchCourse(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_prospectus/get_courses')
		        	.then(response => {
		        		this.courses = response.body 
					 })
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_prospectus/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Prospectus already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			swal('Prospectus successfull updated', {
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
		        	if(f.pc == ''){
		        		this.error.pc = errMsg
		        		ok = false
		        	}else{
		        		this.error.pc = ''
		        	}
		        	if(f.course == null){
		        		this.error.course = errMsg
		        		ok = false
		        	}else{
		        		this.error.course = ''
		        	}
		        	if(f.duration == ''){
		        		this.error.duration = errMsg
		        		ok = false
		        	}else{
		        		this.error.duration = ''
		        	}
		        	if(f.effect == ''){
		        		this.error.effect = errMsg
		        		ok = false
		        	}else{
		        		this.error.effect = ''
		        	}
		        	if(f.type == null){
		        		this.error.type = errMsg
		        		ok = false
		        	}else{
		        		this.error.type = ''
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

