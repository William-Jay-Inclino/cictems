<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
	.row-12{
		width: 12%
	}
</style>

<section id="app" class="section" v-cloak>
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.main">Main</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Selected Class</a></li>
		  </ul>
		</nav>
		<br>

		<button class="button is-primary" v-on:click="add_student_modal = true" v-if="cs.status == 'unlocked'">
			Add student to class
		</button>
		<button class="button is-link is-pulled-right" v-on:click="finGrade" v-if="cs.status == 'unlocked' && studLength > 0">Finalize Grades</button>
		<div v-if="cs.status == 'locked'" class="is-pulled-right">
			<h5 class="title is-5 has-text-success"> <i class="fa fa-check"></i> Submitted</h5>
			{{cs.date_submitted}}
		</div>
		<br><br>
		<div class="box">
			<h5 class="title is-5">Class selected</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<th>Faculty</th>
					<th>Subject Code</th>
					<th>Description</th>
					<th>Day</th>
					<th>Time</th>
					<th>Room</th>
					<th>Section</th>
				</tr>
				<tr>
					<td>{{ cs.faculty }}</td>
					<td>{{ cs.subCode }}</td>
					<td>{{ cs.desc }}</td>
					<td>{{ cs.day }}</td>
					<td>{{ cs.time }}</td>
					<td>{{ cs.room }}</td>
					<td>{{ cs.section }}</td>
				</tr>
			</table>
		</div>
		<div v-show="studLength">
			<div class="box">
				<h5 class="title is-5">Students</h5>
				<hr>
				<table class="table is-fullwidth is-centered">
					<tr>
						<th style="text-align: left">Student</th>
						<th class="row-12">Prelim</th>
						<th class="row-12">Midterm</th>
						<th class="row-12">Prefi</th>
						<th class="row-12">Finals</th>
						<th class="row-12">Final Grade</th>
						<th class="row-12">Equivalent</th>
						<th class="row-12">Remark</th>
					</tr>
					<tr v-for="student,i in students">
						<td style="text-align: left"> {{ student.name }} </td>
						<td>
							<multiselect open-direction="bottom" :tabindex="1" :disabled="is_disabled(i, student.prelim)" :show-no-results="false" :options-limit="2" v-model="student.prelim" track-by="grade" label="grade" :options="grades" placeholder="" @input="saveGrade(i,'p')" :loading="student.prelim_loader"></multiselect>
						</td>
						<td>
							<multiselect open-direction="bottom" :tabindex="2" :disabled="is_disabled(i, student.midterm)" :show-no-results="false" :options-limit="2" v-model="student.midterm" track-by="grade" label="grade" :options="grades" placeholder="" @input="saveGrade(i,'m')" :loading="student.midterm_loader"></multiselect>
						</td>
						<td>
							<multiselect open-direction="bottom" :tabindex="3" :disabled="is_disabled(i, student.prefi)" :show-no-results="false" :options-limit="2" v-model="student.prefi" track-by="grade" label="grade" :options="grades" placeholder="" @input="saveGrade(i,'sf')" :loading="student.prefi_loader"></multiselect>
						</td>
						<td>
							<multiselect open-direction="bottom" :tabindex="4" :disabled="is_disabled(i, student.final)" :show-no-results="false" :options-limit="2" v-model="student.final" track-by="grade" label="grade" :options="grades" placeholder="" @input="saveGrade(i,'f')" :loading="student.final_loader"></multiselect>
						</td>
						<td> {{ student.finalgrade }} </td>
						<td> {{ student.equiv }} </td>
						<td :class="remarkClass(student.remarks)"><b> {{ student.remarks }}</b> </td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div :class="{modal: true, 'is-active': add_student_modal}">
	  <div class="modal-background"></div>
	  <div class="modal-card">
	    <header class="modal-card-head">
	      <p class="modal-card-title">Add Student</p>
	      <button class="delete" aria-label="close" v-on:click="add_student_modal = false"></button>
	    </header>
	    <section class="modal-card-body">
	      <label class="label">Search student:</label>
         	<div class="control">
            	<multiselect v-model="selected_student" label="student" track-by="studID" placeholder="Enter name / control no" :options="suggestions" :loading="isLoading" :internal-search="false" @search-change="searchStudent">
            	</multiselect>
        	 </div>
	    </section>
	    <footer class="modal-card-foot pull-right">
	      <button class="button" v-on:click="add_student_modal = false">Close</button>
	      <button class="button is-success" v-if="selected_student != null" v-on:click="add_student">Add student to class</button>
	    </footer>
	  </div>
	</div>

</section>






<script>

document.addEventListener('DOMContentLoaded', function() {

	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	page: {
	    		main: '<?php echo base_url() ?>classes'
	    	},
	    	add_student_modal: false,
	    	classID: '<?php echo $classID ?>',
	    	cs: {
	    		faculty: '',
	    		subCode: '',
	    		desc: '',
	    		day: '',
	    		time: '',
	    		room: '',
	    		section: '',
	    		status: '',
	    		date_submitted: ''
	    	},
	    	students: [],

	    	selected_student: null,
	    	suggestions: [],
	    	isLoading: false,

	    },
	    created() {
	        this.fetch_Class_Selected()
	        
	    },
	    watch: {
	    	
	    },
	    computed: {
	    	checkRemarks(){
	    		const s = this.students
	    		const arr = []
	    		for(let s2 of s){
	    			if(s2.remarks == ''){
	    				let x = s2.name.split(',')
	    				arr.push(x[1]+' '+x[0])
	    			}
	    		}
	    		return arr
	    	},
	    	studLength(){
	    		return this.students.length
	    	},
	    	grades(){
	    		const grades = []
	    		let g 
	    		grades.push(
	    			{grade: 'INC'},
	    			{grade: 'Dropped'},
	    		)
	    		for (let i =100; i >= 59.99; i -= 0.01) {
	    			g = i.toFixed(2)
			        grades.push({
	    				grade: g
	    			})
			    }
	    		return grades
	    	}
	    },
	    methods: {
	    	saveGrade(i, x){
	    		const s = this.students[i]
	    		const data = this.get_grade_data(s, x)
	    		this.$http.post('<?php echo base_url() ?>classes/saveGrade', data)
	            .then(response => {
	            	s.prelim_loader = false
		    		s.midterm_loader = false
		    		s.prefi_loader = false
		    		s.final_loader = false

	            	const res = response.body
	            	console.log(res)
	            	if(res.output == 'error'){
	            		swal('Unable to drop!', 'Succeeding term grade has data', 'error')
	            		if(x == 'p'){s.prelim = {grade: res.prevGrade}}
	            		if(x == 'm'){s.midterm = {grade: res.prevGrade}}
	            		if(x == 'sf'){s.prefi = {grade: res.prevGrade}}
	            	}else{
	            		s.prelim = {grade: res.prelim}
			    		s.midterm = {grade: res.midterm}
			    		s.prefi = {grade: res.prefi}
			    		s.final = {grade: res.final}
			    		s.finalgrade = res.finalgrade
			    		s.equiv = res.equiv 
			    		s.remarks = res.remarks
	            	}

	            }, response => {
					this.saveGrade(i, x)
				})
	    	},
	    	is_disabled(i, tg){
	    		let x = false
	    		const s = this.students[i]
	    		if(this.cs.status == 'locked'){
	    			x = true 
	    		}else{
	    			if(tg){
	    				if(tg.grade != 'Dropped'){
		    				if(s.prelim){
		    					if(s.prelim.grade == 'Dropped'){
		    						x = true
		    					}
		    				}
		    				if(s.midterm){
		    					if(s.midterm.grade == 'Dropped'){
		    						x = true
		    					}
		    				}
		    				if(s.prefi){
		    					if(s.prefi.grade == 'Dropped'){
		    						x = true
		    					}
		    				}
		    				if(s.final){
		    					if(s.final.grade == 'Dropped'){
		    						x = true
		    					}
		    				}
		    			}
	    			}
	    		}
    			
	    		return x
	    	},
	    	get_grade_data(s, x){
	    		let gradeDesc = ''
	    		let grade = ''
	    		if(x == 'p'){
	    			s.prelim_loader = true
	    			gradeDesc = 'prelim'
	    			grade = (s.prelim == null) ? '' : s.prelim.grade
	    		}else if(x == 'm'){
	    			s.midterm_loader = true
	    			gradeDesc = 'midterm'
	    			grade = (s.midterm == null) ? '' : s.midterm.grade
	    		}else if(x == 'sf'){
	    			s.prefi_loader = true
	    			gradeDesc = 'prefi'
	    			grade = (s.prefi == null) ? '' : s.prefi.grade
	    		}else if(x == 'f'){
	    			s.final_loader = true
	    			gradeDesc = 'final'
	    			grade = (s.final == null) ? '' : s.final.grade
	    		}
	    		return {
	    			studID: s.studID,
	    			classID: this.classID,
	    			gradeDesc: gradeDesc,
	    			grade: grade,
	    			midterm: s.midterm,
	    			prefi: s.prefi,
	    			final: s.final
	    		}
	    	},
	    	fetch_Class_Selected(){
	    		this.$http.get('<?php echo base_url() ?>classes/fetch_Class_Selected/'+this.classID)
	            .then(response => {
	               const c = response.body
	               this.cs.faculty = c.faculty
	               this.cs.subCode = c.subCode
	               this.cs.desc = c.subDesc
	               this.cs.day = c.dayDesc
	               this.cs.time = c.class_time
	               this.cs.room = c.roomName
	               this.cs.section = c.secName
	               this.cs.status = c.status
	               this.cs.date_submitted = c.date_submitted
	               this.fetch_Students()
	            }, response => {
					this.fetch_Class_Selected()
				})
	    	},
	    	fetch_Students(){
	    		this.$http.get('<?php echo base_url() ?>classes/fetch_Students/'+this.classID)
	            .then(response => {
	               this.prepareForm(response.body)
	            }, response => {
					this.fetch_Students()
				})
	    	},
	    	prepareForm(students){
	    		for(s of students){
	    			s.prelim = {grade: s.prelim}
	    			s.midterm = {grade: s.midterm}
	    			s.prefi = {grade: s.prefi}
	    			s.final = {grade: s.final}
	    			if(s.finalgrade != ''){
	    				s.finalgrade = parseFloat(s.finalgrade).toFixed(2)
	    			}
	    			if(this.cs.status == 'locked' && s.remarks != 'Incomplete' && s.equiv == null){
	    				s.equiv = '5.0'
	    			}
	    			s.prelim_loader = false
	    			s.midterm_loader = false
	    			s.prefi_loader = false
	    			s.final_loader = false
	    		}
	    		this.students = students
	    	},
	    	searchStudent(value){
	    		if(value.trim() != ''){
		            this.isLoading = true
		            value = value.replace(/\s/g, "_")
		            this.$http.get('<?php echo base_url() ?>reusable/search_student/'+value)
		            .then(response => {
		               this.isLoading = false
		               this.suggestions = response.body
		            })
		         }else{
		            this.suggestions = []
		         }
	    	},
	    	add_student(){
	    		const data = {classID: this.classID, studID: this.selected_student.studID}
	    		this.$http.post('<?php echo base_url() ?>classes/add_student', data)
	            .then(response => {
	               const c = response.body
	               if(c == 'exist'){
	               		swal('Student is already in this class!', {icon: 'warning'})
	               }else{
	               		swal('Student successfully added!', {icon: 'success'})
	               		this.students.push(c)
	               		this.selected_student = null
	               		this.add_student_modal = false
	               }
	            })
	    	},
	    	remarkClass(remark){
	    		let x = {}
	    		if(remark == 'Passed'){
	    			x = {'has-text-success': true}
	    		}else if(remark == 'Failed'){
	    			x = {'has-text-danger': true}
	    		}else if(remark == 'Dropped'){
	    			x = {'has-text-warning': true}
	    		}else if(remark == 'Incomplete'){
	    			x = {'has-text-info': true}
	    		}

	    		return x
	    	},

	    	finGrade(){
	    		const x = this.checkRemarks
	    		if(x.length == 0){
	    			swal({
					  title: "Are you sure?",
					  text: "Once finalized, This class will no longer be editable. Except for complying incomplete grades",
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
					    swal('Password required',{
			              content: {
			                  element: "input",
			                  attributes:{
			                     placeholder: 'Please enter password',
			                     type: 'password'
			                  }
			              },
			              buttons: true,
			              icon: 'info'
			            })
			            .then((value) => {
			            	if(value){
			            		const j = {
			            			classID: this.classID,
			            			value: value
			            		}
			            		this.$http.post('<?php echo base_url() ?>classes/finalized_grade', j)
				                  .then(response => {
				                  	const cc = response.body
				                    if(cc.status == 'success'){
				                    	swal('Grades successfully finalized!', {icon: 'success'})
				                    	this.cs.status = 'locked'
				                    	this.cs.date_submitted = cc.date_submitted
				                    }else{
				                   		swal('Password is incorrect!', {icon: 'error'})
				                    }
				                 })
			            	}
			            	
			            })
					  }
					})
	    		}else{
	    			swal('Unable to finalize grade!','Make sure all students have remarks. '+x+' ', {icon: 'warning'})
	    		}
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