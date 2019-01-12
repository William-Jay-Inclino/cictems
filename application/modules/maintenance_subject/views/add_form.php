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
			<h5 class="title is-4 has-text-primary has-text-centered">{{ page.title }}</h5>
			<hr>
			<div class="field">
			  <label class="label">Subject Code</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.subCode" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces." autofocus="true">
			  </div>
			  	<p class="help has-text-danger">
					{{error.subCode}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Description</label>
			  <div class="control">
				  	<textarea class="textarea" v-model.trim="form.subDesc" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces."></textarea>
			  </div>
			  	<p class="help has-text-danger">
					{{error.subDesc}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Prospectus</label>
			  <div class="control">
				  	<multiselect v-model="form.prospectus" track-by="prosID" label="prosCode" :options="prospectuses"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.prospectus}}
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
			<div class="field">
			  <label class="label">Prerequisites</label>
			  <div class="columns">
			  	<div class="column">
			  		<div class="control">
			  			<multiselect :multiple="true" v-model="form.pre" track-by="subID" label="subCode" :options="pres" placeholder="Subject"></multiselect>
			  		</div>
			  		<p class="help has-text-danger">
						{{error.pre}}
					</p>
			  	</div>
			  	<div class="column">
			  		<div class="control">
			  			<multiselect v-model="form.pre2" track-by="yearID" label="yearDesc" :options="years2" placeholder="Yearlevel"></multiselect>
			  		</div>
			  		<p class="help has-text-danger">
						{{error.pre2}}
					</p>
			  	</div>
			  </div>
			</div>
			<div class="field">
				<label class="label">Non-subject prerequisite</label>
				<div class="control">
					<input type="text" class="input" v-model.trim="form.nonSub_pre">
				</div>
			</div>
			<div class="field">
			  <label class="label">Corequisites</label>
			  <div class="control">
				  	<multiselect :multiple="true" v-model="form.coreq" track-by="subID" label="subCode" :options="coreqs"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.coreq}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Type</label>
			  <div class="control">
				  	<multiselect v-model="form.spec" track-by="specID" label="specDesc" :options="subject_types"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.spec}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Units</label>
			  <div class="columns">
			  	<div class="column is-half">
			  		<div class="control">
			  			<multiselect v-model="form.lec" track-by="unit" label="unit" :options="units" placeholder="Lecture"></multiselect>
			  		</div>
			  	</div>
			  	<div class="column">
			  		<div class="control">
			  			<multiselect v-model="form.lab" track-by="unit" label="unit" :options="units" placeholder="Laboratory"></multiselect>
			  		</div>
			  	</div>
			  </div>
			  	<p class="help has-text-danger">
					{{error.units}}
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
		    		title: 'Add Subject',
		    		list: '<?php echo base_url() ?>maintenance/subject',
		    		success: '<?php echo base_url() ?>maintenance/subject/form-success/'
		    	},

		    	form: {
		    		prospectus: null,
		    		year: null,
		    		sem: null,
		    		subCode: '',
		    		subDesc: '',
		    		lec: null,
		    		lab: null,
		    		nonSub_pre: '',
		    		pre: null,
		    		pre2: null,
		    		coreq: null,
		    		spec: null
		    	},
		    	error: {
		    		prospectus: '',
		    		year: '',
		    		sem: '',
		    		subCode: '',
		    		subDesc: '',
		    		units: '',
		    		pre: '',
		    		pre2: '',
		    		coreq: '',
		    		spec: ''
		    	},
		    	prospectuses: [],
		    	years: [],
		    	years2: [],
		    	sems: [],
		    	pres: [],
		    	coreqs: [],
		    	lecs: [],
		    	labs: [],
		    	specs: []

		    },
		    created(){
		    	this.populate2()
		    },
		    watch: {
		    	prospectus(val){
		    		this.form.year = null
		    		this.form.spec = null
		    		this.years = []
		    		
		    		if(val != null){
		    			this.fetchYears(val.prosID)
		    		}
		    	},
		    	year(val){
		    		this.form.sem = null
		    		this.sems = []

		    		if(val != null){
		    			this.fetchSemesters()
		    		}
		    	},
		    	sem(val){
		    		this.form.pre = null
		    		this.form.pre2 = null
		    		this.form.coreq = null

		    		this.pres = []
		    		this.years2 = []
		    		this.coreqs = []

		    		if(val != null){
		    			this.fetchReqs(this.prospectus.prosID,this.year.yearID,val.semID)
		    		}
		    	}
		    },
		    computed: {
		    	prospectus(){
		    		return this.form.prospectus
		    	},
		    	year(){
		    		return this.form.year
		    	},
		    	sem(){
		    		return this.form.sem	
		    	},
		    	units(){
		    		const units = []
		    		for(let i = 1; i < 10; ++i){
		    			units.push({unit: i})
		    		}
		    		return units
		    	},
		    	subject_types(){
		    		const specs = this.specs 
		    		const prosID = (this.form.prospectus) ? this.form.prospectus.prosID : 0
		    		return specs.filter(s => s.prosID == prosID)
		    	}
		    },
		    methods: {
		    	populate2(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/populate2')
		    		.then(response => {
		    			const c = response.body
		    			this.prospectuses = c.prospectus 
		    			this.specs = c.specs
		    		})
		    	},
		    	fetchProspectus(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_prospectuses')
		    		.then(response => {
		    			this.prospectuses = response.body
		    		})
		    	},
		    	fetchYears(prosID){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_years/' + prosID)
		    		.then(response => {
		    			this.years = response.body
		    		})
		    	},
		    	fetchSemesters(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_semesters')
		    		.then(response => {
		    			this.sems = response.body
		    		})
		    	},
		    	fetchReqs(prosID,yearID,semID){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_reqs/'+prosID+'/'+yearID+'/'+semID+'/'+0)
		    		.then(response => {
		    			const c = response.body
		    			console.log(c)
		    			this.pres = c
		    			this.coreqs = c
		    			this.years2 = this.years
		    		}, e => {
		    			console.log(e.body)

		    		})
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_subject/create',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)

			        		if(c == 'exist'){
			        			swal('Subject already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			window.location.href = this.page.success + c.id + '/' +c.prosID
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
		        	if(!f.subCode){
		        		this.error.subCode = errMsg
		        		ok = false
		        	}else{
		        		this.error.subCode = ''
		        	}
		        	if(!f.subDesc){
		        		this.error.subDesc = errMsg
		        		ok = false
		        	}else{
		        		this.error.subDesc = ''
		        	}
		        	if(f.prospectus == null){
		        		this.error.prospectus = errMsg
		        		ok = false
		        	}else{
		        		this.error.prospectus = ''
		        	}
		        	if(f.year == null){
		        		this.error.year = errMsg
		        		ok = false
		        	}else{
		        		this.error.year = ''
		        	}
		        	if(f.sem == null){
		        		this.error.sem = errMsg
		        		ok = false
		        	}else{
		        		this.error.sem = ''
		        	}
		        	if(f.prospectus == null){
		        		this.error.prospectus = errMsg
		        		ok = false
		        	}else{
		        		this.error.prospectus = ''
		        	}
		        	if(f.spec == null){
		        		this.error.spec = errMsg
		        		ok = false
		        	}else{
		        		this.error.spec = ''
		        	}
		        	if(!f.lec && !f.lab){
		        		this.error.units = errMsg
		        		ok = false
		        	}else{
		        		this.error.units = ''
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

