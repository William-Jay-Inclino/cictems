<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
   .my-btn{
      width: 85px;
   }   
</style>


<div id="app" v-cloak>
   <section class="section">
      <div class="container">
        <h3 class="title is-3 my-title"> {{page_title}} </h3>
        <button @click="generateReport" class="button is-primary is-pulled-right" :disabled="!allow_generate">Generate Report</button>
        <br><br><br> 
         <div class="box">
            <div class="columns">
               <div class="column">
                  <label class="label">Current Term</label>
                   <div class="control">
                       <multiselect @input="changeTerm" v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
                   </div>   
               </div>
               <div class="column">
                  <label class="label">Filter</label>
                  <button @click="filter = 0" :class="{'button is-primary my-btn': true, 'is-outlined': filter != 0}">All</button>
                  <button @click="filter = 1" :class="{'button is-primary my-btn': true, 'is-outlined': filter != 1}">Subject</button>
                  <button @click="filter = 2" :class="{'button is-primary my-btn': true, 'is-outlined': filter != 2}">Instructor</button>   
               </div>
               <div class="column">
                <label class="label">Course</label>
                 <multiselect v-model="course" track-by="courseID" label="courseCode" :options="courses" :allow-empty="false"></multiselect>
               </div>
            </div>
         </div>

         <div v-if="ready">
          
          <div class="box">
            <div class="columns">
              <div class="column" v-if="filter == 2">
                <multiselect @input="get_subjects_of_instructor" v-model="faculty" label="name" track-by="facID" placeholder="Enter Instructor" :options="faculties">
               </multiselect>
              </div>
              <div class="column" v-if="filter == 2">
                <multiselect @input="get_students_per_fac" v-model="subject" label="subCode" track-by="subID" placeholder="Select subject" :options="subjects" :loading="isLoading2">
               </multiselect>
              </div>
              <div class="column is-half" v-if="filter == 1">
                <multiselect @input="get_students_per_sub" v-model="subject" label="subCode2" track-by="subID" placeholder="Enter subject code" :options="subjects" :loading="isLoading2" :internal-search="false" @search-change="fetchSubjects">
               </multiselect>
              </div>
            </div>
            <hr v-show="filter != 0">
            <h4 class="title is-4"> <span class="icon has-text-primary"> <i class="fa fa-users"></i> </span> Enrolled Students</h4>
            <hr>
            <table class="table is-fullwidth">
               <thead>
                <th>#</th>
                  <th>Control number</th>
                  <th>Name</th>
                  <th>Course</th>
                  <th>Yearlevel</th>
               </thead>
               <td colspan="5" class="has-text-centered" v-show="msg"> {{msg}} </td>
               <tbody>
                  <tr v-for="student, i in students2">
                    <td> {{++i}} </td>
                     <td>{{student.controlNo}}</td>
                     <td>{{student.name}}</td>
                     <td>{{student.courseCode}}</td>
                     <td>{{student.yearDesc}}</td>
                  </tr>
               </tbody>
            </table>
          </div>

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
    page_title: 'Student Reports',
      disabled_btnGen: false,
      filter: 0,
      loading: false,
      isLoading2: false,
      ready: true,
      term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
      course: {courseID: 'all', courseCode: 'All'},
      subject: null,
      faculty: null,
      terms: [],
      all_students: [],
      students: [],
      courses: [],
      subjects: [],
      faculties: [],
      total_records: 0

   },
   created(){  
      this.populate()
   },
   watch: {
    filter(val){
      this.subjects = []
      this.subject = null
      this.faculty = null
      if(val != 0){
        this.abled_btnGen = false
        this.students = []
      }
    }
   },
   computed: {
    allow_generate(){
      let ok = this.disabled_btnGen
      if(this.filter == 0){
        ok = true
      }else if(this.filter == 1 && this.subject){
        ok = true
      }else if(this.filter == 2 && this.subject && this.faculty){
        ok = true
      }
      return ok
    },
    msg(){
      let x = null
      if(!this.loading){
        if(this.students2.length == 0){
          x = 'No record found'
        }
      }else{
        x = 'Loading please wait...'
      }
      return x
    },
    students2(){
      const c = this.course 
      const s = (this.filter == 0) ? this.all_students : this.students 

      let students = []

      if(c.courseID == 'all'){
        students = s
      }else{
        for(let x of s){
          if(x.courseID == c.courseID){
            students.push(x)
          }
        }
      }
      return students
    }
   },
   methods: {
      generateReport(){
        swal('Info', "Report is based on your selections", 'info')
        .then(x => {
          if(x){
            let action = 'all-students'
            let course = this.course.courseID 
            const subject = (this.subject) ? this.subject.subID : 'no-subject'
            const instructor = (this.faculty) ? this.faculty.facID : 'no-instructor'

            if(this.filter == 1) action = 'per-subject' 
            if(this.filter == 2) action = 'per-instructor' 
            if(this.course.courseID == 'all') course = 'all-courses'

            const data = action + '/' + course + '/' + subject + '/' + instructor

            window.open('<?php echo base_url() ?>reports/student/download/'+ data, '_blank')
          }
        })
      },
      changeTerm(){
        this.filter = 0
        this.course = {courseID: 'all', courseCode: 'All'}
        this.populate()
      },
      populate(){
        this.loading = true
         this.$http.get('<?php echo base_url() ?>reports_student/populate/' + this.term.termID)
        .then(response => {
          this.loading = false
          const c = response.body
          this.terms = c.terms 
          this.faculties = c.faculties
          this.students = c.students
          this.all_students = c.students
          this.courses = c.courses
          this.courses.unshift({courseID: 'all', courseCode: 'All'})
          this.total_records = c.total_rows
        }, e => {
          console.log(e.body)

        })
      },
      fetchSubjects(value){
        if(value.trim() != ''){
            this.isLoading2 = true
            value = value.replace(/\s/g, "_")
            this.$http.get('<?php echo base_url() ?>reports_student/fetchSubjects/'+value)
            .then(response => {
               this.isLoading2 = false
               this.subjects = response.body.map(x => {
                x.subCode2 = (x.type == 'lab') ? x.subCode + ' (lab)' : x.subCode
                return x
               })
               console.log(this.subjects)
            })
        }
      },
      get_students_per_sub(){
        if(this.subject){
          this.loading = true
          this.$http.get('<?php echo base_url() ?>reports_student/get_students_per_sub/'+this.term.termID+'/'+this.subject.subID)
          .then(response => {
            this.loading = false
             this.students = response.body
          })  
        }else{
          this.students = []
        }  
      },
      get_subjects_of_instructor(){
        if(this.faculty){
          this.isLoading2 = true
          this.$http.get('<?php echo base_url() ?>reports_student/get_subjects_of_instructor/'+this.term.termID+'/'+this.faculty.facID)
          .then(response => {
            this.isLoading2 = false
             this.subjects = response.body
          }, e => {
            console.log(e.body)

          })  
        }else{
          this.subjects = []
          this.subject = null
          this.students = []
        } 
      },
      get_students_per_fac(){
        if(this.faculty && this.subject){
          this.loading = true
          this.$http.get('<?php echo base_url() ?>reports_student/get_students_per_fac/'+this.term.termID+'/'+this.subject.subID+'/'+this.faculty.facID)
          .then(response => {
            this.loading = false
             this.students = response.body
          })  
        }else{
          this.students = []
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
