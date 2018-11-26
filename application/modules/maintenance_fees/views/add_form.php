<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<div id="app" v-cloak>

<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Add Form</a></li>
		  </ul>
		</nav>
	</div>
	<div class="container" style="max-width: 600px;">
		<h5 class="title is-4" style="text-align: center">{{ page.title }}</h5>
		<form class="box" @submit.prevent="submitForm">
			<div class="field">
			  <label class="label">Term</label>
			  <div class="control">
				  	<multiselect v-model="form.termID" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
			  </div>
			</div>
			<div class="field">
			  <label class="label">Name of fee</label>
			  <div class="control">
				  	<input class="input" type="text" v-model="form.feeName" autofocus>
			  </div>
			  	<p class="help has-text-danger">
					{{error.feeName}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Description</label>
			  <div class="control">
				  	<textarea class="textarea" v-model.trim="form.feeDesc"></textarea>
			  </div>
			  	<p class="help has-text-danger">
					{{error.feeDesc}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Amount</label>
			  <div class="control">
				  	<input type="text" v-model.number="form.amount" class="input">
			  </div>
			  	<p class="help has-text-danger">
					{{error.amount}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Due date</label>
			  <div class="control">
				  	<input class="input" type="date" v-model="form.dueDate">
			  </div>
			  	<p class="help has-text-danger">
					{{error.dueDate}}
				</p>
			</div>
			<br>
			<button type="submit" class="button is-link is-pulled-right">Submit</button>
			<br><br>
		</form>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		Vue.component('multiselect', window.VueMultiselect.default)	

		new Vue({
		    el: '#app',
		    data: {
		    	page:{
		    		title: 'Add Fees',
		    		list: '<?php echo base_url() ?>maintenance/fees',
		    		success: '<?php echo base_url() ?>maintenance/fees/form-success/'
		    	},

		    	form: {
		    		termID: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
		    		feeName: null,
		    		feeDesc: null,
		    		amount: null,
		    		dueDate: null
		    	},
		    	error: {
		    		feeName: '',
		    		feeDesc: '',
		    		amount: '',
		    		dueDate: ''
		    	},
		    	terms: []
		    },
		    created(){
		    	this.fetchTerm()
		    },
		    methods: {
		    	fetchTerm() {
		        	this.$http.get('<?php echo base_url() ?>reusable/get_all_term')
		        	.then(response => {
		        		this.terms = response.body
					 })
		        },
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_fees/create',{data: f})
			        	.then(response => {
			        		const c = response.body
			        		if(c.status == 0){
			        			swal('Fee already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			window.location.href = this.page.success + c.id
			        		}
						 }, e => {
						 	this.submitForm()
						 })
		        	}else{
		        		swal('Unable to submit. Please review the form', {
					      icon: 'warning',
					    })
		        	}
		        },
		        checkForm(f){
		        	let ok = true
		        	const errMsg = 'This field is required'
		        	if(!f.feeName){
		        		this.error.feeName = errMsg
		        		ok = false
		        	}else{
		        		this.error.feeName = ''
		        	}
		        	if(!f.feeDesc){
		        		this.error.feeDesc = errMsg
		        		ok = false
		        	}else{
		        		this.error.feeDesc = ''
		        	}
		        	if(!f.amount){
		        		this.error.amount = errMsg
		        		ok = false
		        	}else{
		        		this.error.amount = ''
		        	}
		        	if(!f.dueDate){
		        		this.error.dueDate = errMsg
		        		ok = false
		        	}else{
		        		this.error.dueDate = ''
		        	}
		        	return ok
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

