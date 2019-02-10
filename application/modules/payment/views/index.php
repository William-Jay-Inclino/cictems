<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
	.active-input{
		background-color: #f2f2f2 
	}
	.not-allowed {cursor: not-allowed;}
</style>

<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
		<div class="box">
			<div class="columns">
				<div class="column is-half">
					<label class="label">Search student:</label>
                   	<div class="control">
                     	<multiselect @input="populate" v-model="student" label="student" track-by="studID" placeholder="Enter name / control no" :options="students" :loading="isLoading" :internal-search="false" @search-change="search">
                      	</multiselect>
                   	</div>
				</div>
				<div class="column" v-show="ready">
					<label class="label">Course:</label>
					{{course}}
				</div>
				<div class="column"v-show="ready">
					<label class="label">Year:</label>
					{{year}}
				</div>
			</div>
		</div>
		<div v-show="loading" class="loader"></div>
		<div class="box" v-show="ready && !loading">
			<h4 class="title is-4">Fees</h4>
			<hr>
			<div v-if="fees.length > 0">
				<table class="table is-fullwidth">
					<thead>
						<th width="20%">Name of fee</th>
						<th width="15%">Fee amount</th>
						<th width="15%">Payable</th>
						<th width="15%">Receivable</th>
						<th width="15%">T-shirt</th>
						<th width="20%">Action</th>
					</thead>
					<tbody>
						<tr v-for="fee, i in fees" :class="{'active-input': fee.collect || fee.refund}">
							<td> {{fee.feeName}} </td>
							<td> {{fee.feeAmount}} </td>
							<td> {{fee.payable}} </td>
							<td> {{fee.receivable}} </td>
							<td>
								<span :class="{'has-text-danger': fee.tshirt == 'unavailable', 'has-text-success': fee.tshirt == 'available'}"> {{fee.tshirt}} </span>
							</td>
							<td>
								<div v-if="fee.collect || fee.refund">
									<form @submit.prevent="transactPayment(i)">
										<div class="field">
											<label v-if="fee.collect" class="label">Amount to be <span class="has-text-primary">collected</span></label>
											<label v-else-if="fee.refund" class="label">Amount to be <span class="has-text-primary">refunded</span></label>
											<div class="control">
												<input type="text" :class="{input: true, 'not-allowed': fee.refund}" v-model.trim.number="fee.amount" autofocus="true" :readonly="fee.refund">
											</div>
											<p class="help has-text-danger"> {{fee.error_amount}} </p>
										</div>
										<div v-if="fee.tshirt == 'available'" class="field">
											<label class="label">T-shirt size</label>
											<div class="control">
												<multiselect v-model="fee.tsize" track-by="tsize" label="tsize" :options="tsizes" placeholder="Select size" :allow-empty="false"></multiselect>
											</div>
										</div>
										<div class="field" v-if="fee.collect">
											<label class="label">OR #</label>
											<div class="control">
												<input type="text" class="input" v-model.trim="fee.or_number">
											</div>
											<p class="help has-text-danger"> {{fee.error_or_no}} </p>
										</div>
										<hr>
										<button type="button" class="button is-danger is-small" @click="cancelPayment(i)">Cancel</button>
										<button type="submit" class="button is-link is-small">Submit</button>
										<br><br>
									</form>
								</div>
								<div v-else>
									<div v-if="fee.payable > 0">
										<button class="button is-primary is-small" @click="openPayment(i)">Collect</button>
									</div>
									<div v-else>
										<button class="button is-success is-small" @click="openPayment(i)">Refund</button>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div v-else class="has-text-centered">
				Student has no fees
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
	    	page_title: 'Payment',
	    	student: null,
	    	students: [],
	    	isLoading: false,
	    	loading: false,
	    	ready: false,
	       	course: '',
	       	year: '',
	       	fees: [],
	    	tsizes: [
	    		{tsize: 'XXL'},
	    		{tsize: 'XL'},
	    		{tsize: 'L'},
	    		{tsize: 'M'},
	    		{tsize: 'S'},
	    		{tsize: '20'},
	    		{tsize: '18'},
	    		{tsize: '16'}
	    	]
	    },
	    created() {
	        
	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {
	    	search(value){
	    		if(value.trim() != ''){
		            this.isLoading = true
		            value = value.replace(/\s/g, "_")
		            this.$http.get('<?php echo base_url() ?>reusable/search_student/'+value)
		            .then(response => {
		               this.isLoading = false
		               this.students = response.body
		            })
		         }else{
		            this.students = []
		         }
	    	},
	    	populate(){
	    		this.loading = true
	    		if(this.student != null){
	    			this.ready = true
	    			this.$http.get('<?php echo base_url() ?>payment/populate/'+this.student.studID)
		            .then(response => {
		               const r = response.body 
		               console.log(r);
		               this.course = r.course
		               this.year = r.year
		               this.prepareForm(r.fees)
		               this.loading = false
		            }, e => {
		            	console.log(e.body)
		            })
	    		}else{
	    			this.ready = false
	    			this.loading = false
	    		}
	    	},
	    	prepareForm(fees){
	    		const fees2 = []
	    		for(let f of fees){
	    			if(f.tsize == '') f.tsize = 'M'
	    			fees2.push({
	    				feeID: f.feeID,
	    				feeName: f.feeName,
	    				feeAmount: f.amount,
	    				payable: f.payable,
	    				receivable: f.receivable,
	    				tshirt: f.tshirt,
	    				tsize: {tsize: f.tsize},
	    				collect: false,
	    				refund: false,
	    				amount: null,
	    				or_number: null,
	    				error_amount: '',
	    				error_or_no: '',
	    			})
	    		}
	    		this.fees = fees2
	    	},
	    	cancelPayment(i){
	    		const fee = this.fees[i]
	    		fee.collect = false
    			fee.refund = false
    			fee.amount = null
    			fee.or_number = null 
    			fee.error_amount = ''
    			fee.error_or_no = ''
	    	},
	    	openPayment(i){
	    		const fee = this.fees[i]
	    		if(fee.payable > 0){
	    			fee.collect = true	
	    		}else if(fee.receivable > 0){
	    			fee.refund = true
	    			fee.amount = fee.receivable
	    		}
	    		
	    		this.closeOthers(i)
	    	},
	    	transactPayment(i){
	    		if(this.fees[i].collect){
	    			this.collectPayment(i)
	    		}else if(this.fees[i].refund){
	    			this.refundPayment(i)
	    		}
	    	},
	    	is_valid(fee){
	    		let ok = true
	    		let msg = 'This field is required'
	    		if(!fee.amount){
	    			ok = false 
	    			fee.error_amount = msg
	    		}else{
	    			fee.error_amount = ''
	    		}

	    		if(fee.collect){
	    			if(!fee.or_number){
		    			ok = false 
		    			fee.error_or_no = msg
		    		}else{
		    			fee.error_or_no = ''
		    		}	
	    		}
	    		
	    		return ok
	    	},
	    	collectPayment(i){
	    		const fee = this.fees[i]
	    		
	    		if(this.is_valid(fee)){
	    			if(fee.amount > fee.payable || fee.amount <= 0){
	    				swal('Invalid amount!', 'Inputted amount should not be greater than amount payable or less than or equal zero!', 'warning')
	    			}else{
		    			this.$http.post('<?php echo base_url() ?>payment/collectPayment', {
		    				feeID: fee.feeID,
		    				studID: this.student.studID,
		    				amount: fee.amount,
		    				tsize: fee.tsize.tsize,
		    				or_number: fee.or_number
		    			})
			            .then(response => {
			            	const r = response.body
			            	console.log(r);
			            	if(r == '_error0'){
			            		swal('Error', 'OR # number already exist!', 'error')
			            	}else{
			            		swal('Success', 'Collected amount: '+Number(fee.amount).toFixed(2), 'success')
				            	if(r.status == 'paid' || r.status == 'claimed'){
				            		this.fees.splice(i, 1)
				            	}else{
				            		fee.payable = Number(fee.payable - fee.amount).toFixed(2)
				            		this.cancelPayment(i)
				            	}
			            	}
			            	
			            }, e => {
			            	console.log(e.body)
			            })
	    			}
	    		}
	    		
	    	},
	    	refundPayment(i){
	    		const fee = this.fees[i]

	    		if(this.is_valid(fee)){
	    			this.$http.post('<?php echo base_url() ?>payment/refundPayment', {
	    				feeID: fee.feeID,
	    				studID: this.student.studID,
	    				amount: fee.amount,
	    				or_number: fee.or_number
	    			})
		            .then(response => {
		            	swal('Success', 'Refunded amount: '+fee.receivable, 'success')
		            	this.fees.splice(i, 1)
		            }, e => {
		            	console.log(e.body)
		            })
	    		}
	    		
	    	},
	    	closeOthers(i){
	    		const fees = this.fees 
	    		let ctr = 0
	    		for(let f of fees){
	    			if(ctr != i){
	    				f.collect = false
	    				f.refund = false
	    				f.amount = null
		    			f.or_number = null 
		    			f.error_amount = ''
		    			f.error_or_no = ''
	    			}
	    			++ctr
	    		}
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