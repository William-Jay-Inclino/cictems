<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
	.my-size{
		font-size: 20px;
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
					<a href="<?php echo base_url() ?>users/student" target="_blank">
						<div class="message is-success">
							<div class="message-header">
						    	<p>Enrolled Students</p>
						  	</div>
						  	<div class="message-body has-text-centered has-text-dark my-size">
						  		<b> <?php echo $data['students']; ?> </b>
						  	</div>
						</div>	
					</a>
				</div>
				<div class="column">
					<a href="<?php echo base_url() ?>users/faculty" target="_blank">
						<div class="message is-link">
							<div class="message-header">
						    	<p>Active Faculties</p>
						  	</div>
						  	<div class="message-body has-text-centered has-text-dark my-size">
						  		<b> <?php echo $data['faculties']; ?> </b>
						  	</div>
						</div>
					</a>
				</div>
				<div class="column">
					<a href="<?php echo base_url() ?>users/staff" target="_blank">
						<div class="message is-danger">
							<div class="message-header">
						    	<p>Active Staffs</p>
						  	</div>
						  	<div class="message-body has-text-centered has-text-dark my-size">
						  		<b> <?php echo $data['staffs']; ?> </b>
						  	</div>
						</div>
					</a>
				</div>
			</div>
		</div>

		<div class="box">
			<h4 class="title is-4">
				<span class="icon has-text-primary">
					<i class="fa fa-cogs"></i>
				</span>
				Maintenance
				<a @click="is_m_active = !is_m_active" href="javascript:void(0)" class="is-pulled-right">
					<span class="icon has-text-primary">
						<i class="fa fa-lg fa-chevron-down"></i>
					</span>	
				</a>
			</h4>
			<hr>
			<div v-show="is_m_active">
				<div class="columns">
					<div class="column">
						<a href="<?php echo base_url() ?>maintenance/term" target="_blank">
							<div class="message is-primary">
								<div class="message-header">
							    	<p>Terms</p>
							  	</div>
							  	<div class="message-body has-text-centered my-size">
							  		<b> <?php echo $data['terms']; ?> </b>
							  	</div>
							</div>
						</a>
					</div>
					<div class="column">
						<a href="<?php echo base_url() ?>maintenance/room" target="_blank">
							<div class="message is-primary">
								<div class="message-header">
							    	<p>Rooms</p>
							  	</div>
							  	<div class="message-body has-text-centered my-size">
							  		<b> <?php echo $data['rooms']; ?> </b>
							  	</div>
							</div>
						</a>
					</div>
					<div class="column">
						<a href="<?php echo base_url() ?>maintenance/course" target="_blank">
							<div class="message is-primary">
								<div class="message-header">
							    	<p>Courses</p>
							  	</div>
							  	<div class="message-body has-text-centered my-size">
							  		<b> <?php echo $data['courses']; ?> </b>
							  	</div>
							</div>
						</a>
					</div>
					<div class="column">
						<a href="<?php echo base_url() ?>maintenance/prospectus" target="_blank">
							<div class="message is-primary">
								<div class="message-header">
							    	<p>Prospectus</p>
							  	</div>
							  	<div class="message-body has-text-centered my-size">
							  		<b> <?php echo $data['prospectus']; ?> </b>
							  	</div>
							</div>
						</a>
					</div>
				</div>

				<div class="columns">
					<div class="column">
						<a href="<?php echo base_url() ?>maintenance/section" target="_blank">
							<div class="message is-primary">
								<div class="message-header">
							    	<p>Sections</p>
							  	</div>
							  	<div class="message-body has-text-centered my-size">
							  		<b> <?php echo $data['sections']; ?> </b>
							  	</div>
							</div>
						</a>
					</div>
					<div class="column">
						<a href="<?php echo base_url() ?>maintenance/day" target="_blank">
							<div class="message is-primary">
								<div class="message-header">
							    	<p>Days</p>
							  	</div>
							  	<div class="message-body has-text-centered my-size">
							  		<b> <?php echo $data['days']; ?> </b>
							  	</div>
							</div>
						</a>
					</div>
					<div class="column">
						<a href="<?php echo base_url() ?>maintenance/subject" target="_blank">
							<div class="message is-primary">
								<div class="message-header">
							    	<p>Subjects</p>
							  	</div>
							  	<div class="message-body has-text-centered my-size">
							  		<b> <?php echo $data['subjects']; ?> </b>
							  	</div>
							</div>
						</a>
					</div>
					<div class="column">
						<a href="<?php echo base_url() ?>maintenance/fees" target="_blank">
							<div class="message is-primary">
								<div class="message-header">
							    	<p>Departmental Fees</p>
							  	</div>
							  	<div class="message-body has-text-centered my-size">
							  		<b> <?php echo $data['fees']; ?> </b>
							  	</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="box">
			<h4 class="title is-4">
				<span class="icon has-text-primary">
					<i class="fa fa-file-text"></i>
				</span>
				Subjects
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
								<th width="10%" class="has-text-success"> {{subject.passed_per}} </th>
								<th width="10%" class="has-text-danger"> {{subject.failed_per}} </th>
								<th width="10%" class="has-text-link"> {{subject.inc_per}} </th>
								<th width="10%" style="color: #fbac00"> {{subject.dropped_per}} </th>
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>
					<span class="has-text-centered">No class have been submitted</span>
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
	       	subjects: [],

	       	searched_sub: null
	    },
	    created() {
	        this.get_subjects()
	    },
	    watch: {

	    },
	    computed: {
	    	// subjects1(){
	    	// 	if(this.searched_sub){
	    	// 		return this.subjects.filter(s => s.subID == this.searched_sub.subID)
	    	// 	}
	    	// 	return this.subjects
	    	// },
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
	    	}
	    },
	    methods: {
	    	get_subjects(){
	    		this.$http.get('<?php echo base_url() ?>dashboard/get_subjects')
		         .then(res => {
		          	console.log(res.body)
		          	this.subjects = res.body
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