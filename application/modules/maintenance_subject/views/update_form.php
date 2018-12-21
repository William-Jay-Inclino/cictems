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
			  	<div class="column is-half">
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
				  	<multiselect v-model="form.spec" track-by="specID" label="specDesc" :options="specs"></multiselect>
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
		    		title: 'Update Subject',
		    		list: '<?php echo base_url() ?>maintenance/subject',
		    		show: '<?php echo base_url()."maintenance/subject/show/".$id."/" ?>'
		    	},

		    	form: {
		    		id: '<?php echo $id ?>',
		    		subID: '<?php echo $records[0]->subID ?>',
		    		prospectus: {prosID: '<?php echo $prosID ?>', prosCode: '<?php echo $records[0]->prosCode ?>'},
		    		year: {yearID: '<?php echo $records[0]->yearID ?>', yearDesc: '<?php echo $records[0]->yearDesc ?>'},
		    		sem: {semID: '<?php echo $records[0]->semID ?>', semDesc: '<?php echo $records[0]->semDesc ?>'},
		    		subCode: '<?php echo $records[0]->subCode ?>',
		    		subDesc: '<?php echo $records[0]->subDesc ?>',
		    		nonSub_pre: '<?php echo $records[0]->nonSub_pre ?>',
		    		pre: null,
		    		pre2: null,
		    		coreq: null,
		    		spec: {specID: '<?php echo $records[0]->specID ?>', specDesc: '<?php echo $records[0]->specDesc ?>'},
		    	},
		    	error: {
		    		prospectus: '',
		    		year: '',
		    		sem: '',
		    		subCode: '',
		    		subDesc: '',
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
		    	this.populate()
		    	//this.fetchYearReq()
		    	//this.fetchProspectus()
		    	this.fetchYears(f.prospectus.prosID)
		    	this.fetchSemesters(f.year.yearID)
		    	this.fetchReqs(f.prospectus.prosID,f.year.yearID,f.sem.semID)
		    	//this.fetch_requisites()
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
		    	populate(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/populate/'+this.form.subID)
		    		.then(response => {
		    			const c = response.body
		    			console.log(c)
		    			this.specs = c.specs
		    			if(c.yearReq){
		    				this.form.pre2 = {yearID: c.yearReq.yearID, yearDesc: c.yearReq.yearDesc}
		    			}
		    			this.prospectuses = c.prospectus 
		    			const reqs = c.reqs 
		        		const arr = []
		        		const arr2 = []
		        		for(x of reqs){
		        			if(x.req_type == 1){
		        				arr.push({subID: x.req_subID, subCode: x.req_code})
		        			}else{
		        				arr2.push({subID: x.req_subID, subCode: x.req_code})
		        			}
		        		}
		        		this.form.pre = arr
		        		this.form.coreq = arr2

		    		}, e => {
		    			console.log(e.body)
		    			//this.populate()
		    		})
		    	},
		    // 	fetch_requisites(){
		    // 		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_requisites/'+this.form.id)
		    //     	.then(response => {
		    //     		const c = response.body
		    //     		const arr = []
		    //     		const arr2 = []
		    //     		for(x of c){
		    //     			if(x.req_type == 1){
		    //     				arr.push({subID: x.req_subID, subCode: x.req_code})
		    //     			}else{
		    //     				arr2.push({subID: x.req_subID, subCode: x.req_code})
		    //     			}
		    //     		}
		    //     		this.form.pre = arr
		    //     		this.form.coreq = arr2
					 // })
		    // 	},
		    // 	fetchYearReq(){
		    // 		this.$http.get('<?php echo base_url() ?>maintenance_subject/fetchYearReq/' + this.form.id)
		    // 		.then(response => {
		    // 			const c = response.body
		    // 			if(c){
		    // 				this.form.pre2 = {yearID: c.yearID, yearDesc: c.yearDesc}
		    // 			}
		    // 		})
		    // 	},
		    // 	fetchProspectus(){
		    // 		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_prospectuses')
		    // 		.then(response => {
		    // 			this.prospectuses = response.body
		    // 		})
		    // 	},
		    	fetchYears(prosID){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_years/' + prosID)
		    		.then(response => {
		    			this.years = response.body

		    		}, e => {
		    			this.fetchYears(prosID)
		    		})
		    	},
		    	fetchSemesters(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_semesters')
		    		.then(response => {
		    			this.sems = response.body
		    		}, e => {
		    			this.fetchSemesters()
		    		})
		    	},
		    	fetchReqs(prosID,yearID,semID){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_reqs/'+prosID+'/'+yearID+'/'+semID+'/'+this.form.id)
		    		.then(response => {
		    			const c = response.body
		    			this.years2 = this.years
		    			this.pres = c
		    			this.coreqs = c
		    			
		    			//console.log(this.years2)
		    		}, e => {
		    			console.log(e.body)
		    			//this.fetchReqs(prosID,yearID,semID)
		    		})
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_subject/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c == 'exist'){
			        			swal('Subject already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			swal('Subject successfull updated', {
							      icon: 'success',
							    }).then((x) => {
								  if (x) {
								    window.location.href = this.page.show + f.prospectus.prosID
								  }
								})
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

