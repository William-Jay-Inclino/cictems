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
  	
	.loading2 {
	    position: relative;
	    color: rgba(0, 0, 0, .3);
	    font-size: 14px;
	    font-weight: bold;
	}
	.loading2:before {
	    content: attr(data-text);
	    position: absolute;
	    overflow: hidden;
	    max-width: 7em;
	    white-space: nowrap;
	    color: #00d1b2;
	    animation: loading 1.5s infinite;
	}
	@keyframes loading {
	    0% {
	        max-width: 0;
	    }
	}
</style>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
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
				<div v-if="!add_subject" class="is-pulled-right">
					<button class="button is-primary" @click="add_subject = true">Add subject</button>
				</div>
				<div v-if="add_subject">
					<form @submit.prevent="insertSubject">
						<div class="columns">
							<div class="column">
								<multiselect v-if="add_subject" v-model="subject" label="subject" track-by="subID" placeholder="Enter subject code / description" :options="subjects" :loading="subloader" :internal-search="false" @search-change="searchSubjects">
		                        </multiselect>
							</div>
							<div class="column">
								<div class="is-pulled-right">
									<div v-if="add_subject">
										<button type="button" class="button my-btn" @click="resetSubject">Cancel</button>	
										<button type="submit" class="button is-link my-btn">Add</button>	
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<br><br>
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
							<td class="row-10" style="text-align: left">
								{{record.subCode}} <span v-if="record.type == 'lab'"><b>(lab)</b></span>
							</td>
							<td class="row-17" style="text-align: left">{{record.subDesc}}</td>
							<td>{{record.units}}</td>
							<td class="row-12"> <input @input="checkConflict(i)" v-model="record.timeIn" type="time" class="input" required :disabled="record.status2 == 1"> </td>
							<td class="row-12"> <input @input="checkConflict(i)" v-model="record.timeOut" type="time" class="input" required :disabled="record.status2 == 1"> </td>
							<td class="row-10">
								<multiselect :show-labels="false" @input="checkConflict(i)" v-model="record.day" track-by="dayID" label="dayDesc" :options="days" placeholder="" :allow-empty="false" :disabled="record.status2 == 1"></multiselect>
							</td>
							<td class="row-13">
								<multiselect :show-labels="false" @input="checkConflict(i)" v-model="record.room" track-by="roomID" label="roomName" :options="rooms" placeholder="" :allow-empty="false" :disabled="record.status2 == 1"></multiselect>
							</td>
							<td class="row-19">
								<multiselect :show-labels="false" @input="checkConflict(i)" v-model="record.faculty" track-by="facID" label="faculty" :options="faculties" placeholder="" :allow-empty="false" :disabled="record.status2 == 1"></multiselect>
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
							<td colspan="8" style="text-align: left">
								<div v-show="record.loading" class="is-pulled-left">
									<div class="loading2" data-text="checking...">checking...</div>
								</div>
								<div v-show="!record.loading">
									<span v-if="record.msg == 0" class="has-text-success">
										<b>No conflict <i class="fa fa-check"></i></b>
									</span>
									<span v-else class="warn-msg">
										{{record.msg}}
									</span>
								</div>
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
						<p style="font-size: 14px"> {{year2.yearID}} </p>
					</div>
					<div class="column">
						<label class="label">Section</label>
						<multiselect @input="changeSection" v-model="section2" track-by="secID" label="secName" :options="sections4" :allow-empty="false"></multiselect>
					</div>
				</div>
			</div>

			<div class="box">
				<div v-if="!add_subject2" class="is-pulled-right">
					<button class="button is-primary" @click="add_subject2 = true">Add subject</button>
				</div>
				<div v-if="add_subject2">
					<form v-on:submit.prevent="insertSubject">
						<div class="columns">
	                    	<div class="column">
	                    		<multiselect v-if="add_subject2" @input="is_conflict" v-model="subject" label="subject" track-by="subID" placeholder="Enter subject code / description" :options="subjects" :loading="subloader" :internal-search="false" @search-change="searchSubjects">
	                   			</multiselect>
	                    	</div>
	                    	<div class="column">
	                    		<div class="is-pulled-right">
	                    			<button type="button" class="button my-btn" @click="resetSubject">Cancel</button>	
									<button type="submit" class="button is-link my-btn" :disabled="is_disable_add">Add</button>
	                    		</div>
	                    	</div>
	                    </div>
	                    <table class="table is-fullwidth is-centered">
	                    	<tr>
								<th>Units</th>
								<th colspan="2">Time</th>
								<th>Day</th>
								<th>Room</th>
								<th>Instructor</th>
							</tr>
							<tr>
								<th></th>
								<th>In</th>
								<th>Out</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<td> {{class_to_be_added_units}} </td>
								<td> <input @input="is_conflict()" v-model="class_to_be_added.timeIn" type="time" class="input" required> </td>
								<td> <input @input="is_conflict()" v-model="class_to_be_added.timeOut" type="time" class="input" required> </td>
								<td>
									<multiselect :show-labels="false" @input="is_conflict()" v-model="class_to_be_added.day" track-by="dayID" label="dayDesc" :options="days" placeholder="" :allow-empty="false"></multiselect>
								</td>
								<td>
									<multiselect :show-labels="false" @input="is_conflict()" v-model="class_to_be_added.room" track-by="roomID" label="roomName" :options="rooms" placeholder="" :allow-empty="false"></multiselect>
								</td>
								<td>
									<multiselect :show-labels="false" @input="is_conflict()" v-model="class_to_be_added.faculty" track-by="facID" label="faculty" :options="faculties" placeholder="" :allow-empty="false"></multiselect>
								</td>
							</tr>
	                    </table>
	                    <div v-if="class_to_be_added.loading">
							<div class="loading2" data-text="checking...">checking...</div>
						</div>
						<div v-else="class_to_be_added.loading">
							<span v-if="class_to_be_added.msg == 0" class="has-text-success">
								<b>No conflict <i class="fa fa-check"></i></b>
							</span>
							<span v-else class="warn-msg">
								{{class_to_be_added.msg}}
							</span>
						</div>
					</form>
				</div>
				<br><br>
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
							<td class="row-10" style="text-align: left">
								{{record.subCode}} <span v-if="record.type == 'lab'"><b>(lab)</b></span>
							</td>
							<td class="row-17" style="text-align: left">{{record.subDesc}}</td>
							<td>{{record.units}}</td>
							<td class="row-12"> <input @input="checkConflict(i)" v-model="record.timeIn" type="time" class="input" required> </td>
							<td class="row-12"> <input @input="checkConflict(i)" v-model="record.timeOut" type="time" class="input" required> </td>
							<td class="row-10">
								<multiselect  :show-labels="false" @input="checkConflict(i)" v-model="record.day" track-by="dayID" label="dayDesc" :options="days" placeholder="" :allow-empty="false"></multiselect>
							</td>
							<td class="row-13">
								<multiselect  :show-labels="false" @input="checkConflict(i)" v-model="record.room" track-by="roomID" label="roomName" :options="rooms" placeholder="" :allow-empty="false"></multiselect>
							</td>
							<td class="row-19">
								<multiselect :show-labels="false" @input="checkConflict(i)" v-model="record.faculty" track-by="facID" label="faculty" :options="faculties" placeholder="" :allow-empty="false"></multiselect>
							</td>
							<td>
								<button class="button is-danger" @click="deleteClass(i)">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
						<tr v-if="record.msg != null">
							<td colspan="8" style="text-align: left">
								<div v-show="record.loading" class="is-pulled-left">
									<div class="loading2" data-text="checking...">checking...</div>
								</div>
								<div v-show="!record.loading">
									<span v-if="record.msg == 1" class="has-text-success">
										<b>Updated <i class="fa fa-check"></i></b>
									</span>
									<span v-else class="warn-msg">
										{{record.msg}}
									</span>
								</div>
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
	    	page_title: 'Schedule',
	    	subject: null,
	    	searchSection: null,
	    	prospectus: null,
	    	year: null,
	    	prospectus2: null,
	    	year2: null,
	    	section: null,
	    	section2: null,
	    	add_subject: false,
	    	add_subject2: false,
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
	        class_to_be_added: {
	        	loading: false,
	        	classID: 0,
	        	subID: null,
    			subCode: '',
    			subDesc: '',
    			units: null,
    			day: null,
    			timeIn: '',
    			timeOut: '',
    			room: null,
    			faculty: null,
    			status2: 0,
    			error: false,
    			msg: null,
	        }
	    },
	    created() {
	    	this.populate()
	    },
	    watch: {
	    	classes2(val){
	    		if(val.length == 0){
	    			this.createForm()
	    		}
	    	},
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
			},
			class_to_be_added_units(){
				let x = ''
				const s = this.subject
				if(s != null){
					x = s.units
				}
				return x
			},
			is_disable_add(){
				const c = this.class_to_be_added
	    		const s = this.subject 
	    		let x = true  
	    		if(s != null && c.msg == 0){
	    			x = false
	    		}
	    		return x
			},
			class_to_be_added2(){
				const c = this.class_to_be_added 
				return {
					termID: this.current_term.termID,
					subID: c.subID,
					roomID: c.room.roomID,
					facID: c.faculty.facID,
					secID: this.current_sec,
					dayID: c.day.dayID,
					classCode: c.subCode,
					timeIn: c.timeIn,
					timeOut: c.timeOut
				}
			}
	    },
	    methods: {
	    	changeSection(){
	    		const data = {
	    			yearID: this.year2.yearID,
	    			prosID: this.prospectus2.prosID,
	    			termID: this.current_term.termID,
	    			secID: this.current_sec,
	    			newSecID: this.section2.secID
	    		}
	    		this.$http.post('<?php echo base_url() ?>schedule/changeSection', data)
	        	.then(response => {
	        		const c = response.body
	        		swal('Section successfully changed!', {icon: 'success'})
	        		this.added_sections = c.added_sections
	        		this.section2 = c.section
	        		this.sections3 = c.sections
	        		this.update_sec = c.section
	        		this.current_sec = this.section2.secID
				}, response => {
					this.changeSection()
				})
	    	},
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
						    this.deleteRec(classID, i)
						  }
						})
	        		}else{
	        			swal("Unable to delete", "Class has record in other modules!", "error")
	        		}
	            })
	    	},
	    	deleteRec(id, i){
	    		this.$http.get('<?php echo base_url() ?>schedule/delete/'+id)
	        	.then(response => {
	        		swal('Poof! record has been deleted!', {
				      icon: 'success',
				    }).then((x) => {
				    	this.classes2.splice(i, 1)
				    	const as = this.added_sections
				    	//delete section in the tabs
				    	if(this.classes2.length == 0){
				    		let ctr = 0
					    	for(let k of as){
					    		if(k.secID == this.current_sec){
					    			as.splice(ctr, 1)
					    			break
					    		}
					    		++ctr
					    	}	
				    	}
				    	
					  // this.updateForm(this.current_sec)
					})
				 })
	    	},
	    	resetSubject(){
	    		this.subject = null 
	    		if(this.current_sec == null){
					this.add_subject = false
	    		}else{
	    			this.add_subject2 = false
	    		}
	    	},
	    	searchSubjects(value){
	    		if(value.trim() != ''){
		            this.subloader = true
		            value = value.replace(/\s/g, "_")
		            let prosID = null
		            if(this.current_sec == null){
		            	prosID = this.prospectus.prosID
		            }else{
		            	prosID = this.prospectus2.prosID
		            }
		            this.$http.get('<?php echo base_url() ?>schedule/search_subject/'+value+'/'+prosID)
		            .then(response => {
		               this.subloader = false
		               this.subjects = response.body
		            })
		         }else{
		            this.subjects = []
		         }
	    	},
	    	insertSubject(){
	    		let s = this.subject 
	    		let c = this.classes
	    		if(this.current_sec == null){
	    			c = this.classes 
	    		}else{
	    			c = this.classes2
	    		}
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
	    			if(this.current_sec == null){
	    				c.push({
	    					loading: false,
	        				classID: 0,
		        			subID: s.subID,
		        			subCode: s.subCode,
		        			subDesc: s.subDesc,
		        			units: s.units,
		        			type: s.type,
		        			day: null,
		        			timeIn: '',
		        			timeOut: '',
		        			room: null,
		        			faculty: null,
		        			status2: 0,
		        			error: false,
		        			msg: null,
		        		})
		        		swal('Subject successfully added to form!', {icon: 'success'})
	    			}else{
	    				const v = this.class_to_be_added 
	    				v.subID = s.subID 
	    				v.subCode = s.subCode 
	    				v.subDesc = s.subDesc 
	    				v.msg = null
	    				this.add_class_to_section(c, v)
	    			}
	        		
				    this.resetSubject()
	    		}
	    	},
	    	add_class_to_section(c, v){
	    		this.$http.post('<?php echo base_url() ?>schedule/add_class_to_section', {data: this.class_to_be_added2})
	        	.then(response => {
	        		swal('Subject successfully added to form!', {icon: 'success'})
	        		v.classID = response.body
	        		c.push(v)
	        		console.log(c)
	        		this.reset_class_to_be_added()
				}, response => {
					this.add_class_to_section(c, v)
				})
	    	},
	    	updateForm(secID){
	    		this.add_subject2 = false
	    		this.reset_class_to_be_added()

	    		this.current_sec = secID
	    		this.ready2 = false
	    		this.loader = true
	    		this.$http.get('<?php echo base_url() ?>schedule/get_sec_info/' + secID + '/' + this.current_term.termID)
	        	.then(response => {
	        		const c = response.body
	        		this.loader = false
	        		this.ready3 = true 
	        		this.prospectus2 = c.prospectus 
	        		this.year2 = c.year
	        		this.section2 = c.section
	        		this.sections3 = c.sections
	        		this.update_sec = c.section
	        		this.prepareForm2(c.classes)
				}, e => {
					console.log(e.body)

				})
	    	},
	    	createForm(){
	    		this.ready2 = true
	    		this.ready3 = false 
	    		this.current_sec = null
	    		this.add_subject2 = false
	    		this.reset_class_to_be_added()
	    	},
	    	reset_class_to_be_added(){
	    		this.subject = null
	    		const c = {
	    			loading: false,
		        	classID: 0,
		        	subID: null,
	    			subCode: '',
	    			subDesc: '',
	    			units: null,
	    			type: '',
	    			day: null,
	    			timeIn: '',
	    			timeOut: '',
	    			room: null,
	    			faculty: null,
	    			status2: 0,
	    			error: false,
	    			msg: null
	    		}
	    		this.class_to_be_added = c
	    	},
	    	is_conflict(){
	    		const c = this.class_to_be_added
	    		const classes = this.classes2
	    		const s = this.subject 
	    		let has_conflict = has_error = false
	    		let per_week = null
	    		if(s != null && c.timeIn && c.timeOut && c.day != null && c.room != null && c.faculty != null){
	    			c.units = s.units
	    			per_week = this.time_per_week(c.timeIn,c.timeOut,c.day.dayCount)
					if(per_week != this.unit_to_hr(c.units)){
    					c.msg = "Time should be "+c.units+" hours a week. Time given a week "+per_week
    					has_error = true
					}else{
						for(let [i,cc] of classes.entries()){
		    				c.timeIn = this.remove_milliseconds(c.timeIn)
							c.timeOut = this.remove_milliseconds(c.timeOut)
							cc.timeIn = this.remove_milliseconds(cc.timeIn)
							cc.timeOut = this.remove_milliseconds(cc.timeOut)
		    				if(cc.day.dayID == c.day.dayID && c.timeOut > cc.timeIn && cc.timeOut > c.timeIn){
		    					c.msg = "Class has conflict in this section. ("+cc.subCode+")"
		    					has_error = true
								break
		    				}
		    			}
					}
					if(!has_error){
						this.is_conflict2(c)
					}
	    		}else{
	    			c.msg = null
	    		}
	    	},
	    	is_conflict2(c){
	    		c.loading = true 
	    		const data = {
	    			termID: this.current_term.termID,
	    			classID: c.classID,
					timeIn: c.timeIn,
					timeOut: c.timeOut,
					dayID: c.day.dayID,
					roomID: c.room.roomID,
					facID: c.faculty.facID
				}
	    		this.$http.post('<?php echo base_url() ?>schedule/checkConflict', data)
	        	.then(response => {
	        		const res = response.body
	        		if(res == 'ok'){
	        			c.msg = 0
	        		}else{
	        			c.msg = res
	        		}
	        		c.loading = false
				}, response => {
					this.is_conflict2(c)
				})
	    	},
	    	checkConflict(i){
	    		let msg = ''
	    		let classes = null
	    		if(this.current_sec == null){
	    			classes = this.classes
	    		}else{
	    			classes = this.classes2
	    			this.is_conflict()
	    		}
	    		const c = classes[i]
	    		if(!c.timeIn || !c.timeOut || c.day == null || c.room == null || c.faculty == null || c.status2 == 1){
	    			c.msg = null
	    			if(!c.timeIn || !c.timeOut && c.status2 == 0){
	    				this.checkConflict3(i, classes)
	    			}
	    			if(this.current_sec != null){
	    				c.msg = 'All fields are required'
	    			}
	    		}else{
	    			this.checkConflict3(i, classes)
	    		}
	    	},
	    	checkConflict2(c, i, ii){
	    		if(this.current_sec == null){
	    			//dli mo update sa uban row if uban row is msg is empty or msg = 0
	    			if(!(i != ii && c.msg == null || c.msg == 0)){ 
	    				this.checkConflict4(c, i)
	    			}
	    		}else{
	    			//dli mo update sa uban row if uban row is msg is empty or msg = 1
	    			if(!(i != ii && c.msg == null || c.msg == 1)){ 
	    				this.checkConflict4(c, i)
	    			}
	    		}
	    	},
	    	checkConflict4(c, i){
	    		c.loading = true
	    		const data = {
	    			termID: this.current_term.termID,
	    			classID: c.classID,
					timeIn: c.timeIn,
					timeOut: c.timeOut,
					dayID: c.day.dayID,
					roomID: c.room.roomID,
					facID: c.faculty.facID
				}
				this.$http.post('<?php echo base_url() ?>schedule/checkConflict', data)
	        	.then(response => {
	        		const res = response.body
	        		if(res == 'ok'){
	        			c.msg = 0
	        		}else if(res == 'updated'){
	        			c.msg = 1	
	        		}
	        		else{
	        			c.msg = res
	        		}
	        		c.loading = false
				}, response => {
					this.checkConflict(i)
				})
	    	},
	    	checkConflict3(i, classes){
	    		const c = classes[i]
	    		let has_conflict = false
	    		let per_week = null
	    		for(let [ii, cc] of classes.entries()){

    				if(cc.timeIn && cc.timeOut && cc.day != null && cc.room != null && cc.faculty != null && cc.status2 == 0){

    					per_week = this.time_per_week(cc.timeIn,cc.timeOut,cc.day.dayCount)

						if(per_week != this.unit_to_hr(cc.units)){
	    					cc.msg = "Time should be "+cc.units+" hours a week. Time given a week "+per_week
						}else{
							for(let [iii, ccc] of classes.entries()){
								if(iii != ii){
									if(ccc.timeIn && ccc.timeOut && ccc.day != null && ccc.room != null && ccc.faculty != null && ccc.status2 == 0){
										cc.timeIn = this.remove_milliseconds(cc.timeIn)
										cc.timeOut = this.remove_milliseconds(cc.timeOut)
										ccc.timeIn = this.remove_milliseconds(ccc.timeIn)
										ccc.timeOut = this.remove_milliseconds(ccc.timeOut)
			    						if(ccc.day.dayID == cc.day.dayID && cc.timeOut > ccc.timeIn && ccc.timeOut > cc.timeIn){
											has_conflict = true
											if(ii == i){
					    						cc.msg = "Class has conflict in this section. ("+ccc.subCode+")"
					    					}
											break
				    					}
			    					}
								}
		    					
		    				}
		    				if(!has_conflict){
		    					if(ii == i){
		    						if(c.timeIn && c.timeOut){
		    							this.checkConflict2(c,i, ii)
		    						}else{
		    							c.msg = null
		    						}
		    						
		    					}else{
		    						this.checkConflict2(cc,i, ii)
		    					}
		    				}
						}
    				}
    				has_conflict = false
    				per_week = null
    			}
	    	},
	    	remove_milliseconds(t){
	    		const x = t.split(':')
	    		return x[0]+':'+x[1]
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
				 }, e => {
				 	console.log(e.body)

				 })
	        },
	        prepareForm(classes){
	        	const arr = []
	        	for(c of classes){
	        		arr.push({
	        			loading: false,
	        			classID: 0,
	        			subID: c.subID,
	        			subCode: c.subCode,
	        			subDesc: c.subDesc,
	        			units: c.units,
	        			type: c.type,
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
	        			loading: false,
	        			classID: c.classID,
	        			subID: c.subID,
	        			subCode: c.subCode,
	        			subDesc: c.subDesc,
	        			units: c.units,
	        			type: c.type,
	        			day: {dayID: c.dayID, dayDesc: c.dayDesc, dayCount: c.dayCount},
	        			timeIn: c.timeIn,
	        			timeOut: c.timeOut,
	        			room: {roomID: c.roomID, roomName: c.roomName},
	        			faculty: {facID: c.facID, faculty: c.faculty},
	        			status2: 0,
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