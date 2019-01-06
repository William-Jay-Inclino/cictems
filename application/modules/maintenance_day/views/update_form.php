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
			  <label class="label">Day</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.dayDesc" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
			  </div>
			  	<p class="help has-text-danger">
					{{error.dayDesc}}
				</p>
			</div>
			<div class="field">
			  <label class="label">No of days</label>
			  <div class="control">
				  	<multiselect v-model="form.dayCount" track-by="day" label="day" :options="days" placeholder=""></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.dayCount}}
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
		    		title: 'Edit Day',
		    		list: '<?php echo base_url() ?>maintenance/day',
		    		show: '<?php echo base_url()."maintenance/day/show/".$record->dayID ?>'
		    	},

		    	form: {
		    		id: '<?php echo $record->dayID ?>',
		    		dayDesc: '<?php echo $record->dayDesc ?>',
		    		dayCount: {day: '<?php echo $record->dayCount ?>'}
		    	},
		    	error: {
		    		dayDesc: '',
		    		dayCount: ''
		    		
		    	},
		    	days: [
		    		{day: 1},
		    		{day: 2},
		    		{day: 3},
		    		{day: 4},
		    		{day: 5},
		    		{day: 6},
		    		{day: 7}
		    	]
		    },
		    methods: {
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_day/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Day already exist', {
							      icon: 'warning',
							    })
			        		}else{
			        			swal('Day successfull updated', {
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
		        	if(!f.dayDesc){
		        		this.error.dayDesc = errMsg
		        		ok = false
		        	}else{
		        		this.error.dayDesc = ''
		        	}
		        	if(!f.dayCount){
		        		this.error.dayCount = errMsg
		        		ok = false
		        	}else{
		        		this.error.dayCount = ''
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

