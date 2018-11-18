<section id="app" class="section" v-cloak>
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.main">Main</a></li>
		    <li><a :href="page.back">Selected Class</a></li>
		    <li class="is-active"><a href="#" aria-current="page">More action</a></li>
		  </ul>
		</nav>
		<br>
	</div>
	<div class="container" style="max-width: 800px">
		<h5 class="title is-4">
			{{ student_name }}
		</h5>
		<b>Enrolled date:</b>&nbsp;&nbsp;{{e_date}}
		<br><br>
		<div v-if="remarks == ''">
			<button v-on:click="display_mod('Dropped')" class="button is-primary" style="width: 100px">Drop</button>
			<button v-on:click="is_safe_to_remove" class="button is-primary" style="width: 100px">Remove</button>
			<button v-on:click="display_mod('Incomplete')" class="button is-primary" style="width: 100px">Incomplete</button>	
		</div>
		<div v-else-if="remarks == 'Incomplete' && class_status == 'unlocked'">
			<button v-on:click="comply" class="button is-success">Comply</button>
		</div>
		<div v-if="class_status == 'locked' && remarks == 'Incomplete'">
				<button v-on:click="comply2" class="button is-success">Comply</button>
		</div>
		<br><br>
		<div class="box">
			<table class="table is-fullwidth is-centered">
				<tr>
					<th>Prelim</th>
					<th>Midterm</th>
					<th>Semi-Finals</th>
					<th>Finals</th>
					<th>FG</th>
					<th>Equivalent</th>
					<th>Remarks</th>
				</tr>
				<tr>
					<td>
						<input type="number" v-model="grade.prelim" :class="inputClass" onpaste="return false;" onKeyPress="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58)return false;" 
						:readonly="inputRead">
					</td>
					<td>
						<input type="number" v-model="grade.midterm" :class="inputClass" onpaste="return false;" onKeyPress="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58)return false;" 
						:readonly="inputRead">
					</td>
					<td>
						<input type="number" v-model="grade.prefi" :class="inputClass" :readonly="inputRead" onpaste="return false;" onKeyPress="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58)return false;">
					</td>
					<td>
						<input type="number" v-model="grade.final" :class="inputClass" :readonly="inputRead" onpaste="return false;" onKeyPress="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58)return false;">
					</td>
					<td> {{ fg }} </td>
					<td> {{ equiv }} </td>
					<td :class="remarksClass"><b> {{ remarks }} </b> </td>
				</tr>
			</table>
			<hr>
			<button class="button is-link pull-right" v-if="show_save" v-on:click="save">Save</button>
			<br>
		</div>
		<div v-if="has_reason" class="box">
			<h5 class="title is-5">
				<i class="fa fa-info-circle has-text-info"></i> Reason
			</h5> <hr>
			<p style="margin-left: 20px">{{ reason2 }}</p>
		</div>
	</div>

	<div class="modal is-active" v-if="show_modal">
     <div class="modal-background"></div>
     <div class="modal-card">
       <header class="modal-card-head">
         <p class="modal-card-title">{{ student_name }}</p>
         <button class="delete" aria-label="close" v-on:click="close_modal"></button>
       </header>
       <section class="modal-card-body">
         <div class="content my-body">
            <label class="label">Action: </label>
            {{action_desc}}
            <br><br>
            <div class="field">
            	<label class="label">Reason:</label>
            	<div class="control">
            		<textarea class="textarea" v-model="reason"></textarea>
            	</div>
            </div>
         </div>
       </section>
       <footer class="modal-card-foot pull-right">
         <button class="button is-outlined" v-on:click="close_modal">Close</button>
         <button v-on:click="submit_action" class="button is-link">Submit</button>
       </footer>
     </div>
   </div>

</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {

		new Vue({
		    el: '#app',
		    data: {
		    	page: {
		    		main: '<?php echo base_url() ?>classes',
		    		back: '<?php echo base_url()."class-selected/".$classID ?>'
		    	},
		    	show_modal: false,
		    	e_date: '',
		    	classID: '<?php echo $classID ?>',
		    	studID: '<?php echo $studID ?>',
		    	student_name: '',
		    	grade: {
		    		prelim: 0,
		    		midterm: 0,
		    		prefi: 0,
		    		final: 0,
		    	},
		    	fg: 0,
		    	equiv: '',
		    	remarks: null,
		    	reason: '',
		    	reason2: '',
		    	class_status: '',

		    	action: '',
		    	action_desc: '',
		    	reason: ''
		    },
		    created() {
		    	this.fetch_stud_data_in_class()
		    },
		    watch: {
		    	
		    },
		    computed: {
		    	has_reason(){
		    		let x = false
		    		if(this.remarks == 'Dropped' || this.remarks == 'Incomplete'){
		    			x = true
		    		}
		    		return x
		    	},
		    	remarksClass(){
		    		let x = {}
		    		if(this.remarks == 'Passed'){
		    			x = {'has-text-success': true}
		    		}else if(this.remarks == 'Failed'){
		    			x = {'has-text-danger': true}
		    		}else if(this.remarks == 'Dropped'){
		    			x = {'has-text-warning': true}
		    		}else if(this.remarks == 'Incomplete'){
		    			x = {'has-text-info': true}
		    		}

		    		return x
		    	},
		    	show_save(){
		    		let ok = false
		    		if(this.remarks != 'Dropped' && this.class_status == 'unlocked'){
		    			ok = true
		    		}
		    		if(this.remarks == 'Incomplete' && this.class_status == 'locked'){
		    			ok = true
		    		}
		    		return ok
		    	},
		    	inputClass(){
		    		let x = {'input has-text-centered': true}
		    		const rem = this.remarks
		    		const cs = this.class_status
		    		if(cs == 'locked' && rem != 'Incomplete'){
		    			x  = {'input has-text-centered is-static': true}
		    		}
		    		if(cs == 'unlocked' && rem == 'Dropped'){
		    			x  = {'input has-text-centered is-static': true}
		    		}
		    		return x
		    	},
		    	inputRead(){
		    		let x = false
		    		const rem = this.remarks
		    		const cs = this.class_status
		    		if(cs == 'locked' && rem != 'Incomplete'){
		    			x  = true
		    		}
		    		if(cs == 'unlocked' && rem == 'Dropped'){
		    			x  = true
		    		}
		    		return x
		    	}
		    },
		    methods: {
		    	fetch_stud_data_in_class(){
		    		this.$http.get('<?php echo base_url() ?>classes/fetch_stud_data_in_class/'+this.classID+'/'+this.studID)
		            .then(response => {
		            	const c = response.body
		            	console.log(c)
		            	this.e_date = c.studclass.enrolled_date   
		            	this.status = c.studclass.status
		            	this.grade.prelim = c.studclass.prelim
		            	this.grade.midterm = c.studclass.midterm
		            	this.grade.prefi = c.studclass.prefi
		            	this.grade.final = c.studclass.final
		            	this.fg = c.studclass.finalgrade
		            	this.remarks = c.studclass.remarks
		            	this.reason = c.studclass.reason
		            	this.reason2 = c.studclass.reason
		            	this.student_name = c.student.student_name
		            	this.equiv = c.equiv
		            	this.class_status = c.studclass.class_status
		            })
		    	},
		    	save(){
		    		const g = this.grade
		    		if(this.validate(g)){
		    			const data = {classID: this.classID, studID: this.studID, grade: g}
		    			this.$http.post('<?php echo base_url() ?>classes/save_grade',data)
			            .then(response => {
			            	const c = response.body
			            	this.grade.prelim = c.prelim
			            	this.grade.midterm = c.midterm
			            	this.grade.prefi = c.prefi
			            	this.grade.final = c.final
			            	this.fg = c.fg
			            	this.equiv = c.equiv
			            	this.remarks = c.remarks
			            	swal('Grade successfully updated!', {icon: 'success'})
			            })
		    		}
		    	},
		    	validate(g){
		    		let x = false

		    		if(isNaN(g.prelim)){
		    			swal('Please enter valid grade in prelim!', {icon: 'error'})
		    		}else if(isNaN(g.midterm)){
		    			swal('Please enter valid grade in midterm!', {icon: 'error'})
		    		}else if(isNaN(g.prefi)){
		    			swal('Please enter valid grade in semi-finals!', {icon: 'error'})
		    		}else if(isNaN(g.final)){
		    			swal('Please enter valid grade in finals!', {icon: 'error'})
		    		}else if(g.prelim > 100 || g.prelim < 60 && g.prelim != 0){
		    			swal('Grade should only be 60-100 in prelim', {icon: 'warning'})
		    		}else if(g.midterm > 100 || g.midterm < 60 && g.midterm != 0){
		    			swal('Grade should only be 60-100 in midterm', {icon: 'warning'})
		    		}else if(g.prefi > 100 || g.prefi < 60 && g.prefi != 0){
		    			swal('Grade should only be 60-100 in semi-finals', {icon: 'warning'})
		    		}else if(g.final > 100 || g.final < 60 && g.final != 0){
		    			swal('Grade should only be 60-100 in finals', {icon: 'warning'})
		    		}else{
		    			x = true
		    		}

		    		return x
		    	},

		    	close_modal(){
		    		this.show_modal = false
		    		this.reason2 = this.reason
		    		this.reason = ''
		    	},
		    	display_mod(action){
		    		this.action = action
		    		if(action == 'Dropped'){
		    			this.action_desc = 'Drop student'
		    		}else if(action == 'Incomplete'){
		    			this.action_desc = 'Set student\'s remark to Incomplete'
		    		}else if(action == 'remove'){
		    			//validate if can be remove
		    		}
		    		this.show_modal = true
		    	},
		    	submit_action(){
		    		const data = {
		    			classID: this.classID,
		    			studID: this.studID,
		    			action: this.action,
		    			reason: this.reason
		    		}

		    		this.$http.post('<?php echo base_url() ?>classes/drop_or_inc',data)
		            .then(response => {
		            	this.remarks = this.action
		            	if(this.action == 'Dropped'){
		            		swal('Student successfully dropped!', {icon: 'success'})
		            	}else if(this.action == 'Incomplete'){
		            		swal('Student\'s remark successfully set to Incomplete!', {icon: 'success'})
		            	}
		            	this.close_modal()
		            })
		    	},
		    	comply(){
		    		const data = {
		    			classID: this.classID,
		    			studID: this.studID
		    		}
		    		this.$http.post('<?php echo base_url() ?>classes/comply',data)
		            .then(response => {
		            	console.log(response.body)
		            	this.remarks = response.body
		            	swal('Successfully complied student!', {icon: 'success'})
		            	this.reason = ''
		            })
		    	},
		    	comply2(){
		    		const data = {
		    			classID: this.classID,
		    			studID: this.studID
		    		}
		    		this.$http.post('<?php echo base_url() ?>classes/comply2',data)
		            .then(response => {
		            	console.log(response.body)
		            	const c = response.body
		            	if(c.status == 'error'){
		            		swal('Please input the neccessary grades before complying!', {icon: 'warning'})
		            	}else{
		            		this.remarks = c.remarks
			            	swal('Successfully complied student!', {icon: 'success'})
			            	this.reason = ''
		            	}
		            })
		    	},
		    	is_safe_to_remove(){
		    		this.$http.get('<?php echo base_url() ?>classes/is_safe_to_remove/'+this.classID+'/'+this.studID)
		            .then(response => {
		            	const c = response.body
		            	if(c == 'yes'){
		            		swal({
							  title: "Are you sure?",
							  text: this.student_name+' will be remove in this class',
							  icon: "warning",
							  buttons: {
							  	cancel: true,
							  	confirm: {
							  		closeModal: false
							  	}
							  },
							  dangerMode: true
							})
							.then((willDelete) => {
							  if (willDelete) {
							    this.remove_stud_from_class()
							  }
							});
		            	}else{
		            		swal('Unable to remove. Student has a grade!', {icon: 'warning'})
		            	}
		            })
		    	},
		    	remove_stud_from_class(){
		    		this.$http.get('<?php echo base_url() ?>classes/remove_stud_from_class/'+this.classID+'/'+this.studID)
		            .then(response => {
		            	swal(this.student_name+' successfully removed in this class!', {icon: 'success'})
		            	.then((ok) => {
						  if(ok){
						  	window.location.href='<?php echo base_url() ?>class-selected/'+this.classID
						  }
						});
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