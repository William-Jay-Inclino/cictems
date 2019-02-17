<?php 
	$report_link = base_url().'my-class/grade-sheet/'.$termID.'/'.$id.'/'.$prosID.'/'.$secID;
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
	.row-12{
		width: 12%
	}
</style>

<section id="app" class="section" v-cloak>
	<div class="container">
		<div class="columns">
			<div class="column">
				<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
				  <ul>
				    <li><a :href="page.main">Main</a></li>
				    <li class="is-active"><a href="#" aria-current="page">Selected Class</a></li>
				  </ul>
				</nav>
			</div>
			<div class="column">
				<a href="<?php echo $report_link; ?>" target="_blank" class="button is-primary is-pulled-right">Generate Report</a>
			</div>
		</div>
		

		<br>
		
		<button class="button is-primary" v-on:click="add_student_modal = true" v-if="status == 'unlocked'">
			Add student to class
		</button>
		<button class="button is-link is-pulled-right" v-on:click="finGrade" v-if="status == 'unlocked' && studLength > 0">Finalize Grades</button>
		<div v-if="status == 'locked'" class="is-pulled-right">
			<h5 class="title is-5 has-text-success"> <i class="fa fa-check"></i> Submitted</h5>
			{{date_submitted}}
		</div>
		<br><br>
		<div class="box">
			<h5 class="title is-5"><span v-if="classes.length > 1">Classes</span> <span v-else>Class</span> selected</h5>
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
				<tr v-for="cs of classes">
					<td>{{ cs.faculty }}</td>
					<td>{{ cs.subCode }} <b> <span v-if="cs.type == 'lec'">(lec)</span><span v-else> (lab) </span></b> </td>
					<td>{{ cs.subDesc }}</td>
					<td>{{ cs.dayDesc }}</td>
					<td>{{ cs.class_time }}</td>
					<td>{{ cs.roomName }}</td>
					<td>{{ cs.secName }}</td>
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
	    		main: '<?php echo base_url() ?>my-class'
	    	},
	    	add_student_modal: false,
	    	termID: '<?php echo $termID ?>',
	    	id: '<?php echo $id ?>',
	    	prosID: '<?php echo $prosID ?>',
	    	secID: '<?php echo $secID ?>',
	    	status: '',
	    	date_submitted: '',
	    	students: [],
	    	classes: [],
	    	selected_student: null,
	    	suggestions: [],
	    	isLoading: false,

	    },
	    created() {
	        this.populate()
	    },
	    watch: {
	    	
	    },
	    computed: {
	    	classIDs(){
	    		return this.classes.map(x => {
	    			return x.classID
	    		})
	    	},
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
	    	populate(){
	    		this.$http.get('<?php echo base_url() ?>my_class/populate_class_sel/'+this.termID+'/'+this.id+'/'+this.prosID+'/'+this.secID)
	            .then(response => {
	            	const c = response.body 
	               	this.classes = c.class 
	               	this.status = c.class[0].status
	               	this.date_submitted = c.class[0].date_submitted
	               	this.prepareForm(c.students)
	               	
	            }, e => {
	            	console.log(e.body)
				})
	    	},
	    	prepareForm(students){
	    		if(students.length > 0){
	    			this.students = students.map(s => {
	    				s.prelim = {grade: s.prelim}
		    			s.midterm = {grade: s.midterm}
		    			s.prefi = {grade: s.prefi}
		    			s.final = {grade: s.final}
		    			if(s.finalgrade != ''){
		    				s.finalgrade = parseFloat(s.finalgrade).toFixed(2)
		    			}
		    			if(this.status == 'locked' && s.remarks != 'Incomplete' && s.equiv == null){
		    				s.equiv = '5.0'
		    			}
		    			s.prelim_loader = false
		    			s.midterm_loader = false
		    			s.prefi_loader = false
		    			s.final_loader = false

	    				return s
	    			})
	    		}
	    	},
	    	saveGrade(i, x){
	    		const s = this.students[i]
	    		const data = this.get_grade_data(s, x)
	    		this.$http.post('<?php echo base_url() ?>my_class/saveGrade', data)
	            .then(response => {
	            	s.prelim_loader = false
		    		s.midterm_loader = false
		    		s.prefi_loader = false
		    		s.final_loader = false

	            	const res = response.body
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
	            	console.log(response.body)
	            	this.saveGrade(i, x)
				})
	    	},
	    	is_disabled(i, tg){
	    		let x = false
	    		const s = this.students[i]
	    		if(this.status == 'locked'){
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
	    			classIDs: this.classIDs,
	    			gradeDesc: gradeDesc,
	    			grade: grade,
	    			midterm: s.midterm,
	    			prefi: s.prefi,
	    			final: s.final
	    		}
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
	    		const studSel = this.selected_student
	    		const data = {classIDs: this.classIDs, studID: studSel.studID}
	    		this.$http.post('<?php echo base_url() ?>my_class/add_student', data)
	            .then(response => {
	               const c = response.body
	               console.log(c)
	               if(c == 'exist'){
	               		swal('Student is already in this class!', {icon: 'warning'})
	               }else{
	               		const j = {
	               			studID: studSel.studID,
	               			name: studSel.student.split(' | ')[0],
	               			prelim: {grade: null},
			    			midterm: {grade: null},
			    			prefi: {grade: null},
			    			final: {grade: null},
			    			finalgrade: '',
			    			equiv: '',
			    			prelim_loader: false,
			    			midterm_loader: false,
			    			prefi_loader: false,
			    			final_loader: false
	               		}
	               		this.students.push(j)
	               		swal('Student successfully added!', {icon: 'success'})
	               		this.selected_student = null
	               		this.add_student_modal = false
	               }
	            }, e => {
	            	console.log(e.body)

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
					  text: "Once finalized, This class will no longer be editable.",
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
			            			classIDs: this.classIDs,
			            			value: value
			            		}
			            		swal('Submitting please wait ...',
					      		{
					      			button: false,
					      			closeOnClickOutside: false
					      		})
			            		this.$http.post('<?php echo base_url() ?>my_class/finalized_grade', j)
				                  .then(response => {
				                  	const cc = response.body
				                    if(cc.status == 'success'){
				                    	swal('Grades successfully finalized!', {icon: 'success'})
				                    	this.status = 'locked'
				                    	this.date_submitted = cc.date_submitted
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