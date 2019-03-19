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
				New, Old, & Transferee Students <span class="has-text-primary">%</span>
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
								<p>NEW: <span style="font-size: 50px">{{percentage.new}}</span></p>
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
								<p>OLD: <span style="font-size: 50px">{{percentage.old}}</span></p>
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
								<p>TRANSFEREES: <span style="font-size: 50px">{{percentage.trans}}</span></p>
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
								<p>Retention: <span style="font-size: 50px">{{percentage.new}}</span></p>
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
								<p>Attrition: <span style="font-size: 50px">{{percentage.old}}</span></p>
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
	</div>
</section>


<script>

document.addEventListener('DOMContentLoaded', function() {

	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	page_title: 'Dashboard',
	    	is_user_active: false,
	       	is_m_active: false,
	       	is_s_active: false,
	       	is_p_active: false,
	       	is_p2_active: false,
	       	subjects: [],
	       	NOT_students: [],

	       	searched_sub: null,
	       	course: null,
	       	year: null,
	       	courses: [],
	       	years: []
	    },
	    created() {
	        this.populate2()
	    },
	    watch: {

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
	    	percentage(){
	    		return{
	    			new: '21%',
	    			old: '50%',
	    			trans: '10%'
	    		}
	    	}
	    	// percentage_NOT_students(){
	    	// 	const students = this.NOT_students

	    	// }	
	    },
	    methods: {
	    	populate2(){
	    		this.$http.get('<?php echo base_url() ?>dashboard/populate2')
		         .then(res => {
		          	console.log(res.body)
		          	const c = res.body
		          	this.subjects = c.subjects
		          	this.NOT_students = c.students
		          	this.courses = c.courses 
		          	this.years = c.years
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