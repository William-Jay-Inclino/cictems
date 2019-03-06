<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
	.my-size{
		font-size: 20px;
	}
</style>

<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
		
		<div class="columns">
			<div class="column is-4">
				<multiselect @input="populate" v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>		
			</div>
		</div>
		<br>
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>Discount</th>
						<th>Min units</th>
						<th>Max units</th>
						<th>Min GWA</th>
						<th>Max GWA</th>
						<th>Remove</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="q, i of qualifications">
						<td> 
							<multiselect @input="update(i,'dc')" v-model="q.discount" track-by="discount" label="discount" :options="discounts" :allow-empty="false"></multiselect>	
						</td>
						<td> 
							<multiselect @input="update(i,'minU')" v-model="q.min_units" track-by="unit" label="unit" :options="units" :allow-empty="false"></multiselect>	
						</td>
						<td> 
							<multiselect @input="update(i,'maxU')" v-model="q.max_units" track-by="unit" label="unit" :options="units" :allow-empty="false"></multiselect>
						</td>
						<td> 
							<multiselect @input="update(i,'minG')" v-model="q.min_gwa" track-by="gwa" label="gwa" :options="gwas" :allow-empty="false"></multiselect>
						</td>
						<td> 
							<multiselect @input="update(i,'maxG')" v-model="q.max_gwa" track-by="gwa" label="gwa" :options="gwas" :allow-empty="false"></multiselect>
						</td>
						<td>
							<button class="button is-danger"> <span class="icon"><i class="fa fa-trash"></i></span>  </button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

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
	    	qualifications: [],
	    	discounts: [],
	    	units: [],
	    	gwas: []
	    },
	    created() {
	    	this.fetchTerms()
	    	this.prepareForm()
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
	    			const c = res.body
	    			const qualifications = []
	    			for(let x of c){
	    				qualifications.push({
	    					id: x.id,
	    					discount: {discount: x.discount},
	    					min_units: {unit: x.min_units},
	    					max_units: {unit: x.max_units},
	    					min_gwa: {gwa: x.min_gwa},
	    					max_gwa: {gwa: x.max_gwa},
	    				})
	    			}
	    			this.qualifications = qualifications
	    			
	    		}, e => {
	    			console.log(e)

	    		})
	    	},
	    	update(i, val){
	    		const quals = this.qualifications[i]
	    		console.log(quals);
	    		swal('Success', 'Qualification successfully updated!', 'success')
	    		if(val == 'dc') data = {discount: quals.discount.discount}
	    		if(val == 'minU') data = {min_units: quals.min_units.unit}
	    		if(val == 'maxU') data = {max_units: quals.max_units.unit}
	    		if(val == 'minG') data = {min_gwa: quals.min_gwa.gwa}
	    		if(val == 'maxG') data = {max_gwa: quals.max_gwa.gwa}

	    		this.$http.post('<?php echo base_url() ?>maintenance_deans_list/update', {data: data, id: quals.id})
	        	.then(res => {
	        		console.log(res.body)

				 }, e => {
				 	console.log(e.body)

				 })

	    	},
	    	prepareForm(){
	    		const discounts = []
	    		for (let i = 100; i >= 0; --i) {
			        discounts.push({
	    				discount: i + '%'
	    			})
			    }
	    		this.discounts = discounts

	    		const units = []
	    		for (let i = 30; i >= 1; --i) {
			        units.push({
	    				unit: i
	    			})
			    }
			    this.units = units

			    const gwas = []
	    		for (let i = 3.0; i >= 1.0; i -= 0.01) {
			        gwas.push({
	    				gwa: i.toFixed(2)
	    			})
			    }
			    this.gwas = gwas

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