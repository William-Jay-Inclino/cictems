<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<div class="box">
			<h5 class="title is-5 has-text-success" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Subject Code:</b> </td>
					<td> {{subCode}} </td>
				</tr>
				<tr>
					<td><b>Description:</b> </td>
					<td> {{subDesc}} </td>
				</tr>
				<tr>
					<td><b>Prospectus:</b> </td>
					<td> {{prosCode}} </td>
				</tr>
				<tr>
					<td><b>Lecture:</b> </td>
					<td> {{lec}} </td>
				</tr>
				<tr>
					<td><b>Laboratory:</b> </td>
					<td> {{lab}} </td>
				</tr>
				<tr>
					<td><b>Year:</b> </td>
					<td> {{yearDesc}} </td>
				</tr>
				<tr>
					<td><b>Semester:</b> </td>
					<td> {{semDesc}} </td>
				</tr>
				<tr>
					<td><b>Prerequisite:</b> </td>
					<td> 
						{{year_req}} &nbsp;
						<span v-if="reqs.length != 0" v-for="req in reqs">
							<span v-if="req.req_type == 1">
								{{req.req_code}} &nbsp;
							</span>
						</span>
					</td>
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
				</tr>
				<tr>
					<td><b>Type:</b> </td>
					<td> {{specDesc}} </td>
				</tr>
			</table>
		</div>
		<div style="text-align: center">
			<a :href="page.add" class="button is-primary" style="width: 100px">Add New</a>
			<a :href="page.edit" class="button is-primary" style="width: 100px">Edit</a>
			<a :href="page.list" class="button is-primary" style="width: 100px">Go to list</a>
		</div>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		new Vue({
		    el: '#app',
		    data: {
		    	id: '<?php echo $record->subID ?>',
		    	subCode: '<?php echo $record->subCode ?>',
		    	subDesc: '<?php echo $record->subDesc ?>',
		    	prosCode: '<?php echo $record->prosCode ?>',
		    	lec: '<?php echo $record->lec ?>',
		    	lab: '<?php echo $record->lab ?>',
		    	year_req: '<?php echo $record->year_req ?>',
		    	semDesc: '<?php echo $record->semDesc ?>',
		    	yearDesc: '<?php echo $record->yearDesc ?>',
		    	specDesc: '<?php echo $record->specDesc ?>',
		    	reqs: [],
		    	page:{
		    		title: 'Subject successfully added!',
		    		add: '<?php echo base_url() ?>maintenance/subject/form',
		    		edit: '<?php echo base_url()."maintenance/subject/form/".$record->subID ?>',
		    		list: '<?php echo base_url() ?>maintenance/subject'
		    	},

		    },

		    created(){
		    	this.fetch_requisites()
		    },	
		    methods: {
		    	fetch_requisites(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_requisites/'+this.id)
		        	.then(response => {
		        		console.log(response.body)
		        		this.reqs = response.body
					 })
		    	}
		    }


		});


	}, false);

</script>

