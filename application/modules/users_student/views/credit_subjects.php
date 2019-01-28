<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
	.btn-height{
	    height: 40px;
	  }
</style>

<div id="app" v-cloak>
	<section class="section">
		<div class="container">
			<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
			  <ul>
			    <li><a :href="page.list">List</a></li>
			    <li><a :href="page.show">Show</a></li>
			    <li class="is-active"><a href="#" aria-current="page">Credit subjects</a></li>
			  </ul>
			</nav>

			<div class="box">
				<div class="columns">
					<div class="column">
						<label class="label">Term</label>
						<multiselect v-model="term" label="term" track-by="termID" :options="terms" :allow-empty="false"></multiselect>
					</div>
					<div class="column">
						<label class="label">Subjects</label>
						<multiselect v-model="subjects" label="subCode" track-by="id" placeholder="Enter subject code" :options="searched_subjects" :multiple="true" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="false" :show-no-results="false" :hide-selected="true" @search-change="searchSubjects" :max-height="600">
						</multiselect>
					</div>
				</div>
				<button @click="add_credit" :class="{'button is-primary btn-height': true, 'is-loading': is_loading_btnAdd}" :disabled="is_disabled_btnAdd">Credit</button>
			</div>

			<div class="box">
				<h5 class="title is-5">Credited Subjects</h5>
				<hr>
				<table class="table is-fullwidth">
					<thead>
						<th>Subject Code</th>
						<th>Description</th>
						<th style="text-align: center;">Units</th>
						<th style="text-align: center;">Remove</th>
					</thead>
					<tbody>
						<tr v-for="cs, i in credited_subjects">
							<td> {{cs.subCode}} </td>
							<td> {{cs.subDesc}} </td>
							<td style="text-align: center;"> {{cs.units}} </td>
							<td style="text-align: center;"> 
								<button @click="remove_credit(i)" class="button is-small"> <i class="fa fa-times has-text-danger"></i> </button> 
							</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</section>
</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		Vue.component('multiselect', window.VueMultiselect.default) 

		new Vue({
		    el: '#app',
		    data: {
		    	term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
		    	is_loading_btnAdd: false,
		    	studID: '<?php echo $studID ?>',
		    	page:{
		    		show: '<?php echo base_url()."users/student/show/".$studID ?>',
		    		list: '<?php echo base_url() ?>users/student'
		    	},
		    	subjects: null,
		    	searched_subjects: [],
		    	credited_subjects: [],
		    	terms: [],
		    	isLoading: false,
		    },
		    created(){
		    	this.get_terms()
		    	this.get_credited_subjects()
		    },
		    computed: {
		    	is_disabled_btnAdd(){
		    		if(this.subjects){
		    			return false 
		    		}else{
		    			return true
		    		}
		    	}
		    },
		    methods: {
		    	get_terms(){
		    		this.$http.get('<?php echo base_url() ?>reusable/get_all_term')
		    		.then(res => {
		    			this.terms = res.body
		    		}, e => {
		    			console.log(e.body)
		    		})
		    	},

		    	get_credited_subjects(){
		    		this.$http.get('<?php echo base_url() ?>users_student/get_credited_subjects/' + this.studID)
		    		.then(res => {
		    			// console.log(res.body)
		    			this.credited_subjects = res.body
		    		}, e => {
		    			console.log(e.body)
		    		})
		    	},
		    	searchSubjects(val){
		    		this.isLoading = true
		    		this.$http.post('<?php echo base_url() ?>users_student/searchSubjects', {studID: this.studID, value: val})
		    		.then(res => {
		    			// console.log(res.body)
		    			this.isLoading = false
		    			this.searched_subjects = res.body
		    		}, e => {
		    			console.log(e.body)
		    		})
		    	},

		    	add_credit(){
		    		this.is_loading_btnAdd = true
		    		this.$http.post('<?php echo base_url() ?>users_student/add_credit', {studID: this.studID, termID: this.term.termID, subjects: this.subjects})
		    		.then(res => {
		    			// console.log(res.body)
		    			swal('Success', 'Subjects successfully credited!', 'success')
		    			this.subjects = null
		    			this.searched_subjects = []
		    			this.is_loading_btnAdd = false
		    			this.credited_subjects = res.body
		    		}, e => {
		    			console.log(e.body)
		    		})
		    	},

		    	remove_credit(i){
		    		const sub = this.credited_subjects[i]
		    		this.$http.post('<?php echo base_url() ?>users_student/remove_credit', {studID: this.studID, subject: sub})
		    		.then(res => {
		    			// console.log(res.body)
		    			this.credited_subjects.splice(i, 1)
		    		}, e => {
		    			console.log(e.body)
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
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
