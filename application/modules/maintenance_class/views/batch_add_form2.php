<style>
	.err{
		color: red;
	}
</style>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<section id="app" class="section" v-cloak>
	<div class="container">

		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Add Form</a></li>
		  </ul>
		</nav>
		
		<div class="box">
			<div class="columns">
				<div class="column">
					<label class="label">Term</label>
					<multiselect @input="changeOption" v-model="current_term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
				</div>
				<div class="column">
					<label class="label">Prospectus</label>
					<multiselect v-model="prospectus" track-by="prosID" label="prosCode" :options="prospectuses"></multiselect>
				</div>
				<div class="column">
					<label class="label">Year</label>
					<multiselect v-model="year" track-by="yearID" label="yearDesc" :options="years"></multiselect>
				</div>
			</div>
		</div>
		<div class="box" v-show="ready">
			<div class="column is-4">
				<label class="label">Section</label>
				<multiselect v-model="section" track-by="secID" label="secName" :options="sections" placeholder="Select Section"></multiselect>
				<p class="help has-text-danger" v-if="errSection"> This field is required </p>
			</div>
			<hr>
			<table class="table is-fullwidth is-centered">
				<thead>
					<tr>
						<th width="10%">Code</th>
						<th width="25%">Description</th>
						<th width="20%" colspan="2">Time</th>
						<th width="10%">Day</th>
						<th width="15%">Room</th>
						<th width="20%">Instructor</th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<th>In</th>
						<th>Out</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="record, i in classes" :class="{err: record.error}">
						<td>{{record.subCode}}</td>
						<td>{{record.subDesc}}</td>
						<td> <input v-model="record.timeIn" type="time" class="input"> </td>
						<td> <input v-model="record.timeOut" type="time" class="input"> </td>
						<td>
							<multiselect v-model="record.day" track-by="dayID" label="dayDesc" :options="days" placeholder=""></multiselect>
						</td>
						<td>
							<multiselect v-model="record.room" track-by="roomID" label="roomName" :options="rooms" placeholder=""></multiselect>
						</td>
						<td>
							<multiselect v-model="record.faculty" track-by="facID" label="faculty" :options="faculties" placeholder=""></multiselect>
						</td>
						<td>
							<button class="button" @click="changeStatus2(record.status2, i)">
								<span v-if="record.status2 == 0">
									<i class="fa fa-check has-text-primary"></i>
								</span>
								<span v-else>
									<i class="fa fa-times has-text-danger"></i>
								</span>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<button :class="{'button is-link is-pulled-right': true, 'is-loading': isLoading}" @click="submitForm" v-if="classes.length > 0">Submit</button>
			<br><br>
		</div>
	</div>

</section>






<script>

document.addEventListener('DOMContentLoaded', function() {
	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	page:{
	    		title: 'Add Classes',
	    		list: '<?php echo base_url() ?>maintenance/class',
	    		success: '<?php echo base_url() ?>maintenance/class/success/'
	    	},
	    	isLoading: false,
	    	ready: false,
	    	current_term: {termID: '<?php echo $current_term->termID; ?>', term: '<?php echo $current_term->term; ?>'},
	    	prospectus: null,
	    	year: null,
	    	section: null,
	        terms: [],
	        prospectuses: [],
	        years: [],
	        classes: [],
	        days: [],
	        rooms: [],
	        faculties: [],
	        sections: [],
	    	errSection: false
	    },
	    created() {
	        this.populate()
	    },
	    watch: {
	    	prospectus(val){
	    		this.year = null
	    		this.years = []
	    		if(val != null){
	    			this.fetchYear(val.prosID)
	    		}
	    	},
	    	year(val){
	    		if(val == null){
	    			this.classes = []
	    			this.ready = false
	    		}else{
	    			this.ready = true
	    			this.fetchClasses()
	    		}
	    	}
	    },
	    computed: {

	    },
	    methods: {
	    	changeOption(){
	    		if(this.prospectus == null || this.year == null){
	    			this.classes = []
	    			this.ready = false
	    		}else{
	    			this.ready = true
	    			this.fetchClasses()
	    		}
	    	},
	        populate() {
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/populate')
	        	.then(response => {
	        		const c = response.body
	        		this.terms = c.term
	        		this.prospectuses = c.prospectus
	        		this.days = c.days 
	        		this.rooms = c.rooms 
	        		this.faculties = c.faculties
	        		this.sections = c.sections
				 })
	        },
	        fetchYear(prosID){
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/fetchYear/' + prosID)
	        	.then(response => {
	        		this.years = response.body
				 })
	        },
	        fetchClasses(){
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/fetchClasses/' + this.year.yearID +'/'+ this.prospectus.prosID +'/'+this.current_term.termID)
	        	.then(response => {
	        		this.prepareForm(response.body)
				 })
	        },
	        prepareForm(classes){
	        	const arr = []
	        	for(c of classes){
	        		arr.push({
	        			subID: c.subID,
	        			subCode: c.subCode,
	        			subDesc: c.subDesc,
	        			day: '',
	        			timeIn: '',
	        			timeOut: '',
	        			room: '',
	        			faculty: '',
	        			status2: 0,
	        			error: false
	        		})
	        	}
	        	this.classes = arr
	        },
	        changeStatus2(val, i){
	        	if(val == 0){
	        		this.classes[i].status2 = 1
	        	}else{
	        		this.classes[i].status2 = 0
	        	}
	        },
	        submitForm(){
	        	this.isLoading = true
	        	const c = this.classes 
	        	if(this.checkForm(c)){
	        		this.$http.post('<?php echo base_url() ?>maintenance_class/create_batch', {termID: this.current_term.termID, secID: this.section.secID, classes: c})
		        	.then(response => {
		        		const c = response.body
		        		if(c == ''){
		        			window.location.href = this.page.success + this.section.secID + '/' + this.current_term.termID
						    // this.ready = false 
						    // this.year = null
						    // this.section = null
						    
		        		}else{
		        			swal(c, {
						      icon: 'error',
						    });
						    this.isLoading = false
		        		}
		        		
					 })
	        	}else{
	        		swal('All fields are required!','Please review the form', {
				      icon: 'error',
				    });
				    this.isLoading = false
	        	}

	        },
	        checkForm(classes){
	        	let ok = true
	        	if(this.section == null){
	        		ok = false
	        		this.errSection = true
	        	}else{
	        		this.errSection = false
	        	}
	        	for(c of classes){
	        		if((!c.timeIn || !c.timeOut || c.room == null || c.day == null || c.faculty == null) && c.status2 == 0){
	        			c.error = true
	        			ok = false
	        		}else{
	        			c.error = false
	        		}
	        	}
	        	return ok
	        }

	    },

		   http: {
            emulateJSON: true,
            emulateHTTP: true
    		}
	})

}, false)



</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>