<div id="app" v-cloak>
<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Show</a></li>
		  </ul>
		</nav>
	</div>
	<div class="container" style="max-width: 600px;">
		<div class="box">
			<div v-if="feeStatus != 'cancelled'">
				<a :href="page.edit" class="button">
					<i class="fa fa-pencil"></i>
				</a>
				<button class="button is-danger" v-on:click="is_safe_delete">
					<i class="fa fa-trash"></i>
				</button>
				<div class="is-pulled-right">
					<button class="button is-danger" @click="cancelPayment">Cancel Contribution</button>
					<a :href="page.involved" class="button is-primary">Involved Students</a>
				</div>
				<hr>
			</div>
			<table class="table is-fullwidth">
				<tr>
					<td colspan="2">
						<a v-if="tshirt == 'available'" :href="page.tshirt">view student's t-shirt sizes</a>
					</td>
				</tr>
				<tr>
					<td><b>Term:</b> </td>
					<td> {{term.term}} </td>
				</tr>
				<tr>
					<td><b>Academic activity:</b> </td>
					<td> {{feeName}} </td>
				</tr>
				<tr>
					<td><b>Year level & courses involved:</b> </td>
					<td> {{feeDesc}} </td>
				</tr>
				<tr>
					<td><b>Contribution each student:</b> </td>
					<td> {{amount}} </td>
				</tr>
				<tr>
					<td><b>Deadline of payment:</b> </td>
					<td> {{dueDate}} </td>
				</tr>
				<tr>
					<td>
						<b>T-shirt:</b> 
					</td>
					<td> 
						<span :class="{'has-text-danger': tshirt == 'unavailable', 'has-text-success': tshirt == 'available'}"> {{tshirt}} </span>
					</td>
				</tr>
				<tr>
					<td><b>Status:</b> </td>
					<td>
						<span v-if="term.termID != termID && feeStatus != 'cancelled'">
							<span class="tag is-success tag-width">Done</span>
						</span>
						<span v-else-if="feeStatus == 'cancelled'">
							<span class="tag is-danger tag-width">Cancelled</span>
						</span>
						<span v-else>
							<span class="tag is-link tag-width">On going</span>
						</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		new Vue({
		    el: '#app',
		    data: {
		    	id: '<?php echo $record->feeID ?>',
		    	term: {termID: '<?php echo $record->termID ?>', term: '<?php echo $record->term ?>'},
		    	termID: '<?php echo $current_term->termID; ?>',
		    	feeName: '<?php echo $record->feeName ?>',
		    	feeDesc: '<?php echo $record->feeDesc ?>',
		    	amount: '<?php echo $record->amount ?>',
		    	dueDate: '<?php echo $record->dueDate ?>',
		    	tshirt: '<?php echo $record->tshirt ?>',
		    	feeStatus: '<?php echo $record->feeStatus ?>',
		    	page:{
		    		edit: '<?php echo base_url()."maintenance/fees/form/".$record->feeID ?>',
		    		list: '<?php echo base_url() ?>maintenance/fees',
		    		involved: '<?php echo base_url()."maintenance/fees/involved-students/".$record->feeID ?>',
		    		tshirt: '<?php echo base_url()."maintenance/fees/tshirt-sizes/".$record->feeID ?>'
		    	},
		    },
		    methods: {
		    	is_safe_delete(){
		    		const id = this.id

		    		this.$http.get('<?php echo base_url() ?>maintenance_fees/is_safe_delete/' + id)
		        	.then(response => {
		        		const c = response.body
		        		if(c == 1){
		        			swal({
							  title: "Are you sure?",
							  text: "Once deleted, you will not be able to recover this record!",
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
							    this.deleteRec(id)
							  }
							})
		        		}else{
		        			swal("Unable to delete", "Fee has record in other modules!", "error")
		        		}
					 }, e => {
					 	console.log(e.body)
					 })
		    	},
		    	deleteRec(id){
		    		this.$http.get('<?php echo base_url() ?>maintenance_fees/delete/'+id+'/'+this.term.termID)
		        	.then(response => {
		        		swal('Poof! record has been deleted!', {
					      icon: 'success',
					    }).then((x) => {
						  if (x) {
						    window.location.href = this.page.list
						  }
						})
					 }, e => {
					 	console.log(e.body)
					 })
		    	},
		    	cancelPayment(){

		    		swal({
		    			title: "Select option",
		    			text: "(Cancel & Refund) will refund paid students while (Cancel & Transfer) will transfer the debit to another contribution",
		    			icon: "info",
		    			buttons: {
		    				Cancel: {
		    					text: "Cancel & Refund",
		    					value: "Cancel"
		    				},
		    				Cancel2: {
		    					text: "Cancel & Transfer",
		    					value: "Cancel2"
		    				}
		    			}
		    		})
		    		.then(action => {
		    			if(action == "Cancel"){
		    				swal({
							  title: "Are you sure?",
							  text: "Once cancelled, you will not be able to edit this fee and students who paid can be refunded",
							  icon: "warning",
							  buttons: {
							  	cancel: true,
							  	confirm: {
							  		closeModal: false
							  	}
							  },
							  dangerMode: true
							})
							.then((cancel) => {
							  if (cancel) {
							  	this.$http.get('<?php echo base_url() ?>maintenance_fees/cancelPayment/'+this.id)
				        		.then(response => {
				        			console.log(response.body);
				        		this.feeStatus = 'cancelled'
							    swal('Success!', 'Students who paid can now claim their refund!', 'success')
								 }, e => {
								 	console.log(e.body)
								 })
							    
							  }
							})
		    			}else if(action == 'Cancel2'){
		    				window.location.href = "<?php echo base_url() ?>maintenance/fees/transfer-fee/" + this.id
		    			}
		    		})
		    		
		    	}
		    },

		   http: {
            emulateJSON: true,
            emulateHTTP: true
    		}


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

