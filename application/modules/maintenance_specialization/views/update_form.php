<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-swatches/vue-swatches.min.css">

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
				  <label class="label">Subject Type</label>
				  <div class="control">
					  	<input class="input" type="text" v-model.trim="form.spec" required>
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
			<div class="field">
				<label class="label">Color</label>
				<div class="control">
					<swatches v-model="form.color">
				      <input slot="trigger" :value="form.color" class="input" readonly>
				    </swatches>
				</div>
				<p class="help has-text-danger"> {{error.color}} </p>
			</div>
			<button class="button is-link is-pulled-right" v-on:click="submitForm">Submit</button>
			<br><br>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {
		Vue.component('swatches', window.VueSwatches.default)	
		Vue.component('multiselect', window.VueMultiselect.default)	

		new Vue({
		    el: '#app',
		    data: {
		    	page:{
		    		title: 'Update Subject Type',
		    		list: '<?php echo base_url() ?>maintenance/specialization',
		    		show: '<?php echo base_url()."maintenance/specialization/show/".$record->specID ?>'
		    	},

		    	form: {
		    		id: '<?php echo $record->specID ?>',
		    		spec: '<?php echo $record->specDesc ?>',
		    		pros: {prosID: '<?php echo $record->prosID ?>', prosCode: '<?php echo $record->prosCode ?>'},
		    		color: '<?php echo $record->specColor ?>'
		    	},
		    	error: {
		    		spec: '',
		    		pros: '',
		    		color: ''
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
		        		this.$http.post('<?php echo base_url() ?>maintenance_specialization/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Specialization already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			swal('Specialization successfull updated', {
							      icon: 'success',
							    }).then((x) => {
								  if (x) {
								    window.location.href = this.page.show
								  }
								})
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
		        		this.error.spec = ''
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
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swatches/vue-swatches.min.js"></script>
