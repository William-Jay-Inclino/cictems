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
			  <label class="label">Course Code</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.cc" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
			  </div>
			  	<p class="help has-text-danger">
					{{error.cc}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Course Description</label>
			  <div class="control">
				  	<textarea class="textarea" v-model.trim="form.cd" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces."></textarea>
			  </div>
			  	<p class="help has-text-danger">
					{{error.cd}}
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

		new Vue({
		    el: '#app',
		    data: {
		    	page:{
		    		title: 'Edit Course',
		    		list: '<?php echo base_url() ?>maintenance/course',
		    		show: '<?php echo base_url()."maintenance/course/show/".$record->courseID ?>'
		    	},

		    	form: {
		    		id: '<?php echo $record->courseID ?>',
		    		cc: '<?php echo $record->courseCode ?>',
		    		cd: '<?php echo $record->courseDesc ?>',
		    	},
		    	error: {
		    		cc: '',
		    		cd: '',
		    		
		    	}
		    },
		    methods: {
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_course/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Course already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			swal('Course successfull updated', {
							      icon: 'success',
							    }).then((x) => {
								  if (x) {
								    window.location.href = this.page.show
								  }
								})
			        		}
						 })
		        	}
		        },
		        checkForm(f){
		        	let ok = true
		        	const errMsg = 'This field is required'
		        	if(f.cc == ''){
		        		this.error.cc = errMsg
		        		ok = false
		        	}else{
		        		this.error.cc = ''
		        	}
		        	if(f.cd == ''){
		        		this.error.cd = errMsg
		        		ok = false
		        	}else{
		        		this.error.cd = ''
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


<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

