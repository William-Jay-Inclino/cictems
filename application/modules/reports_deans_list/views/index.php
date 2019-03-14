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
			<div class="column">
				<label class="label">Term</label>
	            <multiselect @input="populate" v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
			</div>
			<div class="column">
				<div class="is-pulled-right">
					<a :href="'<?php echo base_url() ?>reports/deans-lists/download/' + term.termID" class="button is-primary" target="_blank">Generate Report</a>
				</div>
			</div>
		</div>
		
		<div class="box">
			<h4 class="title is-4"> <span class="icon has-text-primary"> <i class="fa fa-users"></i> </span> Students</h4>
			<hr>
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>#</th>
						<th>Name of student</th>
						<th>Course</th>
						<th>Yearlevel</th>
						<th>GWA</th>
						<th>Discount</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="student, i of students">
						<td> {{++i}} </td>
						<td> {{student.student.name}} </td>
						<td> {{student.student.courseCode}} </td>
						<td> {{student.student.yearDesc}} </td>
						<td> {{student.gwa}} </td>
						<td> {{student.discount}} </td>
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
	    	page_title: 'Deans Honor Lists',
	    	term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
	    	terms: [],
	    	students: []
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
	    		this.$http.get('<?php echo base_url() ?>reports_deans_list/populate/' + this.term.termID)
	        	.then(response => {
	        		this.students = response.body
	        		console.log(response.body)
	        		
				 }, e => {
				 	console.log(e.body);

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