<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Enrollment
      </h1>
    </div>
  </div>
</section>

<div id="app" v-cloak>
      <?php 
         if($roleID == 1){ ?>
            <div class="container" v-if="selected_student == null" style="margin-top: 50px">
            <?php 
               if($status == 'active'){ ?>
                  <button class="button is-danger is-large is-outlined" v-on:click="change_enrolStatus('inactive')">Deactivate</button>
                  <button class="button is-success is-large">Activated</button>
                  <?php
               }else{ ?>
                  <button class="button is-danger is-large">Inactive</button>
                  <button class="button is-success is-large is-outlined" v-on:click="change_enrolStatus('active')">Activate</button>
                  <?php
               }
            ?>
            </div>
            <?php
         }
      if($status == 'active'){ ?>
         
         <section class="section">
            <div class="container">
               <div class="box">
                  <div class="columns">
                     <div class="column is-half">
                        <div class="field">
                           <label class="label">Search student:</label>
                           <div class="control">
                              <multiselect v-model="selected_student" label="student" track-by="studID" placeholder="Enter name / control no" :options="suggestions" :loading="isLoading" :internal-search="false" @search-change="search">
                              </multiselect>
                           </div>
                           <table v-show="ready">
                              <tr>
                                 <td>Status:</td><td :class="statusClass">&ensp; {{status2}}</td>   
                              </tr>
                           </table>
                        </div>
                     </div>
                     <?php 
                        if(in_array('20', $user_access) || $roleID == 1){ ?>
                           <div class="column" v-show="ready">
                              <a :href="grade_link" class="button is-primary is-pulled-right" target="_blank">View student's grade</a>
                              <br>
                           </div>
                           <?php
                        }
                     ?>
                  </div>
               </div>
               <div v-show="ready">
                  <br>
                  <div class="box" v-if="stud != null">
                     <table class="table is-fullwidth">
                        <thead>
                           <th>Control number</th>
                           <th>Name</th>
                           <th>Course</th>
                           <th>Yearlevel</th>
                        </thead>
                        <tbody>
                           <td> {{stud.controlNo}} </td>
                           <td> {{stud.name}} </td>
                           <td> {{stud.courseCode}} </td>
                           <td> {{stud.yearDesc}} </td>
                        </tbody>
                     </table>
                  </div>
                  <div class="field has-addons" v-show="status == 'Empty'">
                     <div class="control" style="width: 25%">
                        <multiselect v-model="section" track-by="secID" label="secName" :options="sections" placeholder="Select Section"></multiselect>
                     </div>
                     <div class="control">
                        <button :class="{'button is-link': true, 'is-loading': loading_btn}" style="height: 38px" v-show="section != null" @click="section_add">GO</button>
                     </div>
                  </div>
                  <div class="box">
                     <div class="columns">
                        <div class="column">
                           <h5 class="title is-5">
                              Classes selected
                           </h5>
                        </div>
                        <div class="column" v-if="status != 'Enrolled'">
                           <div class="is-pulled-right">
                              <button :class="{'button is-primary': true, 'is-loading': eval_loading}" v-if="btnEvaluate" v-on:click="evaluate">
                                 Evaluate
                              </button>
                              <div v-if="status == 'Pending'">
                                 <button class="button is-outlined" v-on:click="cancel_pending">
                                    Cancel
                                 </button>
                                 <button class="button is-link" v-on:click="set_enrolled">
                                    Confirm
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <hr>
                     <div class="has-text-centered" v-show="loading_class_sel">
                        loading please wait ...
                     </div>
                     <table class="table is-fullwidth is-centered" v-show="status != 'Empty' && !loading_class_sel">
                        <thead>
                           <tr>
                              <th style="text-align: left">Class Code</th>
                              <th style="text-align: left">Description</th>
                              <th colspan="3" class="has-text-centered">Units</th>
                              <th>Days</th>
                              <th>Time</th>
                              <th v-if="status == 'Unenrolled'">Remove</th>
                           </tr>
                           <tr>
                              <th colspan="2"></th>
                              <th>Lec</th>
                              <th>Lab</th>
                              <th>Total</th>
                              <th colspan="3"></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="record, i in classes">
                              <td style="text-align: left">{{record.classCode}}</td>
                              <td style="text-align: left">{{record.subDesc}}</td>
                              <td>{{record.lec}}</td>
                              <td>{{record.lab}}</td>
                              <td>{{ Number(record.lec) + Number(record.lab) }}</td>
                              <td>{{record.day}}</td>
                              <td>{{record.class_time}}</td>
                              <td v-if="status == 'Unenrolled'">
                                 <button class="button is-rounded is-small is-danger" v-on:click="remove(record.classID,record.subCode,i)">
                                    <span class="icon">
                                       <i class="fa fa-times"></i>
                                    </span>
                                 </button>
                              </td>
                           </tr>
                           <tr>
                              <th></th>
                              <th>Total number of units: </th>
                              <th>{{ units.lec }}</th>
                              <th>{{ units.lab }}</th>
                              <th>{{ units.tot  }}</th>
                              <th colspan="3"></th>
                           </tr>
                        </tbody>
                     </table>
                     <div class="has-text-centered" v-if="!loading_class_sel && status != 'Pending'">
                        <a class="has-text-primary" v-on:click="classModal = true">Add Class</a>
                     </div>   
                  </div>
               </div>
            </div>
         </section>
         
         <div class="modal is-active" v-if="classModal">
           <div class="modal-background"></div>
           <div class="modal-card">
            <header class="modal-card-head">
               <p class="modal-card-title">Add Class</p>
               <button class="delete" aria-label="close" v-on:click="close_classModal"></button>
            </header>
            <section class="modal-card-body">
               <label class="label">Search Class:</label>
               <div class="field has-addons">
                  <div class="control">
                     <span class="select">
                        <select v-model="searchClass_opt" style="height: 40px;">
                           <option value="c.classCode">Class Code</option>
                           <option value="s.subDesc">Description</option>
                        </select>
                     </span>
                  </div>
                  <div class="control" style="width: 100%">
                     <multiselect open-direction="bottom" v-model="selected_class" label="classLabel" track-by="classID" :placeholder="class_ph" :options="class_suggestions" :loading="isLoading2" :internal-search="false" @search-change="searchClass">
                     </multiselect>
                  </div>
               </div>
               <div v-if="selected_class != null">
                  <hr>
                  <table class="table is-fullwidth">
                     <tr>
                        <td><b>Room: </b></td>
                        <td> {{ selected_class.roomName }} </td>
                        <td><b>Section: </b></td>
                        <td> {{ selected_class.secName }} </td>
                     </tr>
                     <tr>
                        <td><b>Days: </b></td>
                        <td> {{ selected_class.day }} </td>
                        <td><b>Lec</b></td>
                        <td>{{ selected_class.lec }}</td>
                     </tr>
                     <tr>
                        <td><b>Time: </b></td>
                        <td> {{ selected_class.class_time }} </td>
                        <td><b>Lab</b></td>
                        <td>{{ selected_class.lab }}</td>
                     </tr>
                     <tr>
                        <td><b>Faculty: </b></td>
                        <td> {{ selected_class.faculty }} </td>
                        <td><b>Total</b></td>
                        <td>{{ Number(selected_class.lec) + Number(selected_class.lab) }}</td>
                     </tr>
                  </table>
               </div>
            </section>
            <footer class="modal-card-foot pull-right">
               <button class="button is-outlined" v-on:click="close_classModal">Close</button>
               <span v-if="selected_class != null">
                  <button v-if="status == 'Enrolled'" class="button is-link" v-on:click="evaluate">Evaluate</button>
                  <button v-else :class="{'button is-link': true, 'is-loading': loading_btn}" v-on:click="addClass">Add</button>
               </span>
            </footer>
           </div>
         </div>
         
         <div :class="{modal: true, 'is-active': evalModal}">
           <div class="modal-background"></div>
           <div class="modal-card">
             <header class="modal-card-head">
               <p class="modal-card-title">Evaluation Completed! </p>
               <button class="delete" aria-label="close" v-on:click="close_evalModal"></button>
             </header>
             <section class="modal-card-body">
               <div class="content my-body">
                  <h4 class="title is-5">Student <span v-html="remark"></span> the evaluation</h4>
                  <div v-for="fc of filtered_classes">
                     <hr>
                     <h5 class="title is-5">
                        <i :class="is_failed_classes(fc.classID,'icon')"></i>
                        {{ fc.classCode }}
                     </h5>
                      <ul v-if="is_failed_classes(fc.classID,'reason')">
                        <span v-for="failed_class of display_reason(fc.classID)">
                           <li v-for="x of failed_class.reason">{{x}}</li>
                        </span>
                     </ul>
                  </div>
               </div>
             </section>
             <footer class="modal-card-foot pull-right">
               <button class="button is-outlined" v-on:click="close_evalModal">Close</button>
               <button class="button is-link" v-on:click="validate_pending_request">
                  {{button_text}}
               </button>
             </footer>
           </div>
         </div>

         <?php
      }
   ?>


</div>


<script>

document.addEventListener('DOMContentLoaded', function() {

  Vue.component('multiselect', window.VueMultiselect.default) 

  new Vue({
   el: '#app',
   data: {
      term: '<?php echo $current_term->term ?>',
      link: '<?php echo base_url() ?>reports/grade/',

      ready: false,
      isLoading: false,
      loading_class_sel: false,
      selected_student: null,
      stud: null,
      section: null,
      suggestions: [],
      msg: '',
      status: '',
      classes: [],

      searchClass_opt: 'c.classCode',
      searchClass_ph: '',
      classModal: false,
      selected_class: null,
      class_suggestions: [],
      isLoading2: false,
      loading_btn: false,

      eval_loading: false,
      evalModal: false,
      failed_classes: [],
      sections: [],
      sections2: [],
    },   
    watch: {
      selected_student(value){
         if(value == null){
            this.ready = false
         }else{
            this.ready = true
            this.classes = []
            this.show_record()
         }
      }
    },
    computed: {
      grade_link(){
         const x = this.selected_student
         if(x != null){
            return this.link + x.studID
         }
          
      },
      statusClass(){
         let y = this.status2
         let x = { 'has-text-primary': true }
         if(y == 'Enrolled'){
            x = { 'has-text-success': true }
         }else if(y == 'Unenrolled'){
            x = { 'has-text-danger': true }
         }
         return x
      },
      btnEvaluate(){
         if(this.status == 'Unenrolled' && this.classes != null){
            return true
         }
      },
      status2(){
         let x = this.status
         if(x == 'Empty'){
            x = 'Unenrolled'
         }
         return x
      },
      filtered_classes(){
         const k =[]
         if(this.status != 'Enrolled'){
            const a = this.classes
            for(x of a){
               k.push({
                  classID: x.classID,
                  subID: x.subID,
                  classCode: x.classCode
               })
            }
         }else{
            const a = this.selected_class
            if(a != null){
               k.push({
                  classID: a.classID,
                  subID: a.subID,
                  classCode: a.classCode
               })
            }
         }
      	return k
      },
      class_ph(){
      	const x = this.searchClass_opt
      	let j = 'Enter class code'
      	if(x == 's.subDesc'){
      		j = 'Enter subject description'
      	}
      	return j
      },
      units(){
         const a = this.classes
         let lec = 0
         let lab = 0
         for(x of a){
            lec += Number(x.lec)
            lab += Number(x.lab)
         }
         return {
            lec: lec,
            lab: lab,
            tot: lec + lab
         }
      },
      classID_in_failed_classes(){
         const x = this.failed_classes
         const t = []
         for(a of x){
            t.push(a.classID)
         }
         return t
      },
      remark(){
         let x = '<span class="has-text-danger">FAILED</span>'
         if(this.failed_classes.length === 0){
            x = '<span class="has-text-success">PASSED</span>'
         }
         return x
      },
      button_text(){
         let x
         if(this.status != 'Enrolled'){
            x = 'Set status to pending'
         }else{
            x = 'Add Class'
         }
         return x
      }
    },
    methods: {
      search(value){
         if(value.trim() != ''){
            this.isLoading = true
            value = value.replace(/\s/g, "_")
            this.$http.get('<?php echo base_url() ?>reusable/search_student/'+value)
            .then(response => {
               this.isLoading = false
               this.suggestions = response.body
            })
         }else{
            this.suggestions = []
         }
      },
      show_record(){
         this.loading_class_sel = true
         this.$http.get('<?php echo base_url() ?>enrollment/get_enrol_data/'+this.selected_student.studID)
         .then(response => {
            this.loading_class_sel = false
            const c = response.body
            console.log(c)
            this.status = c.status
            if(c.status != 'Empty'){
            	this.classes = c.data
            }else{
               this.sections = c.sections
            }
            this.sections2 = c.sections
            this.stud = c.stud
         })
      },
      searchClass(value){
      	if(value.trim() != ''){
            this.isLoading2 = true
            value = value.replace(/\s/g, "_")
            this.$http.get('<?php echo base_url() ?>enrollment/searchClass/'+value+'/'+this.searchClass_opt)
            .then(response => {
               this.isLoading2 = false
               this.class_suggestions = response.body
            })
         }else{
            this.class_suggestions = []
         }
      },
      section_add(){
         this.loading_btn = true
         this.$http.get('<?php echo base_url() ?>enrollment/section_add/' + this.section.secID + '/' + this.selected_student.studID)
         .then(response => {
            this.loading_btn = false
            const c = response.body
            if(c == 'error'){
               swal("Section has no classes in this term!", {
                  icon: 'warning',
                })
            }else{
               this.status = 'Unenrolled'
               swal('Classes succesfully added!', {
                  icon: 'success',
                })
               this.classes = c
               this.section = null
            }
          });
      },
      addClass(){
         const t = this.status 
      	this.loading_btn = true
      	this.$http.post('<?php echo base_url() ?>enrollment/addClass', {classID: this.selected_class.classID, studID: this.selected_student.studID, status: t})
         .then(response => {
         	this.loading_btn = false
         	if(response.body == 'exist'){
         		swal("Unable to add", "Class already exist in student's class list", "error")
         	}else{
         		const x = this.selected_class
               if(t != 'Enrolled'){
                  this.status = 'Unenrolled'   
               }else{
                  this.close_evalModal()
               }
         		this.classes.push(x)
         		swal('Succesfully added '+x.classCode+'!', {
				      icon: 'success',
				    })
         		this.selected_class = null
         	}
         })
      },
      close_classModal(){
      	this.classModal = false
      	this.selected_class = null
      },
      remove(classID,subCode,index){
      	this.$http.get('<?php echo base_url() ?>enrollment/deleteClass/'+classID+'/'+this.selected_student.studID)
            .then(response => {
               this.classes.splice(index, 1)
               if(this.classes.length === 0){
                  this.status = 'Empty'
                  this.sections = this.sections2
                  this.section = null
               }
            })
      },
      evaluate(){
      	swal('Evaluating please wait ...',
      		{
      			button: false,
      			closeOnClickOutside: false
      		})
      	this.$http.post('<?php echo base_url() ?>enrollment/evaluate', {studID: this.selected_student.studID, classes: this.filtered_classes})
         .then(response => {
            swal.close()
            this.failed_classes = response.body
            this.evalModal = true
         })
      },
      close_evalModal(){
         this.evalModal = false
         this.failed_classes = []
      },
      is_failed_classes(classID,val){
         let x = ''
         let g = false
         if(this.classID_in_failed_classes.includes(classID)){
            x = 'fa fa-times has-text-danger'
            g = true
         }else{
            x = 'fa fa-check has-text-success'
         }
         if(val == 'icon'){
            return x
         }else{
            return g
         }
      },
      display_reason(classID){
         return this.failed_classes.filter((item) => item.classID == classID)
      },
      validate_pending_request(){
         if(this.failed_classes.length === 0){
            if(this.status != 'Enrolled'){
               this.set_pending()   
            }else{
               this.addClass()
            }
         }else{
            swal('Password required',{
              content: {
                  element: "input",
                  attributes:{
                     placeholder: 'Please enter password',
                     type: 'password'
                  }
              },
              buttons: true,
              icon: 'info'
            })
            .then((value) => {
               if(value != null){
                  this.$http.post('<?php echo base_url() ?>enrollment/password', {pw: value})
                  .then(response => {
                     if(response.body == 'success'){
                        if(this.status != 'Enrolled'){
                           this.set_pending()   
                        }else{
                           this.addClass()
                        }
                     }else{
                        swal('Invalid Password!', {
                           icon: 'error',
                        })
                     }
                  })
               }
               
            })
         }
      },
      set_pending(){
         this.$http.post('<?php echo base_url() ?>enrollment/set_pending', {studID: this.selected_student.studID})
         .then(response => {
            this.close_evalModal()
            this.status = 'Pending'
            swal('Student\'s status is set to pending', {
                  icon: 'success',
            })
         })
      },
      set_enrolled(){
         swal({
           title: "Confirm?",
           text: "Once confirmed, student will be enrolled in the term: "+this.term,
           icon: "warning",
           buttons: true,
         })
         .then((confirm) => {
           if(confirm) {
             this.$http.post('<?php echo base_url() ?>enrollment/set_enrolled', {studID: this.selected_student.studID})
            .then(response => {
               swal("Succesfully enrolled student! ", {
                  icon: "success",
                });
               this.status = 'Enrolled'
            })
           }
         })
      },
      cancel_pending(){
         swal({
           title: "Are you sure? ",
           icon: "warning",
           buttons: ['No','Yes']
         })
         .then((cancel) => {
           if(cancel) {
             this.$http.post('<?php echo base_url() ?>enrollment/cancel_pending', {studID: this.selected_student.studID})
            .then(response => {
               swal("Cancelled! ", {
                  icon: "success",
                });
               this.status = 'Unenrolled'
            })
           }
         });
      },
      change_enrolStatus(val){
         let message = ''
         if(val == 'inactive'){
            msg = "Once deactivated, selected classes for students who are not enrolled will be cleared!"
         }else if(val == 'active'){
            msg = "Status will be set to active and students can now enroll. Make sure to assign a faculty to evaluate students"
         }
         swal({
           title: "Are you sure?",
           text: msg,
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
             swal('Password required',{
              content: {
                  element: "input",
                  attributes:{
                     placeholder: 'Please enter password',
                     type: 'password'
                  }
              },
              buttons: true,
              icon: 'info'
            })
            .then((value) => {
               if(value != null){
                  this.$http.post('<?php echo base_url() ?>enrollment/password', {pw: value})
                  .then(response => {
                     if(response.body == 'success'){
                        this.change_enrolStatus2(val)
                     }else{
                        swal('Invalid Password!', {
                           icon: 'error',
                        })
                     }
                  })
               }
               
            })
           }
         })
      },

      change_enrolStatus2(val){
         this.$http.post('<?php echo base_url() ?>enrollment/change_enrolStatus', {status: val})
         .then(response => {
            let gs = 'activated'
            if(val == 'inactive'){
               gs = 'deactivated'
            }
            swal('Enrollment successfully '+gs+'!', {
               icon: 'success',
             }).then((x) => {
                window.location.href = '<?php echo base_url() ?>enrollment'
            })
          })
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

