<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
	.my-btn{
		width: 65px
	}
</style>

<div id="app" v-cloak>
	<section class="section">
		<div class="container">
			<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
			  <ul>
			    <li><a :href="page.list">List</a></li>
			    <li><a :href="page.show">Show</a></li>
			    <li class="is-active"><a href="#" aria-current="page">Involved Students</a></li>
			  </ul>
			</nav>
		</div>
	</section>
	<div class="container" style="max-width: 1000px;">
		<div class="box">
			<h5 class="title is-5">Fee Info</h5>
			<hr>	
			<table class="table is-fullwidth">
				<thead>
					<th>Name of fee</th>
					<th>Description</th>
					<th>Amount</th>
					<th>Due date</th>
					<th>Status</th>
				</thead>
				<tbody>
					<td> <?php echo $record->feeName ?> </td>
					<td> <?php echo $record->feeDesc ?> </td>
					<td> <?php echo $record->amount ?> </td>
					<td> <?php echo $record->dueDate ?> </td>
					<td> 
						<?php 
							if($record->feeStatus == 'ongoing'){
								echo "<span class='tag is-link'>On going</span>";
							}else if($record->feeStatus == 'done'){
								echo "<span class='tag is-success'>Done</span>";
							}else{
								echo "<span class='tag is-danger'>Cancelled</span>";
							}
						?> 
					</td>
				</tbody>
			</table>
		</div>
		<div class="box">
			<h5 class="title is-5">Filter</h5>
			<hr>	
			<div class="columns">
				<div class="column">
					<multiselect v-model="course" track-by="courseID" label="courseCode" :options="courses" :multiple="true" placeholder="Filter course"></multiselect>
				</div>
				<div class="column">
					<multiselect v-model="year" track-by="yearID" label="yearDesc" :options="years" :multiple="true" placeholder="Filter year"></multiselect>
				</div>
				<div class="column is-3">
					<button :class="{'button is-primary my-btn': true, 'is-loading': is_generating}" @click="generateFilter" :disabled="filter_is_ready">Add</button>
					<button :class="{'button is-danger my-btn': true, 'is-loading': is_removing}" @click="removeFilter" :disabled="filter_is_ready">Remove</button>
				</div>
			</div>
		</div>
		<div class="box">
			<h5 class="title is-5">Involved Students</h5>
			<hr>
			<div class="columns">
				<div class="column">
					<multiselect v-model="tba_students" track-by="studID" label="name" :options="search_stud_res" :multiple="true" placeholder="Enter name / control number" :loading="isLoading" :internal-search="false" @search-change="searchStudents"></multiselect>
				</div>
				<div class="column is-2">
					<button :class="{'button is-link': true, 'is-loading': is_adding}" @click="addStudents" :disabled="add_is_ready">Add Student/s</button>
				</div>
			</div>
			
			<hr>
			<table class="table is-fullwidth">
				<thead>
					<th>Control no.</th>
					<th>Name</th>
					<th>Course</th>
					<th>Year</th>
					<th style="text-align: center">Remove</th>
				</thead>
				<tbody>
					<tr v-for="student, i of involved_students">
						<td> {{student.controlNo}} </td>
						<td> {{student.name}} </td>
						<td> {{student.courseCode}} </td>
						<td> {{student.yearDesc}} </td>
						<td style="text-align: center">
							<button class="button is-danger is-small is-outlined" @click="removeStud(i)">
								<i class="fa fa-times"></i>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<br><br><br><br>

<script>

document.addEventListener('DOMContentLoaded', function() {
	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	page:{
	    		show: '<?php echo base_url()."maintenance/fees/show/".$record->feeID ?>',
	    		list: '<?php echo base_url()?>maintenance/fees'
	    	},
	    	isLoading: false,
	    	is_generating: false,
	    	is_removing: false,
	    	is_adding: false,
	    	id: '<?php echo $record->feeID ?>',
	    	termID: '<?php echo $record->termID ?>',
	    	amount: '<?php echo $record->amount ?>',
	       	course: [],
	       	year: [],
	       	tba_students: [],
	       	search_stud_res: [],
	       	courses: [],
	       	years: [],
	       	involved_students: []
	    },
	    created() {
	    	this.populate()
	    },
	    watch: {
	    
	    },
	    computed: {
	    	filter_is_ready(){
	    		let x = false 
	    		if(this.course.length == 0 && this.year.length == 0){
	    			x = true
	    		}
	    		return x
	    	},
	    	add_is_ready(){
	    		let x = false 
	    		if(this.tba_students.length == 0){
	    			x = true 
	    		}
	    		return x
	    	}
	    },
	    methods: {
	    	populate(){
	    		this.$http.get('<?php echo base_url() ?>maintenance_fees/populate/'+this.id)
		        	.then(response => {
		        		const c = response.body
		        		this.courses = c.courses 
		        		this.years = c.years
		        		this.involved_students = c.involved_students
					 }, e => {
					 	console.log(e.body)
				})
		    },
		    searchStudents(value){
		    	if(value.trim() != ''){
		            this.isLoading = true
		            value = value.replace(/\s/g, "_")
		            this.$http.get('<?php echo base_url() ?>maintenance_fees/search_student/'+value+'/'+this.termID)
		            .then(response => {
		               this.isLoading = false
		               this.search_stud_res = response.body
		            }, e => {
		            	console.log(e.body)

		            })
		         }
		    },
		    generateFilter(){
		    	//if(this.course == null && this.year == null){
		    		//swal('Warning', 'Please add some filters!', 'warning')
		    	//}else{
		    		this.is_generating = true
			    	this.$http.post('<?php echo base_url() ?>maintenance_fees/generateFilter',{courses: this.course, years: this.year, termID: this.termID, feeID: this.id})
			        	.then(response => {
			        		const c = response.body

			        		swal('Success','Existing student/s will not be added. Added students: '+c.total_added,'success')
			        		this.involved_students = c.involved_students
			        		this.is_generating = false
						 }, e => {
						 	console.log(e.body)
					})
		    	//}
		    	
		    },
		    removed_studs(){
	    		const amount = this.amount
	    		const students = this.involved_students 
	    		const filtered_courses = this.course
	    		const filtered_years = this.year	    
	    		const removed_studs = []	
	    		const fc_len = filtered_courses.length
	    		const fy_len = filtered_years.length

	    		if(students){
	    			for(let student of students){
	    				let has_course = false 
	    				let has_year = false

		    			if(fc_len > 0){
			    			for(let fc of filtered_courses){
			    				if(student.courseID == fc.courseID){
			    					has_course = true 
			    					break
			    				}
			    			}
			    		}

			    		if(fy_len > 0){
			    			for(let fy of filtered_years){
			    				if(student.yearID == fy.yearID){
			    					has_year = true 
			    					break
			    				}
			    			}
			    		}

			    		if(fc_len == 0 && fy_len > 0){
			    			if(has_year && amount == student.payable){
			    				removed_studs.push(student.studID)
			    			}
			    		}else if(fc_len > 0 && fy_len == 0){
			    			if(has_course && amount == student.payable){
			    				removed_studs.push(student.studID)
			    			}
			    		}else{
			    			if((has_year && has_course) && amount == student.payable){
			    				removed_studs.push(student.studID)
			    			}
			    		}

		    		}

	    		}
	    		
	    		return removed_studs

	    	},
		    removeFilter(){
	    		const removed_studs = this.removed_studs()
	    		swal('Success','Only students that is unpaid are removed. Removed students: '+removed_studs.length,'success')
        		this.involved_students = this.involved_students.filter(value => !removed_studs.includes(value.studID))

		    	this.$http.post('<?php echo base_url() ?>maintenance_fees/removeFilter',{removed_studs: removed_studs, feeID: this.id})
		        	.then(response => {

					 }, e => {
					 	console.log(e.body)
				})
		    },
		    addStudents(){
		    	const tba_students = this.tba_students
		    	//if(tba_students){
		    		this.is_adding = true
			    	this.$http.post('<?php echo base_url() ?>maintenance_fees/addStudents', {feeID: this.id, tba_students: tba_students})
			        	.then(response => {
			        		this.is_adding = false
			        		const c = response.body

			        		swal('Success','Existing student/s will not be added. Added students: '+c.total_added,'success')
			        		this.involved_students = c.involved_students
			        		this.tba_students = [] 
		    				this.search_stud_res = []
						 }, e => {
						 	console.log(e.body)
					})
			    // }else{
			    // 	swal('No student/s to add!', {icon: 'warning'})
			    // }
		    },
		    removeStud(i){
		    	const student = this.involved_students[i]

		    	if(student.payable == this.amount){
		    		swal({
					  title: "Confirmation",
					  text: "Are you sure you want to remove "+student.name+'?',
					  icon: "warning",
					  buttons: {
					  	cancel: true,
					  	confirm: {
					  		closeModal: false
					  	}
					  },
					  dangerMode: true
					})
					.then((remove) => {
					  if (remove) {
						  	this.$http.post('<?php echo base_url() ?>maintenance_fees/removeStud', {feeID: this.id, studID: student.studID})
				        	.then(response => {
				        		this.involved_students.splice(i, 1)
				        		swal('Poof! Successfully removed '+student.name+'!', {icon: 'success'})
							 }, e => {
							 	console.log(e.body)
							})		    
					  }
					})

		    	}else{
		    		swal('Unable to remove!', "Student's status must be unpaid in order to remove", 'error')
		    	}

		    	
		  
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