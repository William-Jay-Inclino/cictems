<div id="app" v-cloak>
<section class="section">

	<div class="container" style="max-width: 600px;">
		<h5 class="title is-5 has-text-success" style="text-align: center">
			<?php 
				$tit = 'Subject';
				if(count($records) > 1){
					$tit = $tit.'s';
				}
				echo $tit.' successfully added!';
			?>
		</h5>
		<?php 
			foreach($records as $record){ ?>
				<div class="box">
					<table class="table is-fullwidth">
						<tr>
							<td><b>Subject Code:</b> </td>
							<td> <?php echo $record->subCode ?> </td>
						</tr>
						<tr>
							<td><b>Description:</b> </td>
							<td> <?php echo $record->subDesc ?> </td>
						</tr>
						<tr>
							<td><b>Prospectus:</b> </td>
							<td> <?php echo $record->prosCode ?> </td>
						</tr>
						<tr>
							<td><b>Units:</b> </td>
							<td> <?php echo $record->units ?> </td>
						</tr>
						<tr>
							<td><b>Unit Type:</b></td>
							<td> <?php echo $record->type ?> </td>
						</tr>
						<tr>
							<td><b>Year:</b> </td>
							<td> <?php echo $record->yearDesc ?> </td>
						</tr>
						<tr>
							<td><b>Semester:</b> </td>
							<td> <?php echo $record->semDesc ?> </td>
						</tr>
						<tr>
							<td><b>Prerequisite:</b> </td>
							<td> 
								 <?php echo $record->year_req.' '; ?> 
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
							<td><b>Subject Type:</b> </td>
							<td> <?php echo $record->specDesc ?> </td>
						</tr>
					</table>
				</div>
				
				<?php
			}
		?>
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
		    	id: '<?php echo $records[0]->id ?>',
		    	subID: '<?php echo $records[0]->subID ?>',
		    	prosID: '<?php echo $records[0]->prosID ?>',
		    	reqs: [],
		    	page:{
		    		title: 'Subject successfully added!',
		    		add: '<?php echo base_url() ?>maintenance/subject/form',
		    		edit: '<?php echo base_url()."maintenance/subject/form/".$records[0]->id."/".$records[0]->prosID ?>',
		    		list: '<?php echo base_url() ?>maintenance/subject'
		    	},

		    },

		    created(){
		    	this.fetch_requisites()
		    },	
		    methods: {
		    	fetch_requisites(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_subject/get_requisites/'+this.subID)
		        	.then(response => {
		        		this.reqs = response.body
		        		console.log(response.body)
					 })
		    	}
		    }


		});


	}, false);

</script>

