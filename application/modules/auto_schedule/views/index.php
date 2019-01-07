<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma_switch/bulma-switch.min.css">

<style>
	.noBorder{
		border: none;
	}
</style>

<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
	</div>
	<br><br>
	<div class="container" style="max-width: 800px;">
		<div class="box">
			<table class="table is-fullwidth">
				<tr>
					<th width="20%" style="border: none; padding: 12px">Prospectus</th>
					<td style="border: none; padding: 12px" colspan="2">
						<multiselect :disabled="isDisabled" @input="displaySections" v-model="prospectus" track-by="prosID" label="prosCode" :options="prospectuses"></multiselect>
					</td>
				</tr>
				<tr>
					<th style="border: none; padding: 12px" width="20%">Select Sections</th>
					<td style="border: none; padding: 12px" colspan="2">
						<multiselect :disabled="isDisabled" :multiple="true" v-model="sections_tba" track-by="secID" label="secName" :options="sections2"></multiselect>
					</td>
				</tr>
			</table>
			<hr>
			<button @click="addSections" class="button is-primary is-pulled-right" :disabled="sections_tba.length == 0 || isDisabled">Add Sections</button>
			<br><br>
		</div>
		<div class="box">
			<table class="table is-fullwidth">
				<tr>
					<th style="border: none; padding: 12px" width="20%">Term</th>
					<td style="border: none; padding: 12px" colspan="2">
						<multiselect :disabled="isDisabled" v-model="form.term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
					</td>
				</tr>
				<tr>
					<th style="border: none; padding: 12px" width="20%">Section</th>
					<td style="border: none; padding: 12px" colspan="2">
						<multiselect :disabled="isDisabled" :multiple="true" v-model="form.section" track-by="secID" label="secLabel" :options="[]"></multiselect>
					</td>
				</tr>
				<tr>
					<th style="border: none; padding: 12px">Day and Time</th>
					<td style="border: none; padding: 12px">
						<input :disabled="isDisabled" id="switchSection" type="checkbox" name="switchNormal" class="switch is-rounded" :checked="form.is_dt_auto == 'yes'" @change="toggle_switches('dt')">
						<label for="switchSection"></label>
					</td>
				</tr>
				<tr v-if="form.is_dt_auto == 'yes'">
					<th style="border: none; padding: 12px">Day</th>
					<td style="border: none; padding: 12px" colspan="2">
						<multiselect :disabled="isDisabled" :multiple="true" v-model="form.day" track-by="dayID" label="dayDesc" :options="days"></multiselect>
					</td>
				</tr>
				<tr v-if="form.is_dt_auto == 'yes'">
					<th style="border: none; padding: 12px">Time range</th>
					<td style="border: none; padding: 12px">
						<label class="label">Min</label>
						<input :disabled="isDisabled" type="time" class="input" v-model="form.min_time">
					</td>
					<td style="border: none; padding: 12px">
						<label class="label">Max</label>
						<input :disabled="isDisabled" type="time" class="input" v-model="form.max_time">
					</td>
				</tr>
				<tr v-if="form.is_dt_auto == 'yes'">
					<th style="border: none; padding: 12px">Lunch Break</th>
					<td style="border: none; padding: 12px">
						<label class="label">Min</label>
						<input :disabled="isDisabled" type="time" class="input" v-model="form.break_min_time">
					</td>
					<td style="border: none; padding: 12px">
						<label class="label">Max</label>
						<input :disabled="isDisabled" type="time" class="input" v-model="form.break_max_time">
					</td>
				</tr>
				<tr>
					<th style="border: none; padding: 12px">Room</th>
					<td style="border: none; padding: 12px">
						<input :disabled="isDisabled" id="switchRoom" type="checkbox" name="switchNormal" class="switch is-rounded" :checked="form.is_room_auto == 'yes'" @change="toggle_switches('r')">
						<label for="switchRoom"></label>
					</td>
				</tr>
				<tr>
					<th style="border: none; padding: 12px">Faculty</th>
					<td style="border: none; padding: 12px">
						<input :disabled="isDisabled" id="switchFaculty" type="checkbox" name="switchNormal" class="switch is-rounded" :checked="form.is_faculty_auto == 'yes'" @change="toggle_switches('f')">
						<label for="switchFaculty"></label>
					</td>
				</tr>
			</table>
			<hr>
			<button @click="createSchedule" :class="{'button is-link is-pulled-right': true, 'is-loading': isLoading}">Create Schedule</button>
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
	    	isDisabled: false,
	    	isLoading: false,
	    	current_termID: '<?php echo $current_term->termID ?>',
	    	page_title: 'Auto-Schedule',
	    	terms: [],
	    	prospectus: null,
	    	prospectuses: [],
	    	section2: [],
	    	sections_tba: [],
	    	sections: [],
	    	days: [],
	    	form: {
	    		term: null,
	    		section: [],
	    		is_dt_auto: 'yes',
	    		is_room_auto: 'yes',
	    		is_faculty_auto: 'yes',
	    		day: null,
	    		min_time: '07:30',
		    	max_time: '19:30',
		    	break_min_time: '12:00',
		    	break_max_time: '13:00',
	    	}
	       
	    },
	    created() {
	        this.populate()
	    },
	    watch: {

	    },
	    computed: {
	    	sections2(){
	    		if(this.prospectus){
	    			return this.sections.filter(sec => 
	    				(this.prospectus.courseID == sec.courseID) && (!(this.form.section.find(s => s.secID == sec.secID && s.prosID == this.prospectus.prosID)))
	    			)
	    		}else{
	    			return []
	    		}
	    		
	    	}
	    },
	    methods: {
	    	addSections(){
	    		for(let sec of this.sections_tba){
	    			this.form.section.push({
	    				secID: sec.secID,
	    				prosID: this.prospectus.prosID,
	    				yearID: sec.yearID,
	    				secLabel: this.prospectus.prosCode + ' (' + sec.secName+')'	
	    			})
	    		}
	    		
	    		this.sections_tba = []
	    		this.prospectus = null
	    	},
	    	populate(){
	    		this.$http.get('<?php echo base_url() ?>auto_schedule/populate/' + this.current_termID)
	    		.then(res => {
	    			this.prospectuses = res.body.prospectuses
	    			this.sections = res.body.sections
	    			this.terms = res.body.terms
	    			this.days = res.body.days
	    			this.form.term = this.terms.find(t => t.termID == this.current_termID)

	    		}, e => {
	    			console.log(e.body)

	    		})
	    	},
	    	displaySections(){
	    		this.sections_tba = this.sections2
	    	},
	    	toggle_switches(val){
	    		if(val == 'dt'){
	    			this.form.is_dt_auto = (this.form.is_dt_auto == 'yes') ? 'no' : 'yes'
	    		}else if(val == 'r'){
	    			this.form.is_room_auto = (this.form.is_room_auto == 'yes') ? 'no' : 'yes'
	    		}else{
	    			this.form.is_faculty_auto = (this.form.is_faculty_auto == 'yes') ? 'no' : 'yes'
	    		}

	    	},
	    	createSchedule(){
	    		if(this.form.section.length == 0){
	    			swal('Error', 'Unable to create schedule. Empty sections! ', 'error')
	    		}else if(this.form.is_dt_auto == 'yes' && !this.form.day){
	    			swal('Error', 'Unable to create schedule. Empty days! ', 'error')
	    		}else{
	    			this.isLoading = true
	    			this.isDisabled = true
	    			this.$http.post('<?php echo base_url() ?>auto_schedule/createSchedule', this.form)
		    		.then(res => {
		    			this.isLoading = false
		    			this.isDisabled = false
		    			swal('Success', "Scedule successfully created!", 'success')
		    			this.resetForm()
		    		}, e => {
		    			console.log(e.body)
		    			this.createSchedule()
		    		})	
	    		}
	    	},
	    	resetForm(){
	    		this.form = {
		    		term: null,
		    		section: [],
		    		is_dt_auto: 'yes',
		    		is_room_auto: 'yes',
		    		is_faculty_auto: 'yes',
		    		day: null,
		    		min_time: '07:30',
			    	max_time: '19:30',
			    	break_min_time: '12:00',
			    	break_max_time: '13:00',
		    	}
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