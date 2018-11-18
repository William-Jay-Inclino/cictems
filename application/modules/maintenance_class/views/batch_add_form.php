<style>
	.warn-msg{
		color: #fbac00;
		font-weight: bold;
	}
	.err{
		color: red;
	}
	.table{
		table-layout: fixed;
	}
	.table td {border: none !important;}
	.table tr:last-child{
	  border-bottom: solid 1px #ccc !important;
	} 
	.row-5{
		width: 5%;
	}
	.row-24{
		width: 24%
	}
	.row-17{
		width: 17%
	}
	.row-12{
		width: 12%
	}
	.row-10{
		width: 10%
	}
	.row-13{
		width: 13%
	}
	.row-19{
		width: 19%
	}
	.is-note{
    	color: #9c9fa6
    }
</style>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/flatpickr/flatpickr.min.css"> -->

<section id="app" class="section" v-cloak>
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Add Form</a></li>
		  </ul>
		</nav>
		<div class="box">
			<div class="columns">
				<div class="column">
					<label class="label">Term</label>
					<multiselect @input="changeOption" v-model="current_term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
				</div>
				<div class="column">
					<label class="label">Prospectus</label>
					<multiselect v-model="prospectus" track-by="prosID" label="prosCode" :options="prospectuses"></multiselect>
				</div>
				<div class="column">
					<label class="label">Year</label>
					<multiselect v-model="year" track-by="yearID" label="yearDesc" :options="years"></multiselect>
				</div>
			</div>
		</div>
		<div class="box" v-show="ready">
			<div class="columns">
				<div class="column">
					<label class="label">Section</label>
					<multiselect v-model="section" track-by="secID" label="secName" :options="sections" placeholder="Select Section" :allow-empty="false" @input="errSection = false"></multiselect>
					<p class="help has-text-danger" v-if="errSection"> This field is required </p>	
				</div>
				<div class="column">
					<label class="label">Reminder</label>
					<p class="is-note"> Checking in class conflict will be triggered only if all the fields of the selected row is filled up and is offered</p>
				</div>
			</div>
			<hr>
			<table class="table is-fullwidth is-centered">
				<thead>
					<tr>
						<th class="row-10" style="text-align: left">Code</th>
						<th class="row-17" style="text-align: left">Description</th>
						<th class="row-5" style="text-align: left">Units</th>
						<th colspan="2" class="row-24">Time</th>
						<th class="row-10">Day</th>
						<th class="row-13">Room</th>
						<th class="row-19">Instructor</th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th>In</th>
						<th>Out</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
			</table>
			<table v-for="record, i in classes" class="table is-fullwidth is-centered">
				<tbody>
					<tr :class="{err: record.error}">
						<td class="row-10" style="text-align: left">{{record.subCode}}</td>
						<td class="row-17" style="text-align: left">{{record.subDesc}}</td>
						<td>{{record.units}}</td>
						<td class="row-12"> <input @input="checkConflict(i)" v-model="record.timeIn" type="time" class="input" required :disabled="record.status2 == 1"> </td>
						<td class="row-12"> <input @input="checkConflict(i)" v-model="record.timeOut" type="time" class="input" required :disabled="record.status2 == 1"> </td>
						<td class="row-10">
							<multiselect v-bind="override" @input="checkConflict(i)" v-model="record.day" track-by="dayID" label="dayDesc" :options="days" placeholder="" :allow-empty="false" :disabled="record.status2 == 1"></multiselect>
						</td>
						<td class="row-13">
							<multiselect v-bind="override" @input="checkConflict(i)" v-model="record.room" track-by="roomID" label="roomName" :options="rooms" placeholder="" :allow-empty="false" :disabled="record.status2 == 1"></multiselect>
						</td>
						<td class="row-19">
							<multiselect v-bind="override" @input="checkConflict(i)" v-model="record.faculty" track-by="facID" label="faculty" :options="faculties" placeholder="" :allow-empty="false" :disabled="record.status2 == 1"></multiselect>
						</td>
						<td>
							<button class="button" @click="changeStatus2(record.status2, i)">
								<span v-if="record.status2 == 0">
									<i class="fa fa-check has-text-primary"></i>
								</span>
								<span v-else>
									<i class="fa fa-times has-text-danger"></i>
								</span>
							</button>
						</td>
					</tr>
					<tr v-if="record.msg != null">
						<td colspan="8" style="text-align: left" :class="{'warn-msg': record.msg != 0, 'has-text-success': record.msg == 0}">
							<span v-if="record.msg == 0">
								<b>No conflict <i class="fa fa-check"></i></b>
							</span>
							<span v-else>
								{{record.msg}}
							</span>
						</td>
					</tr>
				</tbody>
			</table>
			<button :class="{'button is-link is-pulled-right': true, 'is-loading': isLoading}" @click="submitForm" v-if="classes.length > 0">Submit</button>
			<br><br>
		</div>
	</div>

</section>






<script>

document.addEventListener('DOMContentLoaded', function() {
	Vue.component('multiselect', window.VueMultiselect.default) 
	// Vue.component('flat-pickr', VueFlatpickr);
	new Vue({
	    el: '#app',
	    data: {
	    	page:{
	    		title: 'Add Classes',
	    		list: '<?php echo base_url() ?>maintenance/class',
	    		success: '<?php echo base_url() ?>maintenance/class/success/'
	    	},
	    	isLoading: false,
	    	ready: false,
	    	current_term: {termID: '<?php echo $current_term->termID; ?>', term: '<?php echo $current_term->term; ?>'},
	    	prospectus: null,
	    	year: null,
	    	section: null,
	        terms: [],
	        prospectuses: [],
	        years: [],
	        classes: [],
	        days: [],
	        rooms: [],
	        faculties: [],
	        sections: [],
	    	errSection: false
	    },
	    created() {
	        this.populate()
	    },
	    watch: {
	    	prospectus(val){
	    		this.year = null
	    		this.years = []
	    		this.section = null
	    		this.sections = []
	    		if(val != null){
	    			this.fetch_YS(val.prosID)
	    		}
	    	},
	    	year(val){
	    		if(val == null){
	    			this.classes = []
	    			this.ready = false
	    		}else{
	    			this.ready = true
	    			this.fetchClasses()
	    		}
	    	}
	    },
	    computed: {
	    	override() {
			    return {
			     tabIndex: 0,
			    }
			  }
	    },
	    methods: {
	    	checkConflict(i){
	    		let msg = ''
	    		const c = this.classes[i] 
	    		console.log(c)
	    		if(!c.timeIn || !c.timeOut || c.day == null || c.room == null || c.faculty == null || c.status2 == 1){
	    			c.msg = null
	    			if(!c.timeIn || !c.timeOut || c.status2 == 1){
	    				this.checkConflict3(i, c)
	    			}
	    		}else{
	    			this.checkConflict3(i, c)
	    		}
	    	},
	    	checkConflict2(c){
	    		const data = {
	    			termID: this.current_term.termID,
					timeIn: c.timeIn,
					timeOut: c.timeOut,
					dayID: c.day.dayID,
					roomID: c.room.roomID,
					facID: c.faculty.facID
				}
				this.$http.post('<?php echo base_url() ?>maintenance_class/checkConflict', data)
	        	.then(response => {
	        		console.log(response.body)
	        		if(response.body == 'ok'){
	        			c.msg = 0
	        		}else{
	        			c.msg = response.body
	        		}
				})
	    	},
	    	checkConflict3(i, c){
	    		const classes = this.classes
	    		let has_conflict = false
	    		let per_week = null
	    		for(let [ii, cc] of classes.entries()){

    				if(cc.timeIn && cc.timeOut != null && cc.day != null && cc.room != null && cc.faculty != null && cc.status2 == 0){

    					per_week = this.time_per_week(cc.timeIn,cc.timeOut,cc.day.dayCount)

						//console.log(per_week+ ' '+this.unit_to_hr(cc.units))
						//console.log('week time: '+hh * ccc.day.dayCount + '..Units: '+ccc.units)
						if(per_week != this.unit_to_hr(cc.units)){
							//unit_conflict = true 
	    					cc.msg = "Time should be "+cc.units+" hours a week. Time given a week "+per_week

							// per_week = this.time_per_week(hh,mm,ss,ccc.day.dayCount)
						}else{
							for(let [iii, ccc] of classes.entries()){

		    					if(ccc.timeIn && ccc.timeOut && ccc.day != null && ccc.room != null && ccc.faculty != null && ccc.status2 == 0){
		    						if(ccc.day.dayID == cc.day.dayID && cc.timeOut > ccc.timeIn && ccc.timeOut > cc.timeIn && iii != ii){
										has_conflict = true
										break
			    					}
		    					}
		    				}
		    				if(has_conflict){
		    					if(ii == i){
		    						cc.msg = "Schedule has conflict in this section"
		    					}
		    				}else{
		    					if(ii == i){
		    						//cc.msg = 1
		    						if(c.timeIn && c.timeOut){
		    							this.checkConflict2(c)
		    						}else{
		    							c.msg = null
		    						}
		    						
		    					}else{
		    						this.checkConflict2(cc)
		    					}
		    				}
						}
    				}
    				has_conflict = false
    				per_week = null
    			}

    			// if(c.msg == 1){
    			// 	this.checkConflict2(c)
    			// }
	    	},
	    	unit_to_hr(u){
	    		if (u < 10) {u = "0"+u}
	    			return u + ':00:00'
	    	},
	    	time_per_week(timeIn,timeOut,dayCount){
	    		start = new Date('1970-01-01 '+timeIn)
				end = new Date('1970-01-01 '+timeOut)
				timeDiff = Math.abs(start - end)
				let h = Math.floor(timeDiff / 1000 / 60 / 60)
				timeDiff -= h * 1000 * 60 * 60;
				let m = Math.floor(timeDiff / 1000 / 60)
				timeDiff -= m * 1000 * 60;
				let s = Math.floor(timeDiff / 1000)

				let seconds = (h) * 60 * 60 + (+m) * 60 + (+s);
				let newSeconds= dayCount*seconds

				let date = new Date(newSeconds * 1000)
				let hh = date.getUTCHours()
				let mm = date.getUTCMinutes()
				let ss = date.getSeconds()

				if (hh < 10) {hh = "0"+hh}
				if (mm < 10) {mm = "0"+mm}
				if (ss < 10) {ss = "0"+ss}
				return hh+":"+mm+":"+ss
	    	},
	    	// checkConflict(i){
	    	// 	let msg = ''
	    	// 	const classes = this.classes 
	    	// 	const c = classes[i] 
	    	// 	has_conflict = false
	    	// 	if(!c.timeIn || !c.timeOut || c.day == null || c.room == null || c.faculty == null || c.status2 == 1){
	    	// 		c.msg = null
	    	// 	}else{
	    	// 		for(let [ii, cc] of classes.entries()){
	    	// 			if(cc.timeIn != null && cc.timeOut != null && cc.day != null && cc.room != null && cc.faculty != null && cc.status2 == 0){

	    	// 				if(cc.day.dayID == c.day.dayID && c.timeOut > cc.timeIn && cc.timeOut > c.timeIn && ii != i){
	    	// 					has_conflict = true
						// 		break
		    // 				}
	    	// 			}
		    // 		}
		    // 		if(has_conflict){
		    // 			c.msg = "There is a conflict in the selected day and time in this section"
		    // 		}else{
		    // 			for(let [ii, cc] of classes.entries()){
	    	// 				if(cc.timeIn != null && cc.timeOut != null && cc.day != null && cc.room != null && cc.faculty != null && cc.status2 == 0){
		    		// 			const data = {
				    // 				timeIn: cc.timeIn,
				    // 				timeOut: cc.timeOut,
				    // 				dayID: cc.day.dayID,
				    // 				roomID: cc.room.roomID,
				    // 				facID: cc.faculty.facID
				    // 			}
				    // 			this.$http.post('<?php echo base_url() ?>maintenance_class/checkConflict', data)
					   //      	.then(response => {
					   //      		if(response.body == 'ok'){
					   //      			cc.msg = 0
					   //      		}else{
					   //      			cc.msg = response.body
					   //      		}
								// })
		    // 				}
		    // 			}
		    // 		}
	    	// 	}
	    	// },
	    	// timePicker(i, val){
	    	// 	if(val == 'in'){
	    	// 		if(this.classes[i].timeOut != null){
	    	// 			const x = Number(this.classes[i].timeOut.slice(-1)) - 1 
	    	// 			this.classes[i].timeConfig.maxTime = this.classes[i].timeOut.slice(0, -1) + x
	    	// 		}
	    			
	    	// 	}else{
	    	// 		if(this.classes[i].timeIn != null){
	    	// 			const x = Number(this.classes[i].timeIn.slice(-1)) + 1
	    	// 			this.classes[i].timeConfig2.minTime = this.classes[i].timeIn.slice(0, -1) + x
	    	// 		}
	    	// 	}
	    	// 	this.checkConflict(i)
	    	// },
	    	changeOption(){
	    		if(this.prospectus == null || this.year == null){
	    			this.classes = []
	    			this.ready = false
	    		}else{
	    			this.ready = true
	    			this.fetchClasses()
	    		}
	    	},
	        populate() {
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/populate')
	        	.then(response => {
	        		const c = response.body
	        		this.terms = c.term
	        		this.prospectuses = c.prospectus
	        		this.days = c.days 
	        		this.rooms = c.rooms 
	        		this.faculties = c.faculties
	        		// this.sections = c.sections
				 })
	        },
	        fetch_YS(prosID){
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/fetch_YS/' + prosID)
	        	.then(response => {
	        		const c = response.body
	        		this.years = c.years
	        		this.sections = c.sections
				 })
	        },
	        fetchClasses(){
	        	this.$http.get('<?php echo base_url() ?>maintenance_class/fetchClasses/' + this.year.yearID +'/'+ this.prospectus.prosID +'/'+this.current_term.termID)
	        	.then(response => {
	        		this.prepareForm(response.body)
				 })
	        },
	        prepareForm(classes){
	        	const arr = []
	        	for(c of classes){
	        		arr.push({
	        			subID: c.subID,
	        			subCode: c.subCode,
	        			subDesc: c.subDesc,
	        			units: c.units,
	        			day: null,
	        			timeIn: '',
	        			timeOut: '',
	        			room: null,
	        			faculty: null,
	        			status2: 0,
	        			error: false,
	        			msg: null,
	        	// 		timeConfig: {
	        	// 			enableTime: true,
						    // noCalendar: true,
						    // dateFormat: "H:i",
    						// maxTime: null
	        	// 		},
	        	// 		timeConfig2: {
	        	// 			enableTime: true,
						    // noCalendar: true,
						    // dateFormat: "H:i",
						    // minTime: null
	        	// 		}
	        		})
	        	}
	        	this.classes = arr
	        },
	        changeStatus2(val, i){
	        	if(val == 0){
	        		this.classes[i].error = false
	        		this.classes[i].status2 = 1
	        		this.classes[i].msg = null
	        	}else{
	        		this.classes[i].status2 = 0
	        	}
	        	this.checkConflict(i)
	        },
	        submitForm(){
	        	const c = this.classes 
	        	if(!c.find(j => j.status2 == 0)){
	        		swal('Unable to submit!','No classes have been offered', {
				      icon: 'error',
				    })
	        	}else{
	        		if(this.checkForm(c)){
	        			//console.log(c.findIndex(g => g.msg != 0 && g.status2 == 0))
		        		if(c.findIndex(g => g.msg != 0 && g.status2 == 0) != -1){
		        			swal({
							  title: "Please confirm",
							  text: "Form has error/s. Submit anyway?",
							  icon: "warning",
							  buttons: ['No','Yes']
							})
							.then((yes) => {
							  	if (yes) {
								    this.saveForm(c)
							  	}
							})
		        		}else{
		        			this.saveForm(c)
		        		}
		        	}else{
		        		swal('All fields are required!','Please review the form', {
					      icon: 'error',
					    })
					    this.isLoading = false
		        	}
	        	}

	        },
	        saveForm(c){
	        	this.isLoading = true
	        	this.$http.post('<?php echo base_url() ?>maintenance_class/create_batch', {termID: this.current_term.termID, secID: this.section.secID, classes: c})
		        .then(response => {
	        		
				})
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
	        		if((!c.timeIn || !c.timeOut || c.room == null || c.day == null || c.faculty == null) && c.status2 == 0){
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
<!-- <script src="<?php echo base_url(); ?>assets/vendor/vue/flatpickr/flatpickr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/flatpickr/vue-flatpickr-component@7.js"></script> <--></-->