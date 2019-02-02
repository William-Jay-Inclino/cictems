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
		</div>
	</div>
</section>


<script>

document.addEventListener('DOMContentLoaded', function() {

	

	new Vue({
	    el: '#app',
	    data: {
	    	page_title: 'Dashboard',
	    	is_user_active: false,
	       	is_m_active: false,
	       	is_s_active: false,
	    },
	    created() {
	        
	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {

	    }
	})

}, false)



</script>
