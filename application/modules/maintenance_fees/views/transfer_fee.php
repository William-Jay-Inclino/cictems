<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma_checkbox/bulma-checkbox.min.css">
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
			    <li class="is-active"><a href="#" aria-current="page">Cancel & Transfer</a></li>
			  </ul>
			</nav>
		</div>
	</section>
	<div class="container" style="max-width: 1000px;">
		<div class="box">
			<h5 class="title is-5">Contribution Info</h5>
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
						<span v-if="feeStatus == 'ongoing'">
							<span class='tag is-link'>On going</span>
						</span>
						<span v-else-if="feeStatus == 'done'">
							<span class='tag is-success'>Done</span>
						</span>
						<span v-else>
							<span class='tag is-danger'>Cancelled</span>
						</span>
					</td>
				</tbody>
			</table>
		</div>
		<div class="box" v-if="feeStatus != 'cancelled'">
			<h5 class="title is-5">Transfer debit to:</h5>
			<hr>	
			<multiselect v-model="fee" track-by="feeID" label="feeName" :options="fees" placeholder="Select contribution"></multiselect>
			<br>
			<button @click="transferFee" class="button is-link" :disabled="!fee">Cancel and Transfer</button>
		</div>
		<div class="box" v-if="students">
			<h5 class="title is-5">Affected students:</h5>
			<hr>
			<div v-if="students.length > 0">
				<table class="table is-fullwidth">
					<thead>
						<th>#</th>
						<th>Control no.</th>
						<th>Name</th>
						<th>Course</th>
						<th>Year</th>
						<th>Amount transferred</th>
					</thead>
					<tbody>
						<tr v-for="s, i in students">
							<td> {{++i}} </td>
							<td> {{s.student.controlNo}} </td>
							<td> {{s.student.name}} </td>
							<td> {{s.student.courseCode}} </td>
							<td> {{s.student.yearDesc}} </td>
							<td> {{s.amount_transferred}} </td>
						</tr>
					</tbody>
				</table>
			</div>
			<div v-else class="has-text-centered">
				<p>No student affected</p>
			</div>
			
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
	    	feeStatus: '<?php echo $record->feeStatus ?>',
	    	feeName: '<?php echo $record->feeName ?>', 
	    	feeID: '<?php echo $record->feeID ?>',
	    	termID: '<?php echo $record->termID ?>',
	    	page:{
	    		show: '<?php echo base_url()."maintenance/fees/show/".$record->feeID ?>',
	    		list: '<?php echo base_url()?>maintenance/fees'
	    	},
	    	fee: null,
	    	fees: [],
	    	students: null
	    },
	    created() {
	    	this.populate()
	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {
	    	populate(){
	    		this.$http.get('<?php echo base_url() ?>maintenance_fees/populate_transfer_fee/' + this.termID + '/' + this.feeID)
	    		.then(res => {
	    			this.fees = res.body

	    		}, e => {
	    			console.log(e.body)

	    		})
	    	}, transferFee(){
	    		swal('Are you sure?', "Once cancelled and transferred, it will no longer be undo.", 'warning', {
	    			dangerMode: true,
	    			buttons: {
					  	cancel: true,
					  	confirm: {
					  		closeModal: false
					  	}
					  }
	    		})
	    		.then(x => {
	    			if(x){
	    				const data = {
			    			current_fee: this.feeID,
			    			transferred_fee: this.fee.feeID
			    		}

			    		this.$http.post('<?php echo base_url() ?>maintenance_fees/transferFee', data)
			    		.then(res => {
			    			this.students = res.body
			    			console.log(this.students);
			    			swal('Success', "Successfully cancelled "+this.feeName+" and transferred debit to "+this.fee.feeName+"!", 'success')
			    			this.feeStatus = 'cancelled'
			    		}, e => {
			    			console.log(e.body)

			    		})		
	    			}
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
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>