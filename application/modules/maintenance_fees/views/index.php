<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
	.tag-width{
		width: 70px;
	}
</style>

<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
		<div class="columns">
			<div class="column is-4">
				<multiselect v-model="current_term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
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
					<a class="button is-primary is-pulled-right" v-bind:href="page.add_link">
					   {{page.add}}
				  	</a>
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
			<table class="table is-fullwidth">
				<thead>
					<th>Name of fee</th>
					<th>Description</th>
					<th>Amount</th>
					<th>Due date</th>
					<th>Status</th>
					<th>View</th>
				</thead>

				<td colspan="9" class="has-text-centered" v-show="loading">Loading please wait ...</td>
				<td colspan="9" class="has-text-centered" v-show="msg">No record found</td>

				<tbody v-show="!loading">
					<tr v-for="record, i in records">
						<td>{{record.feeName}}</td>
						<td>{{record.feeDesc}}</td>
						<td>{{record.amount}}</td>
						<td>{{record.dueDate}}</td>
						<td>
							<span v-if="record.termID != termID && record.feeStatus != 'cancelled'">
								<span class="tag is-success tag-width">Done</span>
							</span>
							<span v-else-if="record.feeStatus == 'cancelled'">
								<span class="tag is-danger tag-width">Cancelled</span>
							</span>
							<span v-else>
								<span class="tag is-link tag-width">On going</span>
							</span>
						</td>
						<td>
							<a :href="page.show + '/' + record.feeID" class="button is-outlined is-primary"><i class="fa fa-angle-double-right fa-lg"></i></a>
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
	Vue.component('paginate', VuejsPaginate);

	new Vue({
	    el: '#app',
	    data: {
	    	page_title: 'Departmental Fees',
	    	loading: true,
	    	pagination: true,
	    	msg: false,
	    	current_term: {termID: '<?php echo $current_term->termID; ?>', term: '<?php echo $current_term->term; ?>'},
	    	termID: '<?php echo $current_term->termID; ?>',
	    	page:{
		    	data_list: 'List of Fees',
		    	add: 'Add Fees',
		    	add_link: '<?php echo base_url() ?>maintenance/fees/form',
		    	show: '<?php echo base_url() ?>maintenance/fees/show'
	    	},

    		entries: ['10','25','50','100'],
    		total_records: 0,
    		per_page: '10',
    		pagination_links: '',
    		current_page: 1,

    		search_value: '',
    		option: 'feeName',
    		search_options: [
    			{value: 'feeName', text: 'Fee'},
    			{value: 'feeDesc', text: 'Description'}
    		],

	        records: [],
	        terms: []
	       
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
	    	},current_term(){
	    		this.pagination = false
	    		this.fetchData(1)
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
	        	this.$http.get('<?php echo base_url() ?>maintenance_fees/read/'+this.option+'/'+this.value + '/' + page + '/' + this.per_page + '/' + this.current_term.termID)
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
	        fetchTerm() {
	        	this.$http.get('<?php echo base_url() ?>reusable/get_all_term')
	        	.then(response => {
	        		this.terms = response.body
				 })
	        }

	    }
	})

}, false)



</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-paginate/vue-paginate.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>