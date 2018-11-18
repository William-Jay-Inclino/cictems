<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<div id="app" v-cloak>

<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li><a :href="page.show">Show</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Update Form</a></li>
		  </ul>
		</nav>
	</div>

	<div class="container" style="max-width: 600px;">
		<h5 class="title is-4" style="text-align: center">{{ page.title }}</h5>
		<div class="box">
			<div class="field">
			  <label class="label">School Year</label>
			  <div class="control">
				  	<multiselect v-model="form.sy" track-by="sy" label="sy" :options="sy"></multiselect>
			  </div>
			  	<p class="help has-text-danger">
					{{error.sy}}
				</p>
			</div>
			<div class="field">
			  <label class="label">Semester</label>
			  <div class="control">
				  	<multiselect v-model="form.sem" track-by="semID" label="semDesc" :options="semesters"></multiselect>
			  </div>
			  	<p class="help has-text-danger">	
					{{error.sem}}
				</p>
			</div>
			<br>
			<button class="button is-link is-pulled-right" v-on:click="submitForm">Save changes</button>
			<br><br>
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
		    	page:{
		    		title: 'Edit Term',
		    		list: '<?php echo base_url() ?>maintenance/term',
		    		show: '<?php echo base_url()."maintenance/term/show/".$record->termID ?>'
		    	},

		    	form: {
		    		id: '<?php echo $record->termID ?>',
		    		sy: {sy: '<?php echo $record->schoolYear ?>'},
		    		sem: {semID: '<?php echo $record->semID ?>',semDesc: '<?php echo $record->semDesc ?>'},
		    	},
		    	error: {
		    		sy: '',
		    		sem: ''
		    	},

		    	sy: [],
		    	semesters: []
		    },
		    created() {
		    	this.fetchSY()
		    	this.fetchSemester()
		    },
		    computed: {

			  },
		    watch: {


		    },
		    methods: {
		    	fetchSY(){
		    		const sy = []
		    		const curSY = (new Date()).getFullYear()
		    		for(let i = curSY; i>=2000; --i){
		    			let out = i + 1
		    			let text = i + '-' + out
		    			sy.push({sy: text})
		    		}
		    		this.sy = sy
		    	},
		        fetchSemester() {
		        	this.$http.get('<?php echo base_url() ?>maintenance_Term/get_semesters')
		        	.then(response => {
		        		this.semesters = response.body
					 })
		        },
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_Term/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c.status == 0){
			        			swal('Term already exist', {
							      icon: 'warning',
							    })
			        		}else{
			        			swal('Term successfull updated', {
							      icon: 'success',
							    }).then((x) => {
								  if (x) {
								    window.location.href = this.page.show
								  }
								})
			        		}
						 })
		        	}else{
		        		swal('Unable to submit. Please review the form', {
					      icon: 'warning',
					    });
		        	}
		        },checkForm(f){
		        	let ok = true
		        	const errMsg = 'This field is required'
		        	if(f.sy == null){
		        		this.error.sy = errMsg
		        		ok = false
		        	}else{
		        		this.error.sy = ''
		        	}
		        	if(f.sem == null){
		        		this.error.sem = errMsg
		        		ok = false
		        	}else{
		        		this.error.sem = ''
		        	}
		        	return ok
		        }
		   },

		   http: {
            emulateJSON: true,
            emulateHTTP: true
    		}


		});


	}, false);

</script>


<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>

