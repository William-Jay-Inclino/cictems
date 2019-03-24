<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
	.message-header{
		height: 100px;
		font-size: 20px;
		font-weight: bold;
		text-align: center;
	}
	.message-body{
		height: 50px;
	}
</style>

<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
		<div class="box">
			<h4 class="title is-4">
				<span class="icon has-text-primary">
					<i class="fa fa-users"></i>
				</span>
				Users
				<a @click="is_user_active = !is_user_active" href="javascript:void(0)" class="is-pulled-right">
					<span class="icon has-text-primary">
						<i class="fa fa-lg fa-chevron-down"></i>
					</span>	
				</a>
			</h4>
			<hr>
			<div class="columns" v-show="is_user_active">
				<div class="column">
					<div class="message is-info">
						<div class="message-header">
					    	<p>Enrolled Students: <span style="font-size: 50px"><?php echo $data['students']; ?></span></p>
					  	</div>
					  	<div class="message-body has-text-centered has-text-link">
					  		<a style="text-decoration: none" href="<?php echo base_url() ?>reports/student" target="_blank">
					  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
					  		</a>
					  	</div>
					</div>	
				</div>
				<div class="column">
					<div class="message is-success">
						<div class="message-header">
					    	<p>Active Faculties: <span style="font-size: 50px"><?php echo $data['faculties']; ?></span></p>
					  	</div>
					  	<div class="message-body has-text-centered has-text-link">
					  		<a style="text-decoration: none" href="<?php echo base_url() ?>users/faculty" target="_blank">
					  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
					  		</a>
					  	</div>
					</div>
				</div>
				<div class="column">
					<div class="message is-primary">
						<div class="message-header">
					    	<p>Active Staffs: <span style="font-size: 50px"><?php echo $data['staffs']; ?></span></p>
					  	</div>
					  	<div class="message-body has-text-centered has-text-link">
					  		<a style="text-decoration: none" href="<?php echo base_url() ?>users/staff" target="_blank">
					  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
					  		</a>
					  	</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box">
			<h4 class="title is-4">
				<span class="icon has-text-primary">
					<i class="fa fa-bar-chart-o"></i>
				</span>
				Passed, Failed, Dropped, & INC Students <span class="has-text-primary">%</span>
				<a @click="is_s_active = !is_s_active" href="javascript:void(0)" class="is-pulled-right">
					<span class="icon has-text-primary">
						<i class="fa fa-lg fa-chevron-down"></i>
					</span>	
				</a>
			</h4>
			<hr>
			<div v-show="is_s_active">
				<div v-if="subjects.length > 0">
					<multiselect v-model="searched_sub" track-by="subID" label="subLabel" :options="subjects2" :options-limit="10" placeholder="Enter Subject"></multiselect>
					<br>
					<table class="table is-fullwidth">
						<thead>
							<th>Subject Code</th>
							<th>Description</th>
							<th>Students</th>
							<th>Passed</th>
							<th>Failed</th>
							<th>Incomplete</th>
							<th>Dropped</th>
						</thead>
						<tbody>
							<tr v-for="subject of subjects2">
								<td> {{subject.subCode}} </td>
								<td> {{subject.subDesc}} </td>
								<td> {{subject.total_students}} </td>
								<th width="10%" class="has-text-success"> <span v-if="subject.passed_per != '0.00%'">{{subject.passed_per}}</span> </th>
								<th width="10%" class="has-text-danger"> <span v-if="subject.failed_per != '0.00%'">{{subject.failed_per}}</span> </th>
								<th width="10%" class="has-text-link"> <span v-if="subject.inc_per != '0.00%'">{{subject.inc_per}}</span> </th>
								<th width="10%" style="color: #fbac00"> <span v-if="subject.dropped_per != '0.00%'">{{subject.dropped_per}}</span> </th>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>
					<span class="has-text-centered">No class have been submitted</span>
				</div>
			</div>
		</div>
		<div class="box">
			<h4 class="title is-4">
				<span class="icon has-text-primary">
					<i class="fa fa-bar-chart-o"></i>
				</span>
				New, Old, Transferee, & Returnee Students <span class="has-text-primary">%</span>
				<a @click="is_p_active = !is_p_active" href="javascript:void(0)" class="is-pulled-right">
					<span class="icon has-text-primary">
						<i class="fa fa-lg fa-chevron-down"></i>
					</span>	
				</a>
			</h4>
			<hr>
			<div v-show="is_p_active">
				<div class="columns">
					<div class="column">
						<multiselect v-model="course" track-by="courseID" label="courseCode" :options="courses" placeholder="Select Course"></multiselect>
					</div>
					<div class="column">
						<multiselect v-model="year" track-by="yearID" label="yearDesc" :options="years" placeholder="Select Yearlevel"></multiselect>
					</div>
				</div>
				<div class="columns">
					<div class="column">
						<div class="message is-info">
							<div class="message-header">
								<p>NEW: <span style="font-size: 50px">{{NOT_percentage.new}}</span></p>
							</div>
							<div class="message-body has-text-centered has-text-link">
								<a style="text-decoration: none" href="#">
						  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
						  		</a>
							</div>
						</div>
					</div>
					<div class="column">
						<div class="message is-success">
							<div class="message-header">
								<p>OLD: <span style="font-size: 50px">{{NOT_percentage.old}}</span></p>
							</div>
							<div class="message-body has-text-centered has-text-link">
								<a style="text-decoration: none" href="#">
						  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
						  		</a>
							</div>
						</div>
					</div>
					<div class="column">
						<div class="message is-primary">
							<div class="message-header">
								<p>TRANSFEREES: <span style="font-size: 50px">{{NOT_percentage.trans}}</span></p>
							</div>
							<div class="message-body has-text-centered has-text-link">
								<a style="text-decoration: none" href="#">
						  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
						  		</a>
							</div>
						</div>
					</div>
					<div class="column">
						<div class="message is-danger">
							<div class="message-header">
								<p>Returnee: <span style="font-size: 50px">{{NOT_percentage.retur}}</span></p>
							</div>
							<div class="message-body has-text-centered has-text-link">
								<a style="text-decoration: none" href="#">
						  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
						  		</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box">
			<h4 class="title is-4">
				<span class="icon has-text-primary">
					<i class="fa fa-bar-chart-o"></i>
				</span>
				Retention & Attrition Students <span class="has-text-primary">%</span>
				<a @click="is_p2_active = !is_p2_active" href="javascript:void(0)" class="is-pulled-right">
					<span class="icon has-text-primary">
						<i class="fa fa-lg fa-chevron-down"></i>
					</span>	
				</a>
			</h4>
			<hr>
			<div v-show="is_p2_active">
				<div class="columns">
					<div class="column">
						<div class="field">
							<label class="label">Previous Term</label>
							<div class="control">
								<multiselect v-model="previous_term" track-by="termID" label="term" :options="terms2" :allow-empty="false"></multiselect>
							</div>
						</div>
					</div>
					<div class="column">
						<div class="field">
							<label class="label">Current Term</label>
							<div class="control">
								<p> {{current_term.term}} </p>
							</div>
						</div>
					</div>
				</div>
				<div class="columns">
					<div class="column">
						<multiselect v-model="course" track-by="courseID" label="courseCode" :options="courses" placeholder="Select Course"></multiselect>
					</div>
					<div class="column">
						<multiselect v-model="year" track-by="yearID" label="yearDesc" :options="years" placeholder="Select Yearlevel"></multiselect>
					</div>
				</div>
				<div class="columns">
					<div class="column">
						<div class="message is-info">
							<div class="message-header">
								<p>Retention: <span style="font-size: 50px">{{RA_percentage.retention}}</span></p>
							</div>
							<div class="message-body has-text-centered has-text-link">
								<a style="text-decoration: none" href="#">
						  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
						  		</a>
							</div>
						</div>
					</div>
					<div class="column">
						<div class="message is-success">
							<div class="message-header">
								<p>Attrition: <span style="font-size: 50px">{{RA_percentage.attrition}}</span></p>
							</div>
							<div class="message-body has-text-centered has-text-link">
								<a style="text-decoration: none" href="#">
						  			View Details <span class="icon"> <i class="fa fa-angle-double-right"></i> </span>
						  		</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- <table class="table is-fullwidth">
			<tr>
				<th>Name</th>
				<th>Status</th>
			</tr>
			<tr v-for="s of NOT_students">
				<td> {{s.name}} </td>
				<td> {{s.status}} </td>
			</tr>

		</table> -->
	</div>
</section>


<script>

document.addEventListener('DOMContentLoaded', function() {

	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	current_term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
	    	page_title: 'Dashboard',
	    	is_user_active: false,
	       	is_m_active: false,
	       	is_s_active: false,
	       	is_p_active: false,
	       	is_p2_active: false,
	       	subjects: [],
	       	NOT_students: [],
	       	previous_students: [],
	       	previous_term: null,

	       	searched_sub: null,
	       	course: null,
	       	year: null,
	       	current_term2: null,
	       	courses: [],
	       	years: [],
	       	terms: []
	    },
	    created() {
	        this.populate2()
	    },
	    watch: {
	    	previous_term(val){
	    		if(val){
	    			this.get_prevStudents()
	    		}
	    	}
	    },
	    computed: {
	    	subjects2(){
	    		let subjects = this.subjects
	    		if(this.searched_sub){
	    			subjects = this.subjects.filter(s => s.subID == this.searched_sub.subID)
	    		}

	    		// const subjects = this.subjects1 
	    		const arr = []
	    		let last_inserted = null
	    		for(let s of subjects){
	    			if(s.id != last_inserted){
	    				arr.push(s)
	    				last_inserted = s.id
	    			}
	    			
	    		}
	    		return arr
	    	},
	    	studLength(){
	    		const students = this.NOT_students 
	    		const course = this.course 
	    		const year = this.year
	    		let len = 0

	    		if(course && year){
    				for(let s of students){
    					if(s.courseID == course.courseID && s.yearID == year.yearID) ++len
    				}
    				return len
    			}else if(course && !year){
    				for(let s of students){
    					if(s.courseID == course.courseID) ++len
    				}
    				return len
    			}else if(!course && year){
    				for(let s of students){
    					if(s.yearID == year.yearID) ++len
    				}
    				return len
    			}else{
    				return students.length
    			}

	    	},
	    	NOT_percentage(){
	    		const students = this.NOT_students 
	    		const course = this.course 
	    		const year = this.year
	    		let data = {
	    			new: '0%',
	    			old: '0%',
	    			trans: '0%',
	    			retur: '0%'
	    		}
	    		if(students){
	    			const studLen = this.studLength
	    			if(studLen > 0){
	    				let newTotal = 0
			    		let oldTotal = 0
			    		let transTotal = 0
			    		let returTotal = 0
			    		for(let s of students){

			    			if(course && year){
			    				if(s.courseID != course.courseID || s.yearID != year.yearID){
			    					continue
			    				}
			    			}else if(course && !year){
			    				if(s.courseID != course.courseID){
			    					continue
			    				}
			    			}else if(!course && year){
			    				if(s.yearID != year.yearID){
			    					continue
			    				}
			    			}

			    			if(s.status == 'New') ++newTotal
			    			if(s.status == 'Old') ++oldTotal
			    			if(s.status == 'Transferee') ++transTotal
			    			if(s.status == 'Returnee') ++returTotal
			    		}
			    		data = {
			    			new: (Math.round(((newTotal / studLen) * 100) * 100) / 100) + '%',
			    			old: (Math.round(((oldTotal / studLen) * 100) * 100) / 100) + '%',
			    			trans: (Math.round(((transTotal / studLen) * 100) * 100) / 100) + '%',
			    			retur: (Math.round(((returTotal / studLen) * 100) * 100) / 100) + '%'
			    		}
	    			}
		    		
	    		}
	    		
	    		return data
	    		
	    	},
	    	RA_percentage(){
	    		const curStuds = this.NOT_students 
	    		const prevStuds = this.previous_students 
	    		const course = this.course 
	    		const year = this.year
	    		let data = {
	    			retention: '0%',
	    			attrition: '0%'
	    		}
	    		if(curStuds){
	    			const studLen = this.studLength
		    		if(studLen > 0){
		    			let retTotal = 0
			    		let attrTotal = 0

			    		for(let cs of curStuds){

			    			if(course && year){
			    				if(cs.courseID != course.courseID || cs.yearID != year.yearID){
			    					continue
			    				}
			    			}else if(course && !year){
			    				if(cs.courseID != course.courseID){
			    					continue
			    				}
			    			}else if(!course && year){
			    				if(cs.yearID != year.yearID){
			    					continue
			    				}
			    			}

			    			is_retain = false
			    			for(let ps of prevStuds){

			    				if(cs.studID == ps.studID){
			    					++retTotal
			    					is_retain = true
			    					break
			    				}

			    			}

			    			if(!is_retain){
			    				++attrTotal
			    			}
			    		}

			    		data = {
			    			retention: (Math.round(((retTotal / studLen) * 100) * 100) / 100) + '%',
			    			attrition: (Math.round(((attrTotal / studLen) * 100) * 100) / 100) + '%'
			    		}

		    		}
	    		}
	    		
	    		return data
	    	},
	    	terms2(){
	    		const terms = this.terms 
	    		//if(terms.length > 0){
	    			const curTerm = this.current_term2
		    		const arr = []
		    		for(let t of terms){
		    			if(t.schoolYear == curTerm.schoolYear && t.semOrder > curTerm.semOrder){
		    				continue
		    			}
		    			arr.push(t)
		    		}
		    		this.previous_term = arr[0]
		    		return arr
	    		//}
	    	}
	    },
	    methods: {
	    	populate2(){
	    		this.$http.get('<?php echo base_url() ?>dashboard/populate2')
		         .then(res => {
		          	console.log(res.body)
		          	const c = res.body
		          	this.subjects = c.subjects
		          	this.NOT_students = c.students
		          	this.RA_students = c.students2
		          	this.courses = c.courses 
		          	this.years = c.years
		          	this.terms = c.terms
		          	this.current_term2 = c.current_term
		          }, e => {
		          	console.log(e.body)

		          })
	    	},
	    	get_prevStudents(){
	    		this.$http.get('<?php echo base_url() ?>dashboard/get_prevStudents/'+this.previous_term.termID)
		         .then(res => {
		          	console.log(res.body)
		          	this.previous_students = res.body
		          }, e => {
		          	console.log(e.body)

		          })
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