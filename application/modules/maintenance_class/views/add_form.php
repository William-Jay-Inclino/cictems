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
			<h5 class="title is-4 has-text-primary" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<div class="field">
			  <label class="label">Term</label>
			  <div class="control">
				  	<multiselect v-model="form.term" track-by="termID" label="term" :options="terms"></multiselect>
			  </div>
			  <p class="help has-text-danger">{{error.term}}</p>
			</div>

			
			<div class="field">
			  <label class="label">Prospectus</label>
			  <div class="control">
			  		<multiselect v-model="form.pros" track-by="prosID" label="prosCode" :options="prospectuses"></multiselect>
			  </div>
			</div>

			<div class="field">
			  <label class="label">Subject</label>
			  <div class="control">
			   <multiselect v-model="form.code" label="subCode" track-by="subID" placeholder="Search subject" :options="subjects" :loading="isLoading" :internal-search="false" @search-change="fetchSubjects" :disabled="isDisabled">
               </multiselect>
			  </div>
			  <p class="help has-text-danger">
					{{error.subject}}
			  </p>
			</div>

			<div class="field">
			  <label class="label">Day</label>
			  <div class="control">
			    <multiselect v-model="form.day" track-by="dayID" label="dayDesc" :options="days"></multiselect>
			  </div>
			  <p class="help has-text-danger">
			  	 {{error.day}}
			  </p>
			</div>

			<div class="field">
				<div class="columns">
					<div class="column is-half">
						<label class="label">Time in</label>
						<div class="control">
							<input class="input" type="time"  v-model="form.time_in">
						</div>
						<p class="help has-text-danger">
					  	 {{error.timeIn}}
					  </p>
					</div>
					<div class="column">
						<label class="label">Time Out</label>
						<div class="control">
							<input class="input" type="time"  v-model="form.time_out">
						</div>
						<p class="help has-text-danger">
					  	 {{error.timeOut}}
					  </p>
					</div>
				</div>
			</div>

			<div class="field">
				<label class="label">Room</label>
				<div class="control">
					<multiselect v-model="form.room" track-by="roomID" label="roomName" 
					:options="rooms"></multiselect>
				</div>
				<p class="help has-text-danger">
					{{error.room}}
				</p>
			</div>
			
			<div class="field">
				<label class="label">Faculty</label>
				<div class="control">
					<multiselect v-model="form.faculty" track-by="facID" label="faculty" 
					:options="faculties"></multiselect>
				</div>
				<p class="help has-text-danger">
					{{error.faculty}}
				</p>
			</div>

			<div class="field">
				<label class="label">Section</label>
				<div class="control">
					<multiselect v-model="form.section" track-by="secID" label="secName" 
					:options="sections" required></multiselect>
				</div>
				<p class="help has-text-danger">
					{{error.section}}
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
		    	isLoading: false,
		    	isDisabled: true,
		    	page:{
		    		title: 'Add Class',
		    		list: '<?php echo base_url() ?>maintenance/class',
		    		success: '<?php echo base_url() ?>maintenance/class/form-success/'
		    	},
	    		prospectus: {prosID: 0, prosCode: ''},
		    	form: {
		    		term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
		    		code: null,
		    		pros: null,
		    		day: null,
		    		time_in: '',
		    		time_out: '',
		    		room: null,
		    		faculty: null,
		    		section: null
		    	},
		    	error: {
		    		term: '',
		    		subject: '',
		    		day: '',
		    		timeIn: '',
		    		timeOut: '',
		    		room: '',
		    		faculty: '',
		    		section: ''
		    	},
		    	terms: [],
		    	prospectuses: [],
		    	subjects: [],
		    	rooms: [],
		    	days: [],
		    	faculties: [],
		    	sections: []
		    },
		    created(){
		    	this.populate()
		    },
		    computed: {
			    pros(){
			    	return this.form.pros
			    }
			},
			watch: {
				pros(val){
					this.form.code = null
					if(val == null){
						this.isDisabled = true
					}else{
						this.isDisabled = false
					}
				}
		    },
		    methods: {
		    	populate(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_class/populate')
		        	.then(response => {
		        		const c = response.body
		        		this.terms = c.term
		        		this.prospectuses = c.prospectus
		        		this.rooms = c.rooms
		        		this.days = c.days
		        		this.faculties = c.faculties
		        		this.sections = c.sections
					 });
		    	},
		        fetchSubjects(value) {
		        	if(value.trim() != ''){
			            this.isLoading = true
			            value = value.replace(/\s/g, "_")
			            this.$http.get('<?php echo base_url() ?>maintenance_class/get_subjects/'+value+'/'+this.form.pros.prosID)
			            .then(response => {
			               this.isLoading = false
			               this.subjects = response.body
			            })
			         }else{
			            this.subjects = []
			         }
		        },
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_class/create',f)
			        	.then(response => {
			        		const c = response.body
			        		if(c == 'exist'){
			        			swal('Class already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			window.location.href = this.page.success + c
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
		        	const msg = 'This field is required'

        			if(f.term == null){
        				this.error.term = msg;
        				ok = false
        			}else{
        				this.error.term = '';
        			}
        			if(f.code == null){
        				this.error.subject = msg;
        				ok = false
        			}else{
        				this.error.subject = '';
        			}
        			if(f.day == null){
        				this.error.day = msg;
        				ok = false
        			}else{
        				this.error.day = '';
        			}
        			if(!f.time_in){
        				this.error.timeIn = msg;
        				ok = false
        			}else{
        				this.error.timeIn = '';
        			}
        			if(!f.time_out){
        				ok = false
        				this.error.timeOut = msg;
        			}else{
        				this.error.timeOut = '';
        			}
        			if(f.room == null){
        				ok = false
        				this.error.room = msg;
        			}else{
        				this.error.room = '';
        			}
        			if(f.faculty == null){
        				ok = false
        				this.error.faculty = msg;
        			}else{
        				this.error.faculty = '';
        			}
        			if(f.section == null){
        				ok = false
        				this.error.section = msg;
        			}else{
        				this.error.section = '';
        			}

        			return ok

		        },
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

