<!-- prepare form is change. if theres any error, try going back to the old prepareform -->
<style>
	.btn-height{
    	height: 40px;
    }
	.btn-width{
		width: 60px;
	}
	.warn-msg{
		color: #fbac00;
		font-weight: bold;
	}
	.err{
		color: red;
	}
	/*.table{
		table-layout: fixed;
	}*/
	.table td {border: none !important;}
	/*.table tr:last-child{
	  border-bottom: solid 1px #ccc !important;
	} */
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

<div id="app" v-cloak>
	<section class="section">
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
			<button @click="copyScheduleModal = true" class="button is-primary" v-if="added_sections.length == 0">Copy Schedule</button>
		</div>
	</section>
	
	<div class="tabs is-boxed is-centered">
	 	<ul>
	 		<li :class="{'is-active': ready2}">
	      		<a @click="createForm">Create schedule</a>
	    	</li>
	    	<li :class="{'is-active': current_sec == sec.secID}" v-for="sec of added_sections">
	    		<a v-if="current_sec != sec.secID" @click="updateForm(sec.secID)"> {{sec.secName}} </a>
	    		<a v-else> {{sec.secName}} </a>
	    	</li>
	  	</ul>
	</div>
	
	<section class="section">
		<div class="container">


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
				
				<div v-show="ready">
					<div class="columns">
						<div class="column">
							<div v-if="add_subject">
								<multiselect v-if="add_subject" v-model="subject" label="subject" track-by="subID" placeholder="Enter subject code / description" :options="subjects" :loading="subloader" :internal-search="false" @search-change="searchSubjects">
		                        </multiselect>
							</div>
						</div>
						<div class="column">
							<div v-if="add_subject">
								<button @click="resetSubject" class="button btn-height btn-width">Cancel</button>	
								<button @click="insertSubject" class="button is-link btn-height btn-width">Add</button>	
							</div>
						</div>
						<div class="column">
							<div class="is-pulled-right">
								<button v-if="!add_subject" class="button is-primary btn-height" @click="add_subject = true">Add subject</button>
								<button :class="{'button is-link btn-height': true, 'is-loading': isLoading}" @click="submitForm" v-if="classes.length > 0">Create schedule</button>
							</div>
						</div>
					</div>
					<div class="box">
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
									<td class="row-12"> <input @input="checkConflict(i)" v-model="record.timeIn" type="time" class="input" required :disabled="record.status2 == 1 || record.merge_to != null"> </td>
									<td class="row-12"> <input @input="checkConflict(i)" v-model="record.timeOut" type="time" class="input" required :disabled="record.status2 == 1 || record.merge_to != null"> </td>
									<td class="row-10">
										<multiselect :show-labels="false" @input="checkConflict(i)" v-model="record.day" track-by="dayID" label="dayDesc" :options="days" placeholder="" :allow-empty="false" :disabled="record.status2 == 1 || record.merge_to != null"></multiselect>
									</td>
									<td class="row-13">
										<multiselect :show-labels="false" @input="checkConflict(i)" v-model="record.room" track-by="roomID" label="roomName" :options="rooms" placeholder="" :allow-empty="false" :disabled="record.status2 == 1 || record.merge_to != null"></multiselect>
									</td>
									<td class="row-19">
										<multiselect :show-labels="false" @input="checkConflict(i)" v-model="record.faculty" track-by="facID" label="faculty" :options="faculties" placeholder="" :allow-empty="false" :disabled="record.status2 == 1 || record.merge_to != null"></multiselect>
									</td>
									<td>
										<div :class="{'dropdown is-right': true, 'is-active': record.open_action}">
					                    	<div class="dropdown-trigger">
					                        	<a style="color: gray" aria-haspopup="true" href="javascript:void(0)" @click="toggle_action(record.open_action, i)">
					                        		<i style="font-size: 20px" class="fa fa-ellipsis-v"></i> 
					                        	</a>
					                    	</div>
					                    	<div class="dropdown-menu" role="menu">
					                        	<div class="dropdown-content">
					                        		<a class="dropdown-item has-text-left" v-if="record.status2 == 0 && !record.merge_to" @click="changeStatus2(record.status2, i)">
					                        			<span class="icon has-text-danger"> <i class="fa fa-thumbs-down"></i> </span> Unoffer subject
					                        		</a>
					                        		<a v-else-if="record.status2 == 1 && !record.merge_to" class="dropdown-item has-text-left" @click="changeStatus2(record.status2, i)">
					                        			<span class="icon has-text-success"> <i class="fa fa-thumbs-up"></i> </span> Offer subject
					                        		</a>
					                        		<a @click="splitClass(i)" v-if="record.status2 == 0 && record.merge_to" class="dropdown-item has-text-left">
					                        			<span class="icon has-text-primary"> <i class="fa fa-cut"></i> </span> Split class
					                        		</a>
					                        		<a v-else-if="record.status2 == 0 && !record.merge_to" @click="openClassModal(i)" class="dropdown-item has-text-left">
					                        			<span class="icon has-text-primary"> <i class="fa fa-chain"></i> </span> Merge class
					                        		</a>
					                        	</div>
					                    	 </div>
					                  	</div>
									</td>
								</tr>
								<tr v-if="record.msg != null || record.merge_to">
									<td colspan="8" style="text-align: left">
										<div v-show="record.loading" class="is-pulled-left">
											<div class="loading2" data-text="checking...">checking...</div>
										</div>
										<div v-show="!record.loading">
											<span v-if="record.msg == 0" class="has-text-success">
												<b>No conflict <i class="fa fa-check"></i></b>
											</span>
											<span v-else-if="record.merge_to" class="has-text-primary">
												Merged to <b>{{record.merge_to.class}}</b> in section <b>{{record.merge_to.section}} </b> (Pending)
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


			<div v-show="loader" class="loader"></div>


			<div v-if="ready3" v-show="!loader">
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
				
				<div style="padding-bottom: 65px" v-if="!add_subject2">
					<button class="button is-primary btn-height is-pulled-right" @click="add_subject2 = true">
						Add subject
					</button>	
				</div>
				

				<div class="box" v-if="add_subject2">
					<form v-on:submit.prevent="insertSubject">
						<div class="columns">
		                	<div class="column">
		                		<multiselect v-if="add_subject2" @input="is_conflict" v-model="subject" label="subject" track-by="subID" placeholder="Enter subject code / description" :options="subjects" :loading="subloader" :internal-search="false" @search-change="searchSubjects">
		               			</multiselect>
		                	</div>
		                	<div class="column">
		            			<button type="button" class="button btn-height btn-width" @click="resetSubject">Cancel</button>	
								<button type="submit" class="button is-link btn-height btn-width" :disabled="is_disable_add">Add</button>
		                	</div>
		                </div>
		                <table class="table is-fullwidth is-centered">
		                	<tr>
								<th>Units</th>
								<th colspan="2" style="width: 25%">Time</th>
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

				<div class="box">
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
							<tr>
								<td class="row-10" style="text-align: left">
									{{record.subCode}} <span v-if="record.type == 'lab'"><b>(lab)</b></span>
								</td>
								<td class="row-17" style="text-align: left">{{record.subDesc}}</td>
								<td>{{record.units}}</td>
								<td class="row-12"> <input :disabled="record.merge_to != null" @input="checkConflict(i)" v-model="record.timeIn" type="time" class="input" required> </td>
								<td class="row-12"> <input :disabled="record.merge_to != null" @input="checkConflict(i)" v-model="record.timeOut" type="time" class="input" required> </td>
								<td class="row-10">
									<multiselect :disabled="record.merge_to != null" :show-labels="false" @input="checkConflict(i)" v-model="record.day" track-by="dayID" label="dayDesc" :options="days" placeholder="" :allow-empty="false"></multiselect>
								</td>
								<td class="row-13">
									<multiselect :disabled="record.merge_to != null"  :show-labels="false" @input="checkConflict(i)" v-model="record.room" track-by="roomID" label="roomName" :options="rooms" placeholder="" :allow-empty="false"></multiselect>
								</td>
								<td class="row-19">
									<multiselect :disabled="record.merge_to != null" :show-labels="false" @input="checkConflict(i)" v-model="record.faculty" track-by="facID" label="faculty" :options="faculties" placeholder="" :allow-empty="false"></multiselect>
								</td>
								<td>
									<div :class="{'dropdown is-right': true, 'is-active': record.open_action}">
				                    	<div class="dropdown-trigger">
				                        	<a style="color: gray" aria-haspopup="true" href="javascript:void(0)" @click="toggle_action(record.open_action, i)">
				                        		<i style="font-size: 20px" class="fa fa-ellipsis-v"></i> 
				                        	</a>
				                    	</div>
				                    	<div class="dropdown-menu" role="menu">
				                        	<div class="dropdown-content">
				                        		<a class="dropdown-item has-text-left" :href="'<?php echo base_url() ?>maintenance/subject/show/' + record.id + '/' + record.prosID" target="_blank">
				                        			<span class="icon has-text-link"> <i class="fa fa-angle-double-right"></i> </span> View details
				                        		</a>
				                        		<a @click="deleteClass(i)" class="dropdown-item has-text-left">
				                        			<span class="icon has-text-danger"> <i class="fa fa-trash"></i> </span> Delete class
				                        		</a>
				                        		<a @click="splitClass(i)" v-if="record.merge_to" class="dropdown-item has-text-left">
				                        			<span class="icon has-text-primary"> <i class="fa fa-cut"></i> </span> Split class
				                        		</a>
				                        		<a v-else @click="openClassModal(i)" class="dropdown-item has-text-left">
				                        			<span class="icon has-text-primary"> <i class="fa fa-chain"></i> </span> Merge class
				                        		</a>
				                        	</div>
				                    	 </div>
				                  	</div>
								</td>
							</tr>
							<tr v-if="record.msg != null || record.merge_to">
								<td colspan="8" style="text-align: left">
									<div v-show="record.loading" class="is-pulled-left">
										<div class="loading2" data-text="checking...">checking...</div>
									</div>
									<div v-show="!record.loading">
										<span v-if="record.msg == 1" class="has-text-success">
											<b>Updated <i class="fa fa-check"></i></b>
										</span>
										<span v-else-if="record.merge_to" class="has-text-primary">
											Merged to <b>{{record.merge_to.class}}</b> in section <b>{{record.merge_to.section}} </b>
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

	
	<div class="modal is-active" v-if="copyScheduleModal">
       <div class="modal-background"></div>
       <div class="modal-card">
        <header class="modal-card-head">
           <p class="modal-card-title">Copy Schedule</p>
           <button class="delete" aria-label="close" @click="close_scheduleModal"></button>
        </header>
        <section class="modal-card-body">
			<div class="field">
				<label class="label">Select Term to copy schedule</label>
				<multiselect v-model="termSchedule" track-by="termID" label="term" :options="termSchedules"></multiselect>
			</div>
        </section>
        <footer class="modal-card-foot pull-right">
           <button @click="copySchedule" :disabled="!termSchedule" class="button is-primary is-fullwidth btn-height">Copy Schedule</button>
        </footer>
       </div>
	</div>
	
	<div class="modal is-active" v-if="classModal">
       <div class="modal-background"></div>
       <div class="modal-card">
        <header class="modal-card-head">
           <p class="modal-card-title">Merge Class</p>
           <button class="delete" aria-label="close" @click="close_classModal"></button>
        </header>
        <section class="modal-card-body">
        	<div class="field">
        		<label class="label">Code</label>
        		<div class="control" style="font-size: 14px">
        			{{class_to_merge.subCode}}<span if="class_to_merge.type == 'lab'"> (lab)</span>
        		</div>
        	</div>
        	<div class="field">
        		<label class="label">Description</label>
        		<div class="control">
        			<p style="font-size: 14px">{{class_to_merge.subDesc}}</p>
        		</div>
        	</div>
           <div class="field">
              <label class="label">Select section</label>
              <div class="control">
                 <multiselect @input="get_classes" v-model="active_section" track-by="secID" label="secName" :options="added_sections2" placeholder=""></multiselect>   
              </div>
           </div>
           <div class="field">
              <label class="label">Select class code</label>
              <div class="control">
                 <multiselect open-direction="bottom" v-model="selected_class" label="codelabel" track-by="classID" placeholder="" :options="class_suggestions" :loading="isLoading2">
                 </multiselect>      
              </div>
           </div>
        </section>
        <footer class="modal-card-foot pull-right">
           <button :disabled="!selected_class" @click="mergeClass" class="button is-primary is-fullwidth btn-height"><b>Merge {{class_to_merge.subCode}} <span v-if="selected_class"> to {{selected_class.subCode}} in section <b>{{active_section.secName}}</b></span></b> </button>
        </footer>
       </div>
	</div>

</div>

<br><br><br><br>





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
	    	current_term: {termID: '<?php echo $current_term->termID; ?>', term: '<?php echo $current_term->term; ?>', semID: '<?php echo $current_term->semID; ?>'},
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
    			open_action: false
	        },

	        class_to_merge: null,
	        selected_index: null,
	        classModal: false,
	        active_section: null,
	        selected_class: null,
	        class_suggestions: [],
	        isLoading2: false,

	        copyScheduleModal: false,
	        termSchedule: null,
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
	    	termSchedules(){
	    		return this.terms.filter(x => x.termID != this.current_term.termID && x.semID == this.current_term.semID)
	    	},
	    	added_sections2(){
	    		if(this.current_sec){
	    			return this.added_sections.filter(x => x.secID != this.current_sec)
	    		}else{
	    			return this.added_sections
	    		}
	    	},
			sections2(){
				return this.sections.filter(x => !this.added_sections.find(j => j.secID == x.secID))
				// const sections = this.sections 
				// const added_sections = this.added_sections 
				// let arr = []
				// for(s of sections){
				// 	if(!added_sections.find(j => j.secID == s.secID)){
				// 		arr.push(s)
				// 	}
				// }
				// return arr
			},
			sections4(){
				return this.sections3.filter(s => !this.added_sections.find(j => j.secID == s.secID && j.secID != this.update_sec.secID))

				// const sections = this.sections3
				// const added_sections = this.added_sections 
				// const update_sec = this.update_sec.secID
				// let arr = []
				// for(s of sections){
				// 	if(!added_sections.find(j => j.secID == s.secID && j.secID != update_sec)){
				// 		arr.push(s)
				// 	}
				// }
				// return arr
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
	    	close_scheduleModal(){
	    		this.copyScheduleModal = false
	    		this.termSchedule = null
	    	},
	    	copySchedule(){
	    		swal({
				  title: "Confirmation",
				  text: "Do you really want to copy schedule from "+this.termSchedule.term+"?",
				  icon: "info",
				  buttons: {
				  	cancel: true,
				  	confirm: {
				  		closeModal: false
				  	}
				  },
				  dangerMode: true
				})
				.then((willCopy) => {
				  if (willCopy) {
				    this.$http.post('<?php echo base_url() ?>schedule/copySchedule/', {current_term: this.current_term.termID, term_to_copy: this.termSchedule.termID})
	    			.then(res => {
	    				console.log(res.body)
	    				if(res.body == 'empty'){
	    					swal('Error', 'No classes in this term!', 'error')
	    				}else{
	    					swal('Success', 'Schedule successfully copied from '+ this.termSchedule.term + '!', 'success')
		    				this.added_sections = res.body
		    				this.close_scheduleModal()	
	    				}
	    				
	    			}, e => {
	    				console.log(e.body)
	    			})
				  }
				})
	    	},
	    	splitClass(i){
	    		const c = (this.current_sec) ? this.classes2[i] : this.classes[i]
	    		c.open_action = false
	    		c.timeIn = ''
	    		c.timeOut = ''
	    		c.day = null 
	    		c.room = null 
	    		c.faculty = null 
	    		c.merge_to = null 

	    		if(this.current_sec){
	    			this.$http.get('<?php echo base_url() ?>schedule/splitClass/' + c.classID)
	    			.then(res => {
	    				console.log(res.body)
	    			}, e => {
	    				console.log(e.body)
	    			})	
	    		}
	    	},
	    	afterMerge(c, class_merge){
    			c.error = false
	    		c.timeIn = class_merge.timeIn
	    		c.timeOut = class_merge.timeOut
	    		c.day = {dayID: class_merge.dayID, dayDesc: class_merge.dayDesc, dayCount: class_merge.dayCount}
	    		c.room = {roomID: class_merge.roomID, roomName: class_merge.roomName}
	    		c.faculty = {facID: class_merge.facID, faculty: class_merge.ln + ', ' + class_merge.fn}
	    		c.merge_to = {section: this.active_section.secName, class: class_merge.codelabel, classID: class_merge.classID}
	    		c.msg = null
	    		this.close_classModal()
	    	},
	    	mergeClass(){
	    		const c = (this.current_sec) ? this.classes2[this.selected_index] : this.classes[this.selected_index]
	    		const class_merge = this.selected_class

	    		if(c.units != class_merge.units){
	    			swal('Error', 'Both classes should have equal units!', 'error')
	    		}else if(class_merge.merge_with != 0){
	    			swal('Error', 'Unable to merge. Selected class is merged with another class!', 'error')
	    		}else{
		    		if(this.current_sec){
		    			k = {
		    				roomID: class_merge.roomID,
		    				facID: class_merge.facID,
		    				dayID: class_merge.dayID,
		    				timeIn: class_merge.timeIn,
		    				timeOut: class_merge.timeOut,
		    				merge_with: class_merge.classID
		    			}
		    			//console.log(class_merge)
		    			this.$http.post('<?php echo base_url() ?>schedule/mergeClass/', {data: k, classID: c.classID})
		    			.then(res => {
		    				console.log(res.body)
		    				if(res.body == 'success'){
		    					swal('Success', c.subCode+' successfully merge to '+class_merge.subCode+' in section '+this.active_section.secName,'success')
		    					this.afterMerge(c, class_merge)	
		    				}else{
		    					swal('Error', res.body, 'error')
		    				}
		    				
		    			}, e => {
		    				console.log(e.body)
		    			})
		    		}else{
		    			swal('Success', c.subCode+' successfully merge to '+class_merge.subCode+' in section '+this.active_section.secName + '(Pending)','success')
		    			this.afterMerge(c, class_merge)
		    		}
	    		}
	    	},
	    	openClassModal(i){
	    		const c = (this.current_sec) ? this.classes2[i] : this.classes[i]
	    		this.class_to_merge = c
	    		this.selected_index = i
	    		this.classModal = true 
	    		c.open_action = false
	    	},
	    	get_classes(){
	    		this.class_suggestions = []
		         this.selected_class = null
		         const section = this.active_section
		         if(section){
		            this.isLoading2 = true
		            this.$http.get('<?php echo base_url() ?>schedule/get_classes/'+section.secID)
		            .then(response => {
		               this.isLoading2 = false
		               this.class_suggestions = response.body.map(g => {
		                  g.codelabel = (g.type == 'lab') ? g.subCode +' (' + g.type + ')' : g.subCode
		                  return g
		               })
		            }, e => {
		               console.log(e.body)

		            })   
		         }
	    	},
	    	close_classModal(){
	    		this.classModal = false
	    		this.active_section = null
	    		this.selected_class = null 
	    		this.class_suggestions = []
	    		this.selected_index = null 
	    		this.class_to_merge = null 

	    	},
	    	toggle_action(is_open , i){
	    		const classes = (this.current_sec == null) ? this.classes[i] : this.classes2[i]
	    		if(is_open){
	    			classes.open_action = false
	    		}else{
	    			classes.open_action = true
	    		}
	    	},
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
	    		const selClass = this.classes2[i] 
	    		const classID = selClass.classID
	    		selClass.open_action = false
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
	        		}else if(c == 2){
	        			swal("Unable to delete", "Class has merged schedule!", "error")
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
		        			open_action: false,
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
	        		//console.log(c.classes)
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
	    			msg: null,
	    			open_action: false
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
	    		// let msg = ''
	    		// let classes = null
	    		if(this.current_sec == null){
	    			classes = this.classes
	    		}else{
	    			classes = this.classes2
	    			this.is_conflict()
	    		}
	    		const c = classes[i]

	    		c.loading = true 

				this.debounce(function(){
					
		    		if(!c.timeIn || !c.timeOut || c.day == null || c.room == null || c.faculty == null || c.status2 == 1){
		    			c.msg = null
		    			if(!c.timeIn || !c.timeOut && c.status2 == 0){
		    				this.checkConflict3(i, classes)
		    			}
		    			if(this.current_sec != null){
		    				c.msg = 'All fields are required'
		    				c.loading = false 
		    			}
		    		}else{
		    			this.checkConflict3(i, classes)
		    		}
				}, 1000)
	    	},
	    	checkConflict2(c, i, ii){
	    		if(this.current_sec == null){
	    			//dli mo update sa uban row if uban row is msg is empty or msg = 0
	    			if(!(i != ii && (c.msg == null || c.msg == 0))){ 
	    				this.checkConflict4(c, i)
	    			}
	    		}else{
	    			//dli mo update sa uban row if uban row is msg is empty or msg = 1
	    			if(!(i != ii && (c.msg == null || c.msg == 1))){ 
	    				this.checkConflict4(c, i)
	    			}
	    		}
	    	},
	    	checkConflict4(c, i){
	    		// c.loading = true
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
	        		//console.log(res)
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
    					// console.log(this.is_time_conflict(cc, c))
    					if(!this.is_time_conflict(cc, c,i,ii)){
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
												//cc.msg old code
												//cc.loading old code
					    						c.msg = "Class has conflict in this section. ("+ccc.subCode+")"
					    						c.loading = false
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
	    	is_time_conflict(cc, c,i,ii){
	    		console.log(cc);
	    		per_week = this.time_per_week(cc.timeIn,cc.timeOut,cc.day.dayCount)
	    		has_error = false
	    		if(per_week != cc.hrs_per_wk){
	    			cc.msg = "Time should be "+cc.hrs_per_wk+" hours a week. Time given a week "+per_week
	    			cc.loading = false
	    			has_error = true
	    		}
	    		return has_error
	    	},
	    // 	is_time_conflict(cc, c,i,ii){
	    // 		per_week = this.time_per_week(cc.timeIn,cc.timeOut,cc.day.dayCount)
	    // 		has_error = false
	    // 		console.log(cc.subID2)
	    // 		if(cc.subID2){
	    // 			if(per_week != '03:00:00'){
	    // 				cc.msg = "Time should be 3 hours a week. Time given a week "+per_week
					// 	cc.loading = false
					// 	has_error = true
	    // 			}
	    // 		}else{
	    // 			if(per_week != this.unit_to_hr(cc.units)){
					// 	cc.msg = "Time should be "+cc.units+" hours a week. Time given a week "+per_week
					// 	cc.loading = false
					// 	has_error = true
					// }
	    // 		}
	    // 		return has_error
	    // 	},
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
	    		this.classes[i].open_action = false
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
	        		this.faculties = c.faculties.map(x => {
	        			if(x.facID != 0){
	        				x.faculty = x.ln + ', ' + x.fn
	        			}else{
	        				x.faculty = ''
	        			}
	        			
	        			return x
	        		})
	        		const a = this.faculties.splice(this.faculties.findIndex(i => i.facID == 0), 1)
	    			this.faculties.unshift(a[0])
	    			
	        		this.added_sections = c.added_sections
				 })
	        },
	        fetchClasses(){
	        	this.$http.get('<?php echo base_url() ?>schedule/fetchClasses/' + this.year.yearID +'/'+ this.prospectus.prosID +'/'+this.current_term.termID)
	        	.then(response => {
	        		const c = response.body
	        		this.sections = c.sections
	        		this.prepareForm(c.classes)
				 }, e => {
				 	console.log(e.body)

				 })
	        },
	        prepareForm(classes){

	        	this.classes = classes.map(x => {
	        		x.loading = false
        			x.classID = 0
        			x.day = null
        			x.timeIn = ''
        			x.timeOut = ''
        			x.room = null
        			x.faculty = null
        			x.status2 = 0
        			x.error = false
        			x.msg = null
        			x.open_action = false
	        		return x
	        	})

	        },
	        prepareForm2(classes){
	        	this.classes2 = classes.map(c => {

	        		if(c.class_merge){
	        			const merge = c.class_merge.split('|')
	        			const codelabel = (merge[1].type == 'lab') ? merge[0] +' (lab)' : merge[0]	
	        			c.merge_to = {section: merge[2], class: codelabel, classID: c.merge_with}
	        		}
	        		
	        		if(c.facID != 0){
        				c.faculty = c.ln + ', ' + c.fn
        			}else{
        				c.faculty = ''
        			}
        			if(c.timeIn == '00:00:00'){
        				c.timeIn = ''
        				c.timeOut = ''	
        			} 

	        		c.loading = false
        			c.day = {dayID: c.dayID, dayDesc: c.dayDesc, dayCount: c.dayCount}
        			c.room = {roomID: c.roomID, roomName: c.roomName}
        			c.faculty = {facID: c.facID, faculty: c.faculty}
        			c.msg = null
        			c.open_action = false
        			c.status2 = 0
        			return c
	        	})
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
	        	}else if(c.findIndex(g => (g.msg != 0 && !g.merge_to) && g.status2 == 0) != -1){
	        		swal('Form has errors!','Please review the form', {
				      icon: 'error',
				    })
	        	}else{
	        		this.isLoading = true
	        		this.$http.post('<?php echo base_url() ?>schedule/create', {termID: this.current_term.termID, secID: this.section.secID, classes: c})
			        .then(response => {
			        	if(response.body == 'exist'){
			        		swal('Error', "Section already exist!", 'error')
			        	}else{
			        		swal('Schedule successfully created!', {
						      icon: 'success'
						    })
			        		this.added_sections = response.body
			        		this.isLoading = false
			        		this.year = null
			        		this.section = null
			        		this.ready = false	
			        	}
			        	
					}, e => {
						console.log(e.body)

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
	        },
	        debounce(func, delay){
	        	let inDebounce
		    	const context = this
		    	const args = arguments
		    	clearTimeout(inDebounce)
		    	inDebounce = setTimeout(() => func.apply(context, args), delay)
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