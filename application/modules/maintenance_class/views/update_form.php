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
		
		<div class="box">
			<h5 class="title is-4 has-text-primary" style="text-align: center">{{ page.title }}</h5>
			<hr>
			<div class="field">
			  <label class="label">Term</label>
			  <div class="control">
				  	<p style="font-size: 14px">{{form.term.term}}</p>
			  </div>
			</div>
			
			<div class="field">
			  <label class="label">Prospectus</label>
			  <div class="control">
			  		<p style="font-size: 14px">{{form.pros}}</p>
			  </div>
			</div>
			
			<div class="field">
			  <label class="label">Class Code</label>
			  <div class="control">
			   <p style="font-size: 14px">{{form.classCode}}</p>
			  </div>
			</div>

			<div class="field">
			  <label class="label">Day</label>
			  <div class="control">
			    <multiselect v-model="form.day" track-by="dayID" label="dayDesc" :options="days"></multiselect>
			  </div>
			  <p class="help has-text-danger">
			  	 {{error.day}}
			  </p>
			</div>

			<div class="field">
				<div class="columns">
					<div class="column is-half">
						<label class="label">Time in</label>
						<div class="control">
							<input class="input" type="time"  v-model="form.time_in">
						</div>
						<p class="help has-text-danger">
					  	 {{error.timeIn}}
					  </p>
					</div>
					<div class="column">
						<label class="label">Time Out</label>
						<div class="control">
							<input class="input" type="time"  v-model="form.time_out">
						</div>
						<p class="help has-text-danger">
					  	 {{error.timeOut}}
					  </p>
					</div>
				</div>
			</div>

			<div class="field">
				<label class="label">Room</label>
				<div class="control">
					<multiselect v-model="form.room" track-by="roomID" label="roomName" 
					:options="rooms"></multiselect>
				</div>
				<p class="help has-text-danger">
					{{error.room}}
				</p>
			</div>
			
			<div class="field">
				<label class="label">Faculty</label>
				<div class="control">
					<multiselect v-model="form.faculty" track-by="facID" label="faculty" 
					:options="faculties"></multiselect>
				</div>
				<p class="help has-text-danger">
					{{error.faculty}}
				</p>
			</div>

			<div class="field">
				<label class="label">Section</label>
				<div class="control">
					<multiselect v-model="form.section" track-by="secID" label="secName" 
					:options="sections" required></multiselect>
				</div>
				<p class="help has-text-danger">
					{{error.section}}
				</p>
			</div>
			<br>
			<button class="button is-link is-pulled-right" v-on:click="submitForm">Submit</button>
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
		    	isLoading: false,
		    	isDisabled: true,
		    	page:{
		    		title: 'Update Class',
		    		list: '<?php echo base_url() ?>maintenance/class',
		    		show: '<?php echo base_url()."maintenance/class/show/".$record->classID ?>'
		    	},
		    	form: {
		    		id: '<?php echo $record->classID ?>',
		    		classCode: '<?php echo $record->classCode ?>',
		    		term: {termID: '<?php echo $record->termID ?>', term: '<?php echo $record->term ?>'},
	    			pros: '<?php echo $record->prosCode ?>',
		    		day: {dayID: '<?php echo $record->dayID ?>', dayDesc: '<?php echo $record->dayDesc ?>'},
		    		time_in: '<?php echo $record->timeIn ?>',
		    		time_out: '<?php echo $record->timeOut ?>',
		    		room: {roomID: '<?php echo $record->roomID ?>', roomName: '<?php echo $record->roomName ?>'},
		    		faculty: {facID: '<?php echo $record->facID ?>', faculty: '<?php echo $record->faculty ?>'},
		    		section: {secID: '<?php echo $record->secID ?>', secName: '<?php echo $record->secName ?>'}
		    	},
		    	error: {
		    		day: '',
		    		timeIn: '',
		    		timeOut: '',
		    		room: '',
		    		faculty: '',
		    		section: ''
		    	},
		    	rooms: [],
		    	days: [],
		    	faculties: [],
		    	sections: []
		    },
		    created(){
		    	this.populate()
		    },
		    methods: {
		    	populate(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_class/populate')
		        	.then(response => {
		        		const c = response.body
		        		this.rooms = c.rooms
		        		this.days = c.days
		        		this.faculties = c.faculties
		        		this.sections = c.sections
					 });
		    	},
		        submitForm() {
		        	const f = this.form
		        	if(this.checkForm(f)){
		        		this.$http.post('<?php echo base_url() ?>maintenance_class/update',f)
			        	.then(response => {
			        		const c = response.body
			        		console.log(c)
			        		if(c == 'exist'){
			        			swal('Class already exist', {
							      icon: 'warning',
							    });
			        		}else{
			        			swal('Class successfully updated', {
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
		        },
		        checkForm(f){
        			let ok = true
		        	const msg = 'This field is required'

		        	if(!f.classCode){
		        		this.error.classCode = msg;
        				ok = false
		        	}else{
		        		this.error.classCode = '';
		        	}
        			if(f.day == null){
        				this.error.day = msg;
        				ok = false
        			}else{
        				this.error.day = '';
        			}
        			if(!f.time_in){
        				this.error.timeIn = msg;
        				ok = false
        			}else{
        				this.error.timeIn = '';
        			}
        			if(!f.time_out){
        				ok = false
        				this.error.timeOut = msg;
        			}else{
        				this.error.timeOut = '';
        			}
        			if(f.room == null){
        				ok = false
        				this.error.room = msg;
        			}else{
        				this.error.room = '';
        			}
        			if(f.faculty == null){
        				ok = false
        				this.error.faculty = msg;
        			}else{
        				this.error.faculty = '';
        			}
        			if(f.section == null){
        				ok = false
        				this.error.section = msg;
        			}else{
        				this.error.section = '';
        			}

        			return ok

		        },
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

