<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
		<br><br>
		<div class="columns">
			<div class="column is-4">
				<multiselect v-model="current_term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
			</div>
		</div>
		<div class="box">
			<div class="columns">
				<div class="column">
					<h5 class="title is-5">My Classes</h5>
				</div>
				<div class="column">
					<span class="is-pulled-right"> Total number of loads: <b>{{total_loads}}</b> </span>
				</div>
			</div>
			<hr>
			<table class="table is-fullwidth">
				<thead>
					<th class="has-text-centered">Done</th>
					<th>Subject Code</th>
					<th>Description</th>
					<th>Section</th>
					<th>Select</th>
				</thead>
				<tbody>
					<tr v-for="c in classes">
						<td class="has-text-primary has-text-centered">
							<span v-if="c.status == 'unlocked'">
								---
							</span>
							<span v-else>
								<i class="fa fa-check"></i>
							</span>
						</td>
						<td> {{c.subCode}} </td>
						<td> {{c.subDesc}} </td>
						<td> {{c.secName}} </td>
						<td>
							<a :href="selected_link + c.termID + '/' + c.id + '/' + c.prosID + '/' + c.secID" class="button is-outlined is-primary">
								<i class="fa fa-angle-double-right fa-lg"></i>
							</a>
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
	    	page_title: 'My Class',
	    	selected_link: 'my-class/class-selected/',
	    	current_term: {termID: '<?php echo $current_term->termID; ?>', term: '<?php echo $current_term->term; ?>'},
	    	terms: [],
	    	classes: []
	    },
	    created() {
	        this.fetchTerm()
	        this.fetchClasses()
	    },
	    watch: {
	    	current_term(){
	    		this.fetchClasses()
	    	}
	    },
	    computed: {
	    	total_loads(){
	    		return this.classes.length
	    	}
	    },
	    methods: {
	    	fetchTerm() {
	        	this.$http.get('<?php echo base_url() ?>reusable/get_all_term')
	        	.then(response => {
	        		this.terms = response.body
				 })
	        },
	        fetchClasses(){
	        	this.$http.get('<?php echo base_url() ?>my_class/get_classes/'+this.current_term.termID)
	        	.then(response => {
	        		console.log(response.body)
	        		this.classes = response.body
				 });
	        }
	    }
	})

}, false)



</script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>