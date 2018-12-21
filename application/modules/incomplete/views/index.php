<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
		<div class="column">
			<div class="columns">
				<div class="column is-4">
					<label class="label">Filter term</label>
					<multiselect v-model="term" track-by="termID" label="term" :options="terms" @input="search"></multiselect>
				</div>
			</div>
		</div>
		<div class="box">
	         <div class="columns">
	         	<div class="column">
	         		<h5 class="title is-5">
			            {{page.data_list}}
			         </h5>
	         	</div>
	         	<div class="column">
	         		<div class="is-pulled-right">
	         			<button class="button is-danger" @click="fail_students" v-if="total_records > 0">Fail students</button>
							         			
	         		</div>
	         	</div>
	         </div>
			<hr>
			<div class="columns">
				<div class="column is-2">
					<div class="control has-icons-left">
						<div class="select">
					      <select v-model="per_page">
					        <option v-for="entry in entries" :value="entry">{{ entry }}</option>
					      </select>
					    </div>
					    <div class="icon is-small is-left">
					      <i class="fa fa-eye"></i>
					    </div>
					</div>
				</div>
				<div class="column is-6 is-offset-4">
					<div class="is-pulled-right">
						<div class="field has-addons">
							<div class="control">
								<span class="select">
									<select v-model="option">
										<option v-for="option in search_options" :value="option.value">
											{{ option.text }}
										</option>
									</select>
								</span>
							</div>
						  <div class="control">
						    <input class="input" type="text" v-model="search_value" placeholder="Search" v-on:keyup.enter="search">
						  </div>
						  <div class="control">
						    <a class="button is-info" v-on:click="search">
						      <span class="icon">
						      	<i class="fa fa-search"></i>
						      </span>
						    </a>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<table class="table is-fullwidth is-centered">
				<thead>
					<th>Control number</th>
					<th>Name</th>
					<th>Course</th>
					<th>Yearlevel</th>
					<th>Term</th>
					<th>Select</th>
				</thead>

				<td colspan="9" class="has-text-centered" v-show="loading">Loading please wait ...</td>
				<td colspan="9" class="has-text-centered" v-show="msg">No record found</td>

				<tbody v-show="!loading">
					<tr v-for="record, i in records">
						<td>{{record.controlNo}}</td>
						<td>{{record.name}}</td>
						<td>{{record.courseCode}}</td>
						<td>{{record.yearDesc}}</td>
						<td>{{record.term}}</td>
						<td>
							<a :href="page.show + '/' + record.studID + '/' + record.termID" class="button is-outlined is-primary"><i class="fa fa-angle-double-right fa-lg"></i></a>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<div class="is-pulled-right">
				<div v-if="pagination">
					<paginate
						:container-class="'pagination'"
					 	:page-count="pages"
					 	:click-handler="nextPage"
						:hide-prev-next="true"
						:prev-text="'&laquo;'"
						:next-text="'&raquo;'"
						:no-li-surround="true"
				  	>
					</paginate>
				</div>
			</div>
			<br>
		</div>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {
	Vue.component('multiselect', window.VueMultiselect.default) 
	Vue.component('paginate', VuejsPaginate)

	new Vue({
	    el: '#app',
	    data: {
	    	page_title: 'Incomplete',
	    	loading: true,
	    	pagination: true,
	    	msg: false,
	    	page:{
	    		data_list: 'List of students that has incomplete grade',
	    		show: '<?php echo base_url() ?>incomplete/classes'
	    	},

	       	entries: ['10','25','50','100'],
    		total_records: 0,
    		per_page: '10',
    		pagination_links: '',
    		current_page: 1,

    		search_value: '',
    		option: 's.controlNo',
    		search_options: [
    			{value: 's.controlNo', text: 'Control No'},
    			{value: 'name', text: 'Name'}
    		],
    		term: {termID: 'all', term: 'All'},
    		terms: [],

	        records: []
	    },
	    created() {
	        this.fetchData(1)
	        this.fetchTerm()
	    },
	    watch: {
	    	search_value(value){
	    		if(value == ''){
	    			this.fetchData(1)
	    		}
	    	},
	    	per_page(){
	    		this.pagination = false
	    		this.fetchData(1)
	    	}
	    },
	    computed: {
	    	value(){
	    		let v = this.search_value
	    		if(v == ''){
	    			v = '_'
	    		}
	    		return v.replace(/\s/g, "_")
	    	},
	    	pages(){
	    		return Math.ceil(this.total_records / this.per_page)
	    	}
	    },
	    methods: {
	    	fetchTerm() {
	        	this.$http.get('<?php echo base_url() ?>reusable/get_all_term')
	        	.then(response => {
	        		this.terms = response.body
	        		this.terms.unshift({termID: 'all', term: 'All'})
				 });
	        },
	    	nextPage(page){
	    		this.fetchData(page)
	    	},
	    	search(){
	    		this.pagination = false
	    		this.fetchData(1)
	    	},
	        fetchData(page) {
	        	this.current_page = page
	        	this.loading = true
	        	this.msg = false
	        	this.$http.get('<?php echo base_url() ?>incomplete/read/'+this.option+'/'+this.value + '/' + page + '/' + this.per_page +'/'+this.term.termID)
	        	.then(response => {
	        		const c = response.body
	        		console.log(c)
	        		this.records = c.records
	        		this.loading = false
	        		this.total_records = c.total_rows
	        		if(c.total_rows == 0){
	        			this.pagination = false
	        			this.msg = true
	        		}else{
	        			this.pagination = true
	        		}
				 })
	        },
	        fail_students(){
	        	let msg = 'All students with incomplete grades will have a grade of 5.0'
	        	if(this.term.termID != 'all'){
	        		msg = 'Students with incomplete grades will have a grade of 5.0 in the term '+ this.term.term
	        	}
	        	swal({
				  title: "Are you sure?",
				  text: msg,
				  icon: "warning",
				  buttons: {
				  	cancel: true,
				  	confirm: {
				  		closeModal: false
				  	}
				  },
				  dangerMode: true
				})
				.then((yes) => {
				  if (yes) {
				    this.$http.get('<?php echo base_url() ?>incomplete/fail_students/' + this.term.termID)
		        	.then(response => {
		        		const c = response.body
		        		if(c == ''){
		        			swal('Success', 'Successfully fail students', 'success')
		        			this.records = []
			        		this.loading = false
			        		this.total_records = 0
			        		this.pagination = false
			        		this.msg = true
		        		}else{
		        			alert('Something went wrong. Please report the issue. Error: '+c)
		        		}
					 })
				  }
				})
	        }
	    }
	})

}, false)



</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-paginate/vue-paginate.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>