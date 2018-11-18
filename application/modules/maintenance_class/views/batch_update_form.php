<style>
	.err{
		color: red;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<section id="app" class="section" v-cloak>
	<div class="container">

		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Update Form</a></li>
		  </ul>
		</nav>
		
		<div class="box">
			<div class="columns">
				<div class="column">
					<label class="label">Term</label>
					<p style="font-size: 14px"> {{current_term}} </p>
				</div>
				<div class="column">
					<label class="label">Prospectus</label>
					<p style="font-size: 14px"> {{prospectus}} </p>
				</div>
				<div class="column">
					<label class="label">Year</label>
					<p style="font-size: 14px"> {{year}} </p>
				</div>
			</div>
		</div>
		<div class="box">
			<div class="column is-4">
				<label class="label">Section</label>
				<multiselect v-model="section" track-by="secID" label="secName" :options="sections" placeholder="Select Section"></multiselect>
				<p class="help has-text-danger" v-if="errSection"> This field is required </p>
			</div>
			<hr>
			<table class="table is-fullwidth is-centered">
				<thead>
					<tr>
						<th width="10%">Code</th>
						<th width="25%">Description</th>
						<th width="20%" colspan="2">Time</th>
						<th width="10%">Day</th>
						<th width="15%">Room</th>
						<th width="20%">Instructor</th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<th>In</th>
						<th>Out</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="record, i in classes" :class="{err: record.error}">
						<td>{{record.subCode}}</td>
						<td>{{record.subDesc}}</td>
						<td> <input v-model="record.timeIn" type="time" class="input"> </td>
						<td> <input v-model="record.timeOut" type="time" class="input"> </td>
						<td>
							<multiselect v-model="record.day" track-by="dayID" label="dayDesc" :options="days" placeholder=""></multiselect>
						</td>
						<td>
							<multiselect v-model="record.room" track-by="roomID" label="roomName" :options="rooms" placeholder=""></multiselect>
						</td>
						<td>
							<multiselect v-model="record.faculty" track-by="facID" label="faculty" :options="faculties" placeholder=""></multiselect>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<button class="button is-link is-pulled-right" @click="submitForm">Update </button>
			<br><br>
		</div>
	</div>

</section>






<script>

document.addEventListener('DOMContentLoaded', function() {
	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	page:{
	    		title: 'Add Classes',
	    		list: '<?php echo base_url() ?>maintenance/class',
	    		success: '<?php echo base_url() ?>maintenance/class/form-success/'
	    	},
	    	secID: '<?php echo $secID ?>',
	    	termID: '<?php echo $termID ?>',
	    	current_term: '',
	    	prospectus: '',
	    	year: '',
	    	section: null,
	        classes: [],
	        rooms: [],
	        days: [],
	        faculties: [],
	        sections: [],
	    	errSection: false
	    },
	    created() {
	    	this.populate()
	        this.populate_update_batch()
	    },
	    methods: {
	    	populate() {
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/populate')
	        	.then(response => {
	        		const c = response.body
	        		this.rooms = c.rooms 
	        		this.days = c.days 
	        		this.faculties = c.faculties
	        		this.sections = c.sections
				 })
	        },
	        populate_update_batch() {
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/populate_update_batch/'+this.secID+'/'+this.termID)
	        	.then(response => {
	        		this.prepareForm(response.body)
				 })
	        },
	        getSections(prosID){
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/getSections/' + prosID)
	        	.then(response => {
	        		const c = response.body
	        		this.sections = c.sections
				 })
	        },
	        prepareForm(classes){
	        	this.getSections(classes[0].prosID)
	        	const arr = []
	        	this.current_term = classes[0].term
	        	this.prospectus = classes[0].prosCode
	        	this.year = classes[0].yearDesc
	        	this.section = {secID: classes[0].secID, secName: classes[0].secName}
	        	for(c of classes){
	        		arr.push({
	        			classID: c.classID,
	        			subCode: c.subCode,
	        			subDesc: c.subDesc,
	        			day: {dayID: c.dayID, dayDesc: c.dayDesc},
	        			timeIn: c.timeIn,
	        			timeOut: c.timeOut,
	        			room: {roomID: c.roomID, roomName: c.roomName},
	        			faculty: {facID: c.facID, faculty: c.faculty},
	        			error: false
	        		})
	        	}
	        	this.classes = arr
	        },
	        submitForm(){
	        	const c = this.classes 
	        	if(this.checkForm(c)){
	        		this.$http.post('<?php echo base_url() ?>maintenance_class/update_batch', {termID: this.termID, oldSecID: this.secID, newSecID: this.section.secID, classes: c})
		        	.then(response => {
		        		const c = response.body
		        		if(c == 'success'){
		        			swal('Classes successfully updated!', {
						      icon: 'success',
						    })
						    .then((x) => {
							  window.location.href = this.page.list + '/' + this.section.secID
							})
		        		}else{
		        			swal(c, {
						      icon: 'error',
						    });
		        		}
		        		
					 })
	        	}else{
	        		swal('All fields are required!','Please review the form', {
				      icon: 'error',
				    });
	        	}
	        },
	        checkForm(classes){
	        	let ok = true
	        	if(this.section == null){
	        		ok = false
	        		this.errSection = true
	        	}else{
	        		this.errSection = false
	        	}
	        	for(c of classes){
	        		if(c.day == null || !c.timeIn || !c.timeOut || c.room == null || c.faculty == null){
	        			c.error = true
	        			ok = false
	        		}else{
	        			c.error = false
	        		}
	        	}
	        	return ok
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
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>