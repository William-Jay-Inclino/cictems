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
			  <label class="label">Room name</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.rn" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
			  </div>
			  	<p class="help has-text-danger">
					{{error.rn}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Location</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.loc" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
			  </div>
			  	<p class="help has-text-danger">
					{{error.loc}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Capacity</label>
			  <div class="control">
				  	<input type="number" class="input" v-model.number.trim="form.cap" onpaste="return false;" onKeyPress="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58)return false;">
			  </div>
			  	<p class="help has-text-danger">
					{{error.cap}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Status</label>
			  <div class="control">
				  	<multiselect :allow-empty="false" v-model="form.status" track-by="statID" label="statDesc" :options="statuses"></multiselect>
			  </div>
			</div>
			<div class="field">
			  <label class="label">Room usage</label>
			  <div class="control">
				  	<multiselect :multiple="true" v-model="form.specs" track-by="specID" label="specDesc" :options="specs"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.spec}}
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
		    		title: 'Add Room',
		    		list: '<?php echo base_url() ?>maintenance/room',
		    		success: '<?php echo base_url() ?>maintenance/room/form-success/'
		    	},
		    	statuses: [
		    		{statID: 'active', statDesc: 'Active'},
		    		{statID: 'inactive', statDesc: 'Inactive'}
		    	],
		    	form: {
		    		rn: '',
		    		loc: '',
		    		cap: '',
		    		status: {statID: 'active', statDesc: 'Active'},
		    		specs: []
		    	},
		    	error: {
		    		rn: '',
		    		loc: '',
		    		cap: '',
		    		spec: ''
		    	},
		    	specs: []
		    },
		    created(){
		    	this.fetchSpec()
		    },
		    computed: {

			  },
		    watch: {


		    },
		    methods: {
		    	fetchSpec(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_room/fetchSpec')
		        	.then(response => {
		        		this.specs = response.body
					 })
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_room/create',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Room already exist', {
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
		        	if(f.rn == ''){
		        		this.error.rn = errMsg
		        		ok = false
		        	}else{
		        		this.error.rn = ''
		        	}
		        	if(f.loc == ''){
		        		this.error.loc = errMsg
		        		ok = false
		        	}else{
		        		this.error.loc = ''
		        	}
		        	if(f.cap == ''){
		        		this.error.cap = errMsg
		        		ok = false
		        	}else{
		        		this.error.cap = ''
		        	}
	        		if(f.specs.length == 0){
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

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
