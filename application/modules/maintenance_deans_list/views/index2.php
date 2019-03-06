<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
	.my-size{
		font-size: 20px;
	}
</style>

<section id="app" class="section" v-cloak>
	<div class="container" style="max-width: 600px">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
		
		<multiselect @input="populate" v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
		<br>
		<form @submit.prevent="submitForm(i)" class="box" v-for="q, i of qualifications">
			<div class="field">
				<label class="label">Discount</label>
				<div class="control">
					<input type="text" v-model="q.discount" class="input" maxlength="4">	
				</div>
			</div>
			<div class="field">
				<div class="columns">
					<div class="column">
						<label class="label">Min units</label>
						<div class="control">
							<input type="text" v-model="q.min_units" class="input">	
						</div>
					</div>
					<div class="column">
						<label class="label">Max units</label>
						<div class="control">
							<input type="text" v-model="q.max_units" class="input">	
						</div>
					</div>
				</div>
			</div>
			
			<div class="field">
				<div class="columns">
					<div class="column">
						<label class="label">Min GWA</label>
						<div class="control">
							<input type="text" v-model="q.min_gwa" class="input">	
						</div>
					</div>
					<div class="column">
						<label class="label">Max GWA</label>
						<div class="control">
							<input type="text" v-model="q.max_gwa" class="input">	
						</div>
					</div>
				</div>
			</div>
			<hr>
			<button class="button is-danger" type="button">Delete</button>
			<button class="button is-primary" type="submit">Update</button>
		</form>

	</div>
</section>


<script>

document.addEventListener('DOMContentLoaded', function() {
	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	page_title: 'Honor List Qualifications',
	    	term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
	    	terms: [],
	    	qualifications: []
	    },
	    created() {
	    	this.fetchTerms()
	    	this.populate()
	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {
	    	fetchTerms() {
	        	this.$http.get('<?php echo base_url() ?>reusable/get_all_term')
	        	.then(response => {
	        		this.terms = response.body
				 });
	        },
	    	populate(){
	    		this.$http.get('<?php echo base_url() ?>maintenance_deans_list/populate/'+this.term.termID)
	    		.then(res => {
	    			console.log(res.body)
	    			this.qualifications = res.body
	    		}, e => {
	    			console.log(e)

	    		})
	    	},
	    	submitForm(i){
	    		const quals = this.qualifications[i]
	    		console.log(quals);
	    		swal('Success', 'Qualification successfully updated!', 'success')
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