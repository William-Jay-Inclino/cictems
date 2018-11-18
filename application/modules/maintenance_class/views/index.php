<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Class
      </h1>
      <h2 class="subtitle">
        Maintenance
      </h2>
    </div>
  </div>
</section>

<section id="app" class="section" v-cloak>
	<div class="container">
		<div class="columns">
			<div class="column">
				<label class="label">Term</label>
				<multiselect v-model="current_term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
			</div>
			<div class="column">
				<label class="label">Section</label>
				<multiselect v-model="section" track-by="secID" label="secName" :options="sections"></multiselect>
			</div>
			<div class="column">
				<label class="label">Action</label>
				<a href="<?php echo base_url() ?>maintenance/class/form" class="button is-primary">Single Add</a>
				<a href="<?php echo base_url() ?>maintenance/class/form-batch" class="button is-primary">Batch Add</a>
				<a :href="'<?php echo base_url() ?>maintenance/class/form-batch/' + section.secID + '/' + current_term.termID" class="button is-primary" v-if="records.length > 0">Batch Update</a>
			</div>
		</div>
		<div class="box" v-show="ready">
			<h5 class="title is-5" v-if="ready">{{section.secName}} </h5>
			<hr>
			<table class="table is-fullwidth is-centered">
				<thead>
					<th width="15%">Class Code</th>
					<th width="20%">Description</th>
					<th width="8%">Day</th>
					<th width="20%">Time</th>
					<th width="12%">Room</th>
					<th width="20%">Instructor</th>
					<th width="5%">View</th>
				</thead>

				<td colspan="7" class="has-text-centered" v-show="loading">Loading please wait ...</td>
				<td colspan="7" class="has-text-centered" v-show="msg">No record found</td>

				<tbody v-show="!loading">
					<tr v-for="record, i in records">
						<td>{{record.classCode}}</td>
						<td>{{record.subDesc}}</td>
						<td>{{record.dayDesc}}</td>
						<td>{{record.class_time}}</td>
						<td>{{record.roomName}}</td>
						<td>{{record.faculty}}</td>
						<td>
							<a :href="show + '/' + record.classID" class="button is-outlined is-primary"><i class="fa fa-angle-double-right fa-lg"></i></a>
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
	    	ready: false,
	    	loading: true,
	    	msg: false,
	    	secID: '<?php echo $secID ?>',
	    	show: '<?php echo base_url() ?>maintenance/class/show',
	    	current_term: {termID: '<?php echo $current_term->termID; ?>', term: '<?php echo $current_term->term; ?>'},
	    	section: null,
	        terms: [],
	        sections: [],

    		records: []
	    },
	    created() {
	        this.populate()
	       this.check_default_section()
	    },
	    watch: {
	    	section(val){
	    		if(val == null){
	    			this.records = []
	    			this.ready = false
	    		}else{
	    			this.ready = true
	    			this.fetchData()
	    		}
	    	},
	    	current_term(val){
	    		if(this.section != null){
	    			this.fetchData()
	    		}
	    	}
	    },
	    methods: {
	        populate() {
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/populate2')
	        	.then(response => {
	        		const c = response.body
	        		this.terms = c.term
	        		this.sections = c.sections
				 })
	        },
	        check_default_section(){
	        	const secID = this.secID 
	        	if(secID != 0){
	        		this.$http.get('<?php echo base_url() ?>maintenance_class/get_secName/' + secID)
		        	.then(response => {
		        		this.section = {secID: secID, secName: response.body}
					 })
	        	}
	        },
	        fetchData(){
	        	this.loading = true
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/read/' + this.section.secID + '/' + this.current_term.termID)
	        	.then(response => {
	        		const c = response.body
	        		this.records = c 
	        		if(c.length == 0){
	        			this.msg = true
	        		}else{
	        			this.msg = false
	        		}
	        		this.loading = false
				 })
	        }

	    }
	})

}, false)



</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>