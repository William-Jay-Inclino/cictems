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
    .my-btn{
    	width: 70px
    }
</style>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">



<section id="app" class="section" v-cloak>
	<div class="container">
		
		<div class="columns">
			<div class="column">
				<label class="label">Term</label>
				<multiselect @input="changeTerm" v-model="current_term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
			</div>
			<div class="column">
				<label class="label">Search section</label>
				<multiselect v-model="searchSection" track-by="secID" label="secName" :options="added_sections"></multiselect>
			</div>
		</div>

		
		<br>
		<div class="tabs is-boxed">
		 	<ul>
		 		<li :class="{'is-active': ready2}">
		      		<a @click="createForm">Create schedule</a>
		    	</li>
		    	<li :class="{'is-active': current_sec == sec.secID}" v-for="sec of added_sections">
		    		<a @click="updateForm(sec.secID)"> {{sec.secName}} </a>
		    	</li>
		  	</ul>
		</div>
		
		<div v-show="ready2">
			<div class="box">
				<div class="columns">
					<div class="column">
						<label class="label">Prospectus</label>
						<multiselect v-model="prospectus" track-by="prosID" label="prosCode" :options="prospectuses" :allow-empty="false" @input="fetchYear"></multiselect>
					</div>
					<div class="column">
						<label class="label">Year</label>
						<multiselect v-model="year" track-by="yearID" label="yearDesc" :options="years" :allow-empty="false" @input="fetchYear"></multiselect>
					</div>
					<div class="column">
						<label class="label">Section</label>
						<multiselect v-model="section" track-by="secID" label="secName" :options="sections2" :allow-empty="false" @input="fetchYear"></multiselect>
					</div>
				</div>
			</div>
			
			<div class="box" v-show="ready">
				<div class="columns">
					<div class="column">
						<multiselect v-if="add_subject" v-model="subject" label="subject" track-by="subID" placeholder="Enter subject code / description" :options="subjects" :loading="subloader" :internal-search="false" @search-change="searchSubjects">
                        </multiselect>
					</div>
					<div class="column">
						<div class="is-pulled-right">
							<button v-if="!add_subject" class="button is-primary" @click="add_subject = true">Add subject</button>
							<div v-if="add_subject">
								<button class="button my-btn" @click="resetSubject">Cancel</button>	
								<button class="button is-link my-btn" @click="insertSubject">Add</button>	
							</div>
						</div>
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
				<div class="is-pulled-right">
					<button :class="{'button is-link': true, 'is-loading': isLoading}" @click="submitForm" v-if="classes.length > 0">Create schedule</button>	
				</div>
				
				<br><br>
			</div>
		</div>
		
		<div v-show="loader" class="loader"></div>


		<div v-if="ready3">
			<div class="box">
				<div class="columns">
					<div class="column">
						<label class="label">Prospectus</label>
						<p style="font-size: 14px"> {{prospectus2.prosCode}} </p>
					</div>
					<div class="column">
						<label class="label">Year</label>
						<p style="font-size: 14px"> {{year2}} </p>
					</div>
					<div class="column">
						<label class="label">Section</label>
						<multiselect v-model="section2" track-by="secID" label="secName" :options="sections4" :allow-empty="false"></multiselect>
					</div>
				</div>
			</div>

			<div class="box">
				<div class="columns">
					<div class="column">

					</div>
					<div class="column">
						<div class="is-pulled-right">
							<button class="button is-primary">Add subject</button>
						</div>
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
				<table v-for="record, i in classes2" class="table is-fullwidth is-centered">
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
								<button class="button is-danger" @click="deleteClass(i)">
									<i class="fa fa-trash"></i>
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
				<button :class="{'button is-link is-pulled-right': true, 'is-loading': false}">Update schedule</button>
				<br><br>
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
	    	subject: null,
	    	searchSection: null,
	    	prospectus: null,
	    	year: null,
	    	prospectus2: null,
	    	year2: null,
	    	section: null,
	    	section2: null,
	    	add_subject: false,
	    	isLoading: false,
	    	ready: false,
	    	ready2: true,
	    	ready3: false,
	    	loader: false,
	    	subloader: false,
	    	current_sec: null,
	    	current_term: {termID: '<?php echo $current_term->termID; ?>', term: '<?php echo $current_term->term; ?>'},
	    	subjects: [],
	    	terms: [],
	    	prospectuses: [],
	        years: [],
	        classes: [],
	        classes2: [],
	        days: [],
	        rooms: [],
	        faculties: [],
	        sections: [],
	        sections3: [],
	        added_sections: [],
	        update_sec: null,
	    },
	    created() {
	    	this.populate()
	    },
	    watch: {
	    	prospectus(){
	    		this.year = null
	    	},
	    	year(val){
	    		this.section = null 
	    		if(val == null){
	    			this.sections = []
	    		}else{
	    			this.fetchClasses()
	    		}
	    	},
	    	section(val){
	    		if(val == null){
	    			this.ready = false 
	    		}else{
	    			
	    			this.ready = true
	    		}
	    	},
	    	searchSection(val){
	    		if(val == null){
	    			this.createForm()
	    		}else{
	    			this.updateForm(val.secID)
	    		}
	    	}
	    },
	    computed: {
	    	override() {
			    return {
			     tabIndex: 0,
			    }
			},
			sections2(){
				const sections = this.sections 
				const added_sections = this.added_sections 
				let arr = []
				for(s of sections){
					if(!added_sections.find(j => j.secID == s.secID)){
						arr.push(s)
					}
				}
				return arr
			},
			sections4(){
				const sections = this.sections3
				const added_sections = this.added_sections 
				const update_sec = this.update_sec.secID
				let arr = []
				for(s of sections){
					if(!added_sections.find(j => j.secID == s.secID && j.secID != update_sec)){
						arr.push(s)
					}
				}
				return arr
			}
	    },
	    methods: {
	    	deleteClass(i){
	    		const classID = this.classes2[i].classID
	    		this.$http.get('<?php echo base_url() ?>schedule/is_safe_delete/'+classID)
	            .then(response => {
	               const c = response.body
	               if(c == 1){
	        			swal({
						  title: "Are you sure?",
						  text: "Once deleted, you will not be able to recover this record!",
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
						    this.deleteRec(classID)
						  }
						})
	        		}else{
	        			swal("Unable to delete", "Class has record in other modules!", "error")
	        		}
	            })
	    	},
	    	deleteRec(id){
	    		this.$http.get('<?php echo base_url() ?>schedule/delete/'+id)
	        	.then(response => {
	        		swal('Poof! record has been deleted!', {
				      icon: 'success',
				    }).then((x) => {
					  this.updateForm(this.current_sec)
					})
				 })
	    	},
	    	resetSubject(){
	    		this.subject = null 
				this.add_subject = false
	    	},
	    	searchSubjects(value){
	    		if(value.trim() != ''){
		            this.subloader = true
		            value = value.replace(/\s/g, "_")
		            this.$http.get('<?php echo base_url() ?>schedule/search_subject/'+value+'/'+this.prospectus.prosID)
		            .then(response => {
		               this.subloader = false
		               this.subjects = response.body
		            })
		         }else{
		            this.subjects = []
		         }
	    	},
	    	insertSubject(){
	    		const s = this.subject 
	    		const c = this.classes
	    		const arr = []
	    		if(s == null){
	    			swal('Please enter subject!', {
				      icon: 'warning',
				    })
	    		}else if(c.find(j => j.subID == s.subID)){
	    			swal('Unable to add!','Subject already exist in form', {
				      icon: 'warning',
				    })
	    		}else{
	    			c.push({
	        			subID: s.subID,
	        			subCode: s.subCode,
	        			subDesc: s.subDesc,
	        			units: s.units,
	        			day: null,
	        			timeIn: '',
	        			timeOut: '',
	        			room: null,
	        			faculty: null,
	        			status2: 0,
	        			error: false,
	        			msg: null,
	        		})
	        		swal('Subject successfully added to form!', {
				      icon: 'success',
				    })
				    this.resetSubject()
	    		}
	    	},
	    	updateForm(secID){
	    		this.current_sec = secID
	    		this.ready2 = false
	    		this.loader = true
	    	
	    		this.$http.get('<?php echo base_url() ?>schedule/get_sec_info/' + secID)
	        	.then(response => {
	        		const c = response.body
	        		console.log(c)
	        		this.loader = false
	        		this.ready3 = true 
	        		this.prospectus2 = c.prospectus 
	        		this.year2 = c.year
	        		this.section2 = c.section
	        		this.sections3 = c.sections
	        		this.update_sec = c.section
	        		this.prepareForm2(c.classes)
				})
	    	},
	    	createForm(){
	    		this.ready2 = true
	    		this.ready3 = false 
	    		this.current_sec = null
	    	},
	    	checkConflict(i){
	    		let msg = ''
	    		const c = this.classes[i] 
	    		if(!c.timeIn || !c.timeOut || c.day == null || c.room == null || c.faculty == null || c.status2 == 1){
	    			c.msg = null
	    			if(!c.timeIn || !c.timeOut && c.status2 == 0){
	    				this.checkConflict3(i, c)
	    			}
	    		}else{
	    			this.checkConflict3(i, c)
	    		}
	    	},
	    	checkConflict2(c, i){
	    		const data = {
	    			termID: this.current_term.termID,
					timeIn: c.timeIn,
					timeOut: c.timeOut,
					dayID: c.day.dayID,
					roomID: c.room.roomID,
					facID: c.faculty.facID
				}
				this.$http.post('<?php echo base_url() ?>schedule/checkConflict', data)
	        	.then(response => {
	        		if(response.body == 'ok'){
	        			c.msg = 0
	        		}else{
	        			c.msg = response.body
	        		}
				}, response => {
					this.checkConflict(i)
				})

	    	},
	    	checkConflict3(i, c){
	    		const classes = this.classes
	    		let has_conflict = false
	    		let per_week = null
	    		for(let [ii, cc] of classes.entries()){

    				if(cc.timeIn && cc.timeOut != null && cc.day != null && cc.room != null && cc.faculty != null && cc.status2 == 0){

    					per_week = this.time_per_week(cc.timeIn,cc.timeOut,cc.day.dayCount)

						if(per_week != this.unit_to_hr(cc.units)){
	    					cc.msg = "Time should be "+cc.units+" hours a week. Time given a week "+per_week
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
		    						if(c.timeIn && c.timeOut){
		    							this.checkConflict2(c,i)
		    						}else{
		    							c.msg = null
		    						}
		    						
		    					}else{
		    						this.checkConflict2(cc,i)
		    					}
		    				}
						}
    				}
    				has_conflict = false
    				per_week = null
    			}
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
	    	fetchYear(){
	        	this.$http.get('<?php echo base_url() ?>schedule/fetchYear/' + this.prospectus.prosID)
	        	.then(response => {
	        		this.years = response.body
				 })
	        },
	        changeTerm(){
	    		this.prospectus = null
	    		this.searchSection = null
	    		this.createForm()
	    		this.$http.get('<?php echo base_url() ?>schedule/get_added_sections/' + this.current_term.termID)
	        	.then(response => {
	        		const c = response.body
	        		this.added_sections = response.body
				 })
	    	},
	    	populate() {
	        	this.$http.get('<?php echo base_url() ?>schedule/populate')
	        	.then(response => {
	        		const c = response.body
	        		this.terms = c.term
	        		this.prospectuses = c.prospectus
	        		this.days = c.days 
	        		this.rooms = c.rooms 
	        		this.faculties = c.faculties
	        		this.added_sections = c.added_sections
				 })
	        },
	        fetchClasses(){
	        	this.$http.get('<?php echo base_url() ?>schedule/fetchClasses/' + this.year.yearID +'/'+ this.prospectus.prosID +'/'+this.current_term.termID)
	        	.then(response => {
	        		const c = response.body
	        		console.log(c)
	        		this.sections = c.sections
	        		this.prepareForm(c.classes)
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
	        		})
	        	}
	        	this.classes = arr
	        },
	        prepareForm2(classes){
	        	const arr = []
	        	for(c of classes){
	        		arr.push({
	        			classID: c.classID,
	        			subID: c.subID,
	        			subCode: c.subCode,
	        			subDesc: c.subDesc,
	        			units: c.units,
	        			day: {dayID: c.dayID, dayDesc: c.dayDesc},
	        			timeIn: c.timeIn,
	        			timeOut: c.timeOut,
	        			room: {roomID: c.roomID, roomName: c.roomName},
	        			faculty: {facID: c.facID, faculty: c.faculty},
	        			error: false,
	        			msg: null,
	        		})
	        	}
	        	this.classes2 = arr
	        },
	        submitForm(){
	        	const c = this.classes 
	        	if(!c.find(j => j.status2 == 0)){
	        		swal('Unable to submit!','No classes have been offered', {
				      icon: 'error',
				    })
	        	}else if(!this.checkForm(c)){
	        		swal('All fields are required!','Please review the form', {
				      icon: 'warning',
				    })
	        	}else if(c.findIndex(g => g.msg != 0 && g.status2 == 0) != -1){
	        		swal('Form has errors!','Please review the form', {
				      icon: 'error',
				    })
	        	}else{
	        		this.isLoading = true
	        		this.$http.post('<?php echo base_url() ?>schedule/create', {termID: this.current_term.termID, secID: this.section.secID, classes: c})
			        .then(response => {
			        	console.log(response.body)
			        	swal('Schedule successfully created!', {
					      icon: 'success'
					    })
		        		this.added_sections = response.body
		        		this.isLoading = false
		        		this.year = null
		        		this.section = null
		        		this.ready = false
					})
	        	}
	        	this.isLoading = false
	        },
	        checkForm(classes){
	        	let ok = true
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