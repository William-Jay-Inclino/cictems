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
				<label class="label">Subject Type</label>
				<div class="control">
					<input class="input" type="text" v-model.trim="form.spec">
				</div>
				<p class="help has-text-danger"> {{error.spec}} </p>
			</div>
			<div class="field">
				<label class="label">Prospectus</label>
				<div class="control">
					<multiselect v-model="form.pros" track-by="prosID" label="prosCode" :options="prospectuses"></multiselect>
				</div>
				<p class="help has-text-danger"> {{error.pros}} </p>
			</div>
			<button class="button is-link is-pulled-right" v-on:click="submitForm">Submit</button>
			<br><br>
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
		    		title: 'Add Subject Type',
		    		list: '<?php echo base_url() ?>maintenance/specialization',
		    		success: '<?php echo base_url() ?>maintenance/specialization/form-success/'
		    	},

		    	form: {
		    		spec: '',
		    		pros: null
		    	},
		    	error: {
		    		spec: '',
		    		pros: ''
		    	},
		    	prospectuses: []
		    },
		    created(){
		    	this.get_prospectuses()
		    },
		    methods: {
		    	get_prospectuses(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_specialization/get_prospectuses')
		        	.then(response => {
		        		this.prospectuses = response.body
					 }, e => {
					 	console.log(e.body);
					 })
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_specialization/create',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Specialization already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			window.location.href = this.page.success + c.id
			        		}
						 }, e => {
						 	console.log(e.body);

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
		        	if(!f.spec){
		        		this.error.spec = errMsg
		        		ok = false
		        	}else{
		        		this.error.sec = ''
		        	}
		        	if(!f.pros){
		        		this.error.pros = errMsg
		        		ok = false
		        	}else{
		        		this.error.pros = ''
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

