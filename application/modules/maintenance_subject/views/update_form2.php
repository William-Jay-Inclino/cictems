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
			<h5 class="title is-4 has-text-primary has-text-centered">{{ page.title }}</h5>
			<hr>
			<div class="field">
			  <label class="label">Subject Code</label>
			  <div class="control">
				  	<input class="input" type="text" v-model.trim="form.subCode" required pattern="^[a-zA-Z0-9][a-zA-Z0-9\s]*" title="Must only contain alpha-numeric characters and spaces.">
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
				  	<multiselect v-bind="override" v-model="form.prospectus" track-by="prosID" label="prosCode" :options="prospectuses"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.prospectus}}
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
			<div class="field">
			  <label class="label">Prerequisites</label>
			  <div class="columns">
			  	<div class="column is-half">
			  		<div class="control">
			  			<multiselect v-bind="override" :multiple="true" v-model="form.pre" track-by="subID" label="subCode" :options="pres" placeholder="Subject"></multiselect>
			  		</div>
			  		<p class="help has-text-danger">
						{{error.pre}}
					</p>
			  	</div>
			  	<div class="column">
			  		<div class="control">
			  			<multiselect v-bind="override" v-model="form.pre2" track-by="yearID" label="yearDesc" :options="years2" placeholder="Yearlevel"></multiselect>
			  		</div>
			  		<p class="help has-text-danger">
						{{error.pre2}}
					</p>
			  	</div>
			  </div>
			</div>
			<div class="field">
			  <label class="label">Corequisites</label>
			  <div class="control">
				  	<multiselect v-bind="override" :multiple="true" v-model="form.coreq" track-by="subID" label="subCode" :options="coreqs"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.coreq}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Type</label>
			  <div class="control">
				  	<multiselect v-bind="override" v-model="form.spec" track-by="specID" label="specDesc" :options="specs"></multiselect>
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
			  			<input type="number" class="input" v-model.number.trim="form.lec" onpaste="return false;" onKeyPress="if(this.value.length==1 && event.keyCode>47 && event.keyCode < 58)return false;" placeholder="Lecture">
			  		</div>
			  	</div>
			  	<div class="column">
			  		<div class="control">
			  			<input type="number" class="input" v-model.number.trim="form.lab" onpaste="return false;" onKeyPress="if(this.value.length==1 && event.keyCode>47 && event.keyCode < 58)return false;" placeholder="Laboratory">
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
		    	override : {
		    		tabIndex: 0
		    	},
		    	page:{
		    		title: 'Update Subject',
		    		list: '<?php echo base_url() ?>maintenance/subject',
		    		show: '<?php echo base_url()."maintenance/subject/show/".$record->subID ?>'
		    	},

		    	form: {
		    		id: '<?php echo $record->subID ?>',
		    		prospectus: {prosID: '<?php echo $record->prosID ?>', prosCode: '<?php echo $record->prosCode ?>'},
		    		year: {yearID: '<?php echo $record->yearID ?>', yearDesc: '<?php echo $record->yearDesc ?>'},
		    		sem: {semID: '<?php echo $record->semID ?>', semDesc: '<?php echo $record->semDesc ?>'},
		    		subCode: '<?php echo $record->subCode ?>',
		    		subDesc: '<?php echo $record->subDesc ?>',
		    		lec: '<?php echo $record->lec ?>',
		    		lab: '<?php echo $record->lab ?>',
		    		pre: null,
		    		pre2: null,
		    		coreq: null,
		    		spec: {specID: '<?php echo $record->specID ?>', specDesc: '<?php echo $record->specDesc ?>'},
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
		    	const f = this.form
		    	this.fetchYearReq()
		    	this.fetchProspectus()
		    	this.fetchYears(f.prospectus.prosID)
		    	this.fetchSemesters(f.year.yearID)
		    	this.fetchReqs(f.prospectus.prosID,f.year.yearID,f.sem.semID)
		    	this.fetch_requisites()
		    },
		    watch: {
		    	prospectus(val){
		    		this.form.year = null
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
		    	}
		    },
		    methods: {
		    	fetch_requisites(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_requisites/'+this.form.id)
		        	.then(response => {
		        		const c = response.body
		        		const arr = []
		        		const arr2 = []
		        		for(x of c){
		        			if(x.req_type == 1){
		        				arr.push({subID: x.req_subID, subCode: x.req_code})
		        			}else{
		        				arr2.push({subID: x.req_subID, subCode: x.req_code})
		        			}
		        		}
		        		this.form.pre = arr
		        		this.form.coreq = arr2
					 })
		    	},
		    	fetchYearReq(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/fetchYearReq/' + this.form.id)
		    		.then(response => {
		    			const c = response.body
		    			if(c){
		    				this.form.pre2 = {yearID: c.yearID, yearDesc: c.yearDesc}
		    			}
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
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_reqs/'+prosID+'/'+yearID+'/'+semID)
		    		.then(response => {
		    			const c = response.body
		    			this.years2 = this.years
		    			this.pres = c
		    			this.coreqs = c
		    			
		    			//console.log(this.years2)
		    		})
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_subject/update',f)
			        	.then(response => {
			        		const c = response.body
			        		if(c == 'exist'){
			        			swal('Subject already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			swal('Subject successfull updated', {
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

