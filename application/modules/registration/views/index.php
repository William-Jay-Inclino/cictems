<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Registration
      </h1>
    </div>
  </div>
</section>

<section id="app" class="section" v-cloak>
	<div class="container">
		<div class="box">
			<div class="columns">
				<div class="column">
					<h5 class="title is-5">
                        {{page.data_list}}
                     </h5>
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
					<th>Role</th>
					<th>Username</th>
					<th>Name</th>
					<th>Select</th>
				</thead>

				<td colspan="9" class="has-text-centered" v-show="loading">Loading please wait ...</td>
				<td colspan="9" class="has-text-centered" v-show="msg">No record found</td>

				<tbody v-show="!loading">
					<tr v-for="record, i in records2">
						<td>{{record.role}}</td>
						<td>{{record.userName}}</td>
						<td>{{record.name}}</td>
						<td>
							<a :href="page.show + '/' + record.regID" class="button is-outlined is-primary"><i class="fa fa-angle-double-right fa-lg"></i></a>
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

	Vue.component('paginate', VuejsPaginate)

	new Vue({
	    el: '#app',
	    data: {
	    	loading: true,
	    	pagination: true,
	    	msg: false,
	    	page:{
	    		data_list: 'Registration requests',
	    		users: 'View users',
	    		users_link: '<?php echo base_url() ?>users/registration/view-users',
	    		show: '<?php echo base_url() ?>users/registration/show'
	    	},
	    	entries: ['10','25','50','100'],
    		total_records: 0,
    		per_page: '10',
    		pagination_links: '',
    		current_page: 1,

    		search_value: '',
    		option: 'userName',
    		search_options: [
    			{value: 'userName', text: 'Username'},
    			{value: 'name', text: 'Name'}
    		],

	        records: []
	       
	    },
	    created() {
	        this.fetchData(1) 
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
	    	},
	    	records2(){
	    		return this.records.map(rec => {
	    			let role = 'Student'
	    			if(rec.roleID == '2'){
	    				role = 'Faculty'
	    			}else if(rec.roleID == '3'){
	    				role = 'Staff'
	    			}else if(rec.roleID == '5'){
	    				role = 'Guardian'
	    			}
	    			rec.role = role
	    			return rec
	    		})
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
	        	this.$http.get('<?php echo base_url() ?>registration/read/'+this.option+'/'+this.value + '/' + page + '/' + this.per_page)
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
	        }
	    }
	})

}, false)



</script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-paginate/vue-paginate.js"></script>
