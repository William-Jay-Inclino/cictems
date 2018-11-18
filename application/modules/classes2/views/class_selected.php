<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

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
		<button class="button is-link is-pulled-right" v-on:click="finGrade" v-if="cs.status == 'unlocked' && student">Finalize Grades</button>
		<div v-if="cs.status == 'locked'" class="is-pulled-right">
			<h5 class="title is-5 has-text-success"> <i class="fa fa-check"></i> Submitted</h5>
			{{cs.date_submitted}}
		</div>
		<br><br>
		<h5 class="title is-5">Class selected</h5>
		<div class="box">
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
		<br>
		<div v-if="show_buttons">
			<a :href="'<?php echo base_url() ?>update-grade/prelim/' + classID" class="button is-primary">Prelim</a>
			<a :href="'<?php echo base_url() ?>update-grade/midterm/' + classID" class="button is-primary">Midterm</a>
			<a :href="'<?php echo base_url() ?>update-grade/prefi/' + classID" class="button is-primary">Semi-finals</a>
			<a :href="'<?php echo base_url() ?>update-grade/final/' + classID" class="button is-primary">Finals</a>
			<br><br>
		</div>
		<div v-show="studLength != 0">
			<h5 class="title is-5">Students</h5>
			<div class="box">
				<table class="table is-fullwidth is-centered">
					<tr>
						<th width="25%" style="text-align: left">Student</th>
						<th>P</th>
						<th>MT</th>
						<th>SF</th>
						<th>F</th>
						<th>FG</th>
						<th>Equiv</th>
						<th width="15%">Remarks</th>
						<th>
							<i class="fa fa-cog"></i>
						</th>
					</tr>
					<tr v-for="student in students">
						<td style="text-align: left"> {{ student.name }} </td>
						<td> {{ student.prelim }} </td>
						<td> {{ student.midterm }} </td>
						<td> {{ student.prefi }} </td>
						<td> {{ student.final }} </td>
						<td> {{ student.finalgrade }} </td>
						<td> {{ student.equiv }} </td>
						<td :class="remarkClass(student.remarks)"><b> {{ student.remarks }}</b> </td>
						<td>
							<a :href="'<?php echo base_url() ?>student-grade' + '/' + classID + '/' + student.studID" class="button is-outlined is-primary"><i class="fa fa-angle-double-right fa-lg"></i></a>
						</td>
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
	        this.fetch_Students()
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
	    	show_buttons(){
	    		let x = false
	    		const l = this.studLength
	    		if(this.cs.status == 'unlocked' && l != 0){
	    			x = true
	    		}
	    		return x
	    	},
	    	studLength(){
	    		return this.students.length
	    	}
	    },
	    methods: {
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
	            })
	    	},
	    	fetch_Students(){
	    		this.$http.get('<?php echo base_url() ?>classes/fetch_Students/'+this.classID)
	            .then(response => {
	               this.students = response.body
	            })
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