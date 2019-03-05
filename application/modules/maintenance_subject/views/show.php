<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
	.btn-height{
	    height: 40px;
	  }
	.btn-width{
		width: 50px;
	}
	.btn-width2{
		width: 60px;
	}
	.active-input{
		background-color: #f2f2f2 
	}
	.without_ampm::-webkit-datetime-edit-ampm-field {
	   display: none;
	 }
	 input[type=time]::-webkit-clear-button {
	   -webkit-appearance: none;
	   -moz-appearance: none;
	   -o-appearance: none;
	   -ms-appearance:none;
	   appearance: none;
	   margin: -10px; 
	 }
</style>

<div id="app" v-cloak>
<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Show</a></li>
		  </ul>
		</nav>
	</div>
	<div class="container" style="max-width: 600px;">
		<div class="columns">
			<div class="column">
				<div v-if="subjects.length < 2">
					<div v-if="open_txtUnit">
						<div class="columns">
							<div class="column">
								<multiselect placeholder="Enter # of units" v-model="units_to_add" track-by="unit" label="unit" :options="units"></multiselect>
							</div>
							<div class="column">
								<button @click="cancelAddUnit" class="button btn-height btn-width2">Cancel</button>
								<button @click="saveAddUnit" class="button is-link btn-height btn-width2" :disabled="units_to_add == null">Add</button>
							</div>
						</div>

					</div>
					<div v-else>
						<button @click="open_txtUnit = true" class="button is-primary btn-height" v-if="showBtn">Add Lecture</button>
						<button @click="open_txtUnit = true" class="button is-primary btn-height" v-else>Add Laboratory</button>
					</div>
				</div>
			</div>
			<div class="column is-2">
				<a :href="page.edit" class="button is-pulled-right btn-height">
					Edit Subject		
				</a>
			</div>
		</div>
		
		
		<div class="box" v-for="subject, i in subjects">
			<button class="button is-danger" @click="is_safe_delete(i)"> <i class="fa fa-trash"></i> </button>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Subject Code:</b> </td>
					<td> {{subject.subCode}} </td>
					<td></td>
				</tr>
				<tr>
					<td><b>Description:</b> </td>
					<td> {{subject.subDesc}} </td>
					<td></td>
				</tr>
				<tr>
					<td><b>Prospectus:</b> </td>
					<td> {{subject.prosCode}} </td>
					<td></td>
				</tr>
				<tr>
					<td><b>Units:</b> </td>
					<td colspan="2">
						<span v-if="!subject.updateUnit">
							<div class="columns">
								<div class="column">
									{{subject.units.unit}} 
								</div>
								<div class="column">
									<button @click="subject.updateUnit = true" class="button is-small is-pulled-right"> <i class="fa fa-pencil"></i> </button>
								</div>
							</div>
						</span>
						<span v-else>
							<div class="columns">
								<div class="column is-7">
									<multiselect :allow-empty="false" v-model="subject.units" track-by="unit" label="unit" :options="units"></multiselect>
								</div>
								<div class="column">
									<div class="is-pulled-right">
										<button @click="cancel_unit(i)" class="button is-small btn-width"> Cancel </button>	
										<button @click="save_unit(i)" class="button is-small btn-width is-success"> Save </button>	
									</div>
								</div>
							</div>
						</span>
					</td>
				</tr>
				<!-- <tr>
					<td><b>Units:</b> </td>
					<td>
						<span v-if="!subject.updateUnit">
							 {{subject.units.unit}} 
						</span>
						<span v-else>
							<multiselect :allow-empty="false" v-model="subject.units" track-by="unit" label="unit" :options="units"></multiselect>
						</span>
					</td>
					<td>
						<div v-if="!subject.updateUnit">
							<button @click="subject.updateUnit = true" class="button is-small is-pulled-right"> <i class="fa fa-pencil"></i> </button>	
						</div>
						<div v-else>
							<button @click="cancel_unit(i)" class="button is-small btn-width"> Cancel </button>	
							<button @click="save_unit(i)" class="button is-small btn-width is-success"> Save </button>	
						</div>
					</td>
				</tr> -->
				<tr>
					<td><b>Hours/Week:</b> </td>
					<td colspan="2">
						<span v-if="!subject.updateHrs">
							<div class="columns">
								<div class="column">
									{{subject.hrs_per_wk}} 
								</div>
								<div class="column">
									<button @click="subject.updateHrs = true" class="button is-small is-pulled-right"> <i class="fa fa-pencil"></i> </button>
								</div>
							</div>
						</span>
						<span v-else>
							<form @submit.prevent="save_hr(i)">
								<div class="columns">
									<div class="column is-7">
										<input type="time" v-model="subject.hrs_per_wk" class="input without_ampm" required>
									</div>
									<div class="column">
										<div class="is-pulled-right">
											<button type="button" @click="cancel_hr(i)" class="button is-small btn-width"> Cancel </button>	
											<button type="submit" class="button is-small btn-width is-success"> Save </button>	
										</div>
									</div>
								</div>
							</form>
							
						</span>
					</td>
				</tr>
				<tr>
					<td><b>Unit Type:</b></td>
					<td> {{subject.type}} </td>
					<td></td>
				</tr>
				<tr>
					<td><b>Year:</b> </td>
					<td> {{subject.yearDesc}} </td>
					<td></td>
				</tr>
				<tr>
					<td><b>Semester:</b> </td>
					<td> {{subject.semDesc}} </td>
					<td></td>
				</tr>
				<tr>
					<td><b>Prerequisite:</b> </td>
					<td> 
						 {{subject.year_req}}
						<span v-if="reqs.length != 0" v-for="req in reqs">
							<span v-if="req.req_type == 1">
								{{req.req_code}} &nbsp;
							</span>
						</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Non-subject prerequisite:</b> </td>
					<td> {{subject.nonSub_pre}} </td>
					<td></td>
				</tr>
				<tr>
					<td><b>Corequisite:</b> </td>
					<td>
						<span v-if="reqs.length != 0" v-for="req in reqs">
							<span v-if="req.req_type == 2">
								{{req.req_code}}
							</span>
						</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Subject Type:</b> </td>
					<td> {{subject.specDesc}} </td>
					<td></td>
				</tr>
			</table>
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
		    	updateUnit: false,
		    	open_txtUnit: false,
		    	units_to_add: null,
		    	id: '<?php echo $id ?>',
		    	prosID: '<?php echo $prosID ?>',
		    	page:{
		    		edit: '<?php echo base_url()."maintenance/subject/form/".$id."/".$prosID ?>',
		    		list: '<?php echo base_url() ?>maintenance/subject',
		    		current: '<?php echo base_url()."maintenance/subject/show/".$id."/".$prosID ?>'
		    	},
		    	subjects: [],
		    	reqs: []
		    },
		    created(){
		    	this.populate()
		    },	
		    computed: {
		    	units(){
		    		const units = []
		    		for(let i = 1; i < 10; ++i){
		    			units.push({unit: i})
		    		}
		    		return units
		    	},
		    	showBtn(){
		    		let x = false 
		    		const subjects = this.subjects
		    		for(let a of subjects){
		    			if(a.type == 'lab'){
		    				x = true
		    			}
		    		}
		    		return x
		    	}
		    },
		    methods: {
		    	cancelAddUnit(){
		    		this.units_to_add = null 
		    		this.open_txtUnit = false
		    	},
		    	saveAddUnit(){
		    		let val = 'lab'
		    		if(this.showBtn){
		    			val = 'lec'
		    		}
		    		const data = {
		    			units: this.units_to_add.unit,
		    			id: this.id,
		    			prosID: this.prosID,
		    			type: val
		    		}
		    		this.$http.post('<?php echo base_url() ?>maintenance_subject/saveAddUnit', data)
		        	.then(response => {
		        		console.log(response.body)
		        		
		        		swal('Success','','success').then((x) => {
						  window.location.href = this.page.current
						})
					 }, e => {
					 	console.log(e.body)
					 })
		    	},
		    	save_unit(i){
		    		const subject = this.subjects[i]
		    		subject.updateUnit = false 
		    		subject.units2 = subject.units
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/save_unit/'+subject.units.unit+'/'+subject.subID)
		        	.then(response => {
		        		console.log(response.body)
		        		
					 }, e => {
					 	console.log(e.body)
					 })
		    	},
		    	cancel_hr(i){
		    		const subject = this.subjects[i]
		    		subject.updateHrs = false 
		    		subject.hrs_per_wk = subject.hrs2
		    	},
		    	save_hr(i){
		    		const subject = this.subjects[i]
		    		subject.updateHrs = false 
		    		subject.hrs2 = subject.hrs_per_wk
		    		console.log(subject.hrs_per_wk);
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/save_hr/'+subject.hrs_per_wk+'/'+subject.subID)
		        	.then(response => {
		        		console.log(response.body)
		        		
					 }, e => {
					 	console.log(e.body)
					 })
		    	},
		    	cancel_unit(i){
		    		const subject = this.subjects[i]
		    		subject.updateUnit = false 
		    		subject.units = subject.units2
		    	},
		    	populate(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/populateShow/'+this.id+'/'+this.prosID)
		        	.then(response => {
		        		console.log(response.body)
		        		const c = response.body
		        		this.subjects = c.sub.map(k => {
		        			k.updateHrs = false
		        			k.updateUnit = false
		        			k.units = {unit: k.units}
		        			k.units2 = k.units
		        			k.hrs2 = k.hrs_per_wk
		        			return k
		        		})
		        		this.reqs = c.reqs
					 }, e => {
					 	console.log(e.body)

					 })
		    	},
		    	fetch_requisites(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_requisites/'+this.subID)
		        	.then(response => {
		        		console.log(response.body)
		        		this.reqs = response.body
					 })
		    	},
		    	is_safe_delete(i){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/is_safe_delete/' + id + '/' + this.prosID)
		        	.then(response => {
		        		const c = response.body
		        		console.log(c);
		        		if(c == 1){
		        			swal({
							  title: "Are you sure?",
							  text: "Once deleted, you will not be able to recover this record!",
							  icon: "warning",
							  buttons: {
							  	cancel: true,
							  	confirm: {
							  		closeModal: false
							  	}
							  },
							  dangerMode: true
							})
							.then((willDelete) => {
							  if (willDelete) {
							    this.deleteRec(i)
							  }
							})
		        		}else{
		        			swal("Unable to delete", "Subject has record in other modules!", "error")
		        		}
					 }, e => {
					 	console.log(e.body)

					 })
		    	},
		    	deleteRec(i){
		    		const subID = this.subjects[i].subID
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/delete/'+subID)
		        	.then(response => {
		        		this.subjects.splice(i, 1)
		        		swal('Success','Poof! record has been deleted!', 'success').then((x) => {
						  if(this.subjects.length == 0){
						  	window.location.href = this.page.list
						  }
						})
					 }, e => {
					 	console.log(e.body)

					 })
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
