<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">


<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Classes
      </h1>
    </div>
  </div>
</section>

<section id="app" class="section" v-cloak>
	<div class="container">
		<div class="columns">
			<div class="column is-4">
				<multiselect v-model="current_term" track-by="termID" label="term" :options="terms"></multiselect>
			</div>
		</div>
		<div class="box">
            <div class="columns">
               <div class="column is-half">
                  <div class="field">
                     <label class="label">Search faculty:</label>
                     <div class="control">
                        <multiselect v-model="faculty" track-by="facID" label="name" :options="faculties"></multiselect>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div v-show="ready">
			<div class="box">
				<div class="columns">
					<div class="column">
						<h5 class="title is-5">Classes</h5>
					</div>
					<div class="column">
						<span class="is-pulled-right"> Total number of loads: <b>{{total_loads}}</b> </span>
					</div>
				</div>
				<hr><table class="table is-fullwidth">
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
								<a :href="selected_link + c.facID + '/' + c.termID + '/' + c.id + '/' + c.prosID" class="button is-outlined is-primary">
									<i class="fa fa-angle-double-right fa-lg"></i>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</section>






<script>

document.addEventListener('DOMContentLoaded', function() {

	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	selected_link: 'class-selected/',
	    	current_term: {termID: '<?php echo $current_term->termID; ?>', term: '<?php echo $current_term->term; ?>'},
	    	terms: [],

	    	faculty: null,
	    	faculties: [],
	    	ready: false,

	    	classes: [],
	       
	    },
	    created() {
	        this.fetchTerm()
	        this.fetchFaculty()
	    },
	    watch: {
	    	faculty(val){
	    		if(val != null){
	    			this.fetchClasses(val.facID)
	    			this.ready = true
	    		}else{
	    			this.ready = false
	    		}
	    	},
	    	current_term(){
	    		const f = this.faculty
	    		if(f != null){
	    			this.fetchClasses(f.facID)
	    		}
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
	        		this.terms = response.body;
				 });
	        },
	        fetchFaculty() {
	        	this.$http.get('<?php echo base_url() ?>classes/get_faculties')
	        	.then(response => {
	        		this.faculties = response.body;
				 });
	        },
	        fetchClasses(facID){
	        	this.$http.get('<?php echo base_url() ?>classes/get_classes/'+facID+'/'+this.current_term.termID)
	        	.then(response => {
	        		console.log(response.body)
	        		this.classes = response.body;
				 }, e => {
				 	console.log(e.body);

				 })
	        }
	    }
	});

}, false);



</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>