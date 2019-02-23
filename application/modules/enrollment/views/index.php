<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<div id="app" v-cloak>
   <div class="container" v-if="selected_student == null" style="margin-top: 50px">
      <h3 class="title is-3 my-title"> {{page_title}} </h3>
      <?php 
         if($roleID == 1){ 
               if($status == 'active'){ ?>
                  <button class="button is-danger is-large is-outlined" v-on:click="change_enrolStatus('inactive')">Deactivate</button>
                  <button class="button is-success is-large">Activated</button>
                  <?php
               }else{ ?>
                  <button class="button is-danger is-large">Inactive</button>
                  <button class="button is-success is-large is-outlined" v-on:click="change_enrolStatus('active')">Activate</button>
                  <?php
               }
         }
      ?>
   </div>
      <?php
      if($status == 'active'){ ?>
      
         <section class="section">
            <div class="container">
               <div class="columns">
                  <div class="column">
                  <?php 
                     if(in_array('20', $user_access) || $roleID == 1){ ?>
                        <a v-show="ready" :href="grade_link" class="button is-primary" target="_blank">View grades</a>
                        <?php
                     }
                     if(in_array('14', $user_access) || $roleID == 1){ ?>
                        <a v-show="ready" :href="profile_link" class="button is-primary" target="_blank">View profile</a>
                        <?php
                     }
                  ?>
                  </div>
               </div>
               <div class="box">
                  <div class="columns">
                     <div class="column is-half">
                        <div class="field">
                           <label class="label">Search student:</label>
                           <div class="control">
                              <multiselect v-model="selected_student" label="student" track-by="studID" placeholder="Enter name / control no" :options="suggestions" :loading="isLoading" :internal-search="false" @search-change="search">
                              </multiselect>
                           </div>
                           <p class="help" v-if="ready">
                              Status: <span :class="statusClass">{{status2}}</span>
                           </p>
                        </div>
                     </div>
                        <div class="column" v-if="stud != null && ready">
                           <label class="label">Prospectus</label>
                           <multiselect @input="stud_year = null " :show-labels="false" v-model="stud_pros" label="prosCode" track-by="prosID" :options="prospectuses" :allow-empty="false"></multiselect>
                        </div>
                        <div class="column" v-if="stud != null && ready">
                           <label class="label">Yearlevel</label>
                           <multiselect @input="updateStudent" :show-labels="false" v-model="stud_year" label="yearDesc" track-by="yearID" :options="years2" :allow-empty="false"></multiselect>
                        </div>
                  </div>
               </div>
               <div v-show="ready">
                  <div class="field has-addons" v-show="status == 'Empty'">
                     <div class="control" style="width: 25%">
                        <multiselect v-model="section" track-by="secID" label="secName" :options="displayed_sections" placeholder="Select Section"></multiselect>
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
                           <th style="text-align: left">Class Code</th>
                           <th style="text-align: left">Description</th>
                           <th>Units</th>
                           <th>Days</th>
                           <th>Time</th>
                           <th v-if="status == 'Unenrolled'">Remove</th>
                        </thead>
                        <tbody>
                           <tr v-for="record, i in classes">
                              <td style="text-align: left">{{record.classCode}} <span v-if="record.type == 'lab'"><b>(lab)</b></span> </td>
                              <td style="text-align: left">{{record.subDesc}}</td>
                              <td> {{record.units}} </td>
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
                              <th>{{ tot_units }}</th>
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
               <div class="field">
                  <label class="label">Select section</label>
                  <div class="control">
                     <multiselect @input="get_classes" v-model="active_section" track-by="secID" label="secName" :options="active_sections" placeholder=""></multiselect>   
                  </div>
               </div>
               <div class="field">
                  <label class="label">Enter class code</label>
                  <div class="control">
                     <multiselect open-direction="bottom" v-model="selected_class" label="codelabel" track-by="classID" placeholder="" :options="class_suggestions" :loading="isLoading2">
                     </multiselect>      
                  </div>
               </div>
               <div v-if="selected_class != null">
                  <hr>
                  <table class="table is-fullwidth">
                     <tr>
                        <td><b>Description: </b></td>
                        <td> {{selected_class.subDesc}} </td>
                        <td><b>Faculty: </b></td>
                        <td> {{ selected_class.faculty }} </td>
                     </tr>
                     <tr>
                        <td><b>Days: </b></td>
                        <td> {{ selected_class.day }} </td>
                        <td><b>Room: </b></td>
                        <td> {{ selected_class.roomName }} </td>
                     </tr>
                     <tr>
                        <td><b>Time: </b></td>
                        <td> {{ selected_class.class_time }} </td>
                        <td><b>Units: </b></td>
                        <td> {{ selected_class.units }} </td>
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
      page_title: 'Enrolment',
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
      active_sections: [],
      active_section: null,

      years: [],
      prospectuses: [],
      stud_pros: null,
      stud_year: null
    },   
    created(){
      this.populate()
      //this.get_sections()
    },
    watch: {
      selected_student(value){
         this.section = null
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
      years2(){
         if(this.stud_pros){
            return this.years.filter(y => y.duration <= this.stud_pros.duration)   
         }
         
      },
      grade_link(){
         const x = this.selected_student
         if(x != null){
            return this.link + x.studID
         }
      },
      profile_link(){
         const x = this.selected_student
         if(x != null){
            return '<?php echo base_url() ?>/users/student/show/' + x.studID
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
      tot_units(){
         const a = this.classes
         let tot = 0
         for(x of a){
            tot += Number(x.units)
         }
         return tot
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
      },
      displayed_sections(){
         if(this.stud_year && this.stud_pros){
            return this.active_sections.filter(s => s.yearID == this.stud_year.yearID && s.courseID == this.stud_pros.courseID)
         }else{
            return []
         }
      },
      not_enrol_both_subs(){
         const fc = this.failed_classes
         for(let x of fc){
            for(let y of x.reason){
               if(y == 'Student must enroll both lec and lab in this subject'){
                  return false
               }
            }
         }
         return true
      }
    },
    methods: {
      updateStudent(){
         this.section = null
         swal('Success', "Student's yearlevel & prospectus succesfully updated!", 'success')

         this.$http.post('<?php echo base_url() ?>enrollment/updateStudent',{
            studID: this.selected_student.studID,
            prosID: this.stud_pros.prosID,
            yearID: this.stud_year.yearID
         })
         .then(res => {
            //console.log(res.body)

         }, e => {
            console.log(e.body)

         })
      },
      populate(){
         this.$http.get('<?php echo base_url() ?>enrollment/populate')
         .then(response => {
            const c = response.body
            this.active_sections = c.sections
            this.years = c.years
            this.prospectuses = c.prospectuses
         }, e => {
            console.log(e.body)

         })
      },
      get_classes(){
         this.class_suggestions = []
         this.selected_class = null
         const section = this.active_section
         if(section){
            this.isLoading2 = true
            this.$http.get('<?php echo base_url() ?>enrollment/get_classes/'+section.secID)
            .then(response => {
               this.isLoading2 = false
               this.class_suggestions = response.body.map(g => {
                  g.codelabel = (g.type == 'lab') ? g.classCode +' (' + g.type + ')' : g.classCode
                  return g
               })
            }, e => {
               console.log(e.body)

            })   
         }
      },
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
            this.status = c.status
            if(c.status != 'Empty'){
            	this.classes = c.data
            }else{
               this.sections = this.displayed_sections
            }
            this.sections2 = this.displayed_sections
            this.stud = c.stud
            this.stud_pros = {prosID: c.stud.prosID, prosCode: c.stud.prosCode, duration: c.stud.duration, courseID: c.stud.courseID}
            this.stud_year = {yearID: c.stud.yearID, yearDesc: c.stud.yearDesc}
         }, e => {
            console.log(e.body);

         })
      },
      section_add(){
         this.loading_btn = true
         this.$http.get('<?php echo base_url() ?>enrollment/section_add/' + this.section.secID + '/' + this.selected_student.studID)
         .then(response => {
            this.loading_btn = false
            const c = response.body
            console.log(c);
            if(c == 'error'){
               swal("Section has no classes in this term!", {
                  icon: 'error',
                })
            }else if(c == 'error1'){
               swal("Student data does not match section data. Page will auto refresh", {
                  icon: 'warning',
                })
               .then(x => {
                  window.location.href = "<?php echo base_url() ?>enrollment"
               })
            }else{
               this.status = 'Unenrolled'
               swal('Classes succesfully added!', {
                  icon: 'success',
                })
               this.classes = c
               this.section = null
            }
          }, e => {
            console.log(e.body);

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
               this.active_section = null 
               this.class_suggestions = []
         	}
         })
      },
      close_classModal(){
      	this.classModal = false
      	this.selected_class = null
         this.class_suggestions = []
         this.active_section = null
      },
      remove(classID,subCode,index){
         this.classes.splice(index, 1)
         if(this.classes.length === 0){
            this.status = 'Empty'
            this.sections = this.sections2
            this.section = null
         }
      	this.$http.get('<?php echo base_url() ?>enrollment/deleteClass/'+classID+'/'+this.selected_student.studID)
            .then(response => {
               // console.log(response.body);
               
            }, e => {
               console.log(e.body);

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
            console.log(response.body);
            swal.close()
            this.failed_classes = response.body
            this.evalModal = true
         }, e => {
            console.log(e.body);

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
            if(!this.not_enrol_both_subs){
               swal('Error', "Please enroll both subjects in the evaluation form!", 'error')
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
            
         }
      },
      set_pending(){
         this.$http.post('<?php echo base_url() ?>enrollment/set_pending', {studID: this.selected_student.studID})
         .then(response => {
            if(response.body == 'success'){
               this.close_evalModal()
               this.status = 'Pending'
               swal('Student\'s status is set to pending', {
                     icon: 'success',
               })   
            }else{
               swal("Ooops!", response.body, 'error')
            }
            
         }, e => {
            console.log(e.body)

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
               // if(response.body == 'success'){
               //    swal("Succesfully enrolled student! ", {
               //       icon: "success",
               //     });
               //    this.status = 'Enrolled'
               // }else{
               //    swal("Ooops!", response.body, 'error')
               // }
            }, e => {
               console.log(e.body);

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

