<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Student 
      </h1>
      <h2 class="subtitle">
        Reports
      </h2>
    </div>
  </div>
</section>

<div id="app" v-cloak>
   <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column">
            <div class="field">
             <label class="label">Current Term</label>
             <div class="control">
                 <multiselect v-model="term" track-by="termID" label="term" :options="terms"></multiselect>
             </div>
           </div>
          </div>
          <div class="column">
            <div class="field">
             <label class="label">Filter Course</label>
             <div class="control">
                 <multiselect v-model="course" track-by="courseID" label="courseCode" :options="courses"></multiselect>
             </div>
           </div>
          </div>
        </div>
          <div v-show="loader" class="loader"></div>
         <br>
         <div v-show="!loader && ready">
          <h6 class="title is-6">Total number of students: {{total_count}}</h6>
          <h6></h6>
            <div v-for="s of student_list" class="box">
              <h6 class="title is-6"><span class="has-text-primary">COURSE:</span> {{s.courseCode}}</h6>
              <hr>
                  <table class="table is-fullwidth">
                     <thead>
                        <th width="25%">Control no</th>
                        <th width="25%">Lastname</th>
                        <th width="25%">Firstname</th>
                        <th width="25%">Middlename</th>
                     </thead>
                     <tbody>
                        <tr v-for="x of s.students">
                           <td> {{x.controlNo}} </td>
                           <td> {{x.ln}} </td>
                           <td> {{x.fn}} </td>
                           <td> {{x.mn}} </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <br>
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
    loader: false,
    ready: false,
    term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
    course: null,
    terms: [],
    student_list: [],
    courses: [],
    total_count: ''
   },
   created(){  
      this.populate()
      this.fetch_student_list()
   },
   watch: {
      term(){
         this.fetch_student_list()
      },
      course(){
         this.fetch_student_list()
      }
   },
   computed: {

   },
   methods: {
      populate() {
        this.$http.get('<?php echo base_url() ?>reports_student/populate')
        .then(response => {
          const c = response.body
          this.terms = c.terms 
          this.courses = c.courses
        })
      },
      fetch_student_list(){
        const t = this.term 
        const c = this.course
         if(t != null && c != null){
            this.loader = true
            this.$http.get('<?php echo base_url() ?>reports_student/get_student_list/' + t.termID + '/' + c.courseID)
              .then(response => {
               console.log(response.body)
               const c = response.body
                this.student_list = c.stud_list 
                this.total_count = c.total_count
                this.loader = false
                this.ready = true
            })
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

