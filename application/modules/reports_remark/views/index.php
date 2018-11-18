<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
  .my-width{
    width: 80px;
  }
</style>
<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Remark 
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
        <button :class="{'button is-primary my-width': true, 'is-outlined': filter != 'student'}" @click="filter = 'student'">Student</button>
        <button :class="{'button is-primary my-width': true, 'is-outlined': filter != 'course'}" @click="filter = 'course'">Course</button>
        <button :class="{'button is-primary my-width': true, 'is-outlined': filter != 'class'}" @click="filter = 'class'">Class</button>
        <br><br>
        <div class="box">
          <div class="columns">
            <div class="column">
              <label class="label">Select remark</label>
              <div class="control">
                <multiselect v-model="remark" track-by="remarkID" label="remarkDesc" :options="remarks" :allow-empty="false"></multiselect>
              </div>
            </div>
            <div class="column">
              <label class="label">Current Term</label>
                 <div class="control">
                    <multiselect v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
                 </div>
            </div>
            <div class="column" v-if="filter == 'course'">
              <label class="label">Select course</label>
                <div class="control">
                    <multiselect v-model="course" track-by="courseID" label="courseCode" :options="courses" :allow-empty="false"></multiselect>
                </div>
            </div>
          </div>
        </div>
        <div v-show="loader" class="loader"></div>

        <div class="box" v-if="filter == 'student' || filter == 'course'">
          <h5 class="title is-5"> {{remark.remarkDesc}} students </h5>
          <hr>
          <table class="table is-fullwidth is-centered">
            <thead>
              <th width="5%">#</th>
              <th width="20%">Control number</th>
              <th width="25%">Name</th>
              <th width="25%">Course</th>
              <th width="25%">Yearlevel</th>
            </thead>
            <tbody>
              <tr v-for="student, i in students">
                <td> {{++i}} </td>
                <td>{{student.controlNo}}</td>
                <td>{{student.name}}</td>
                <td>{{student.courseCode}}</td>
                <td>{{student.yearDesc}}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-else>
          <h5 class="title is-5"> Classes that has {{remark.remarkDesc}} students </h5>
          <div class="box" v-for="c, i in classes">
            <table class="table is-fullwidth is-centered is-bordered">
              <thead>
                <th>Class Code</th>
                <th>Description</th>
                <th>Day</th>
                <th>Time</th>
                <th>Room</th>
                <th>Instructor</th>
                <th>Section</th>
              </thead>
              <tbody>
                <tr>
                  <td>{{c.class.classCode}}</td>
                  <td>{{c.class.subDesc}}</td>
                  <td>{{c.class.day}}</td>
                  <td>{{c.class.class_time}}</td>
                  <td>{{c.class.roomName}}</td>
                  <td>{{c.class.faculty}}</td>
                  <td>{{c.class.secName}}</td>
                </tr>
              </tbody>
            </table>
            <table class="table">
              <tbody>
                <tr v-for="student, i of c.students">
                  <td>{{++i}}</td>
                  <td>{{student.name}}</td>
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
    loader: true,
    filter: 'student',
    term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
    course: null,
    terms: [],

    remark: {remarkID: 'Incomplete', remarkDesc: 'Incomplete'},
    remarks: [
              {remarkID: 'Incomplete', remarkDesc: 'Incomplete'},
              {remarkID: 'Dropped', remarkDesc: 'Dropped'},
              {remarkID: 'Failed', remarkDesc: 'Failed'}
            ],
    students: [],
    courses: [],
    classes: []
   },
   created(){  
      this.fetchTerm()
      this.fetchStudents()
      this.fetchCourses()
   },


   watch: {
      term(){
        this.runFilter()
      },
      remark(){
        this.runFilter()
      },
      course(){
        this.runFilter()
      },
      filter(){
        this.runFilter()
      }
   },
   methods: {
      runFilter(){
        const f = this.filter
        if(f == 'student'){
          this.fetchStudents()  
          this.course = this.courses[0]
        }else if(f == 'course'){
          this.fetchStudents_by_course()
        }else if(f == 'class'){
          this.fetchClass()
          this.course = this.courses[0]
        }
        this.loader = false
      },
      fetchTerm() {
        this.$http.get('<?php echo base_url() ?>reusable/get_all_term')
        .then(response => {
          this.terms = response.body
        })
      },
      fetchCourses(){
        this.$http.get('<?php echo base_url() ?>reports_remark/fetchCourses')
        .then(response => {
          const c = response.body
          this.courses = c
          this.course = c[0]
        })
      },
      fetchStudents() {
        this.$http.get('<?php echo base_url() ?>reports_remark/fetchStudents/'+this.term.termID+'/'+this.remark.remarkID)
        .then(response => {
          this.students = response.body
        })
      },
      fetchStudents_by_course(){
        this.$http.get('<?php echo base_url() ?>reports_remark/fetchStudents_by_course/'+this.term.termID+'/'+this.remark.remarkID+'/'+this.course.courseID)
        .then(response => {
          this.students = response.body
        })
      },
      fetchClass(){
        this.$http.get('<?php echo base_url() ?>reports_remark/fetchClass/'+this.term.termID+'/'+this.remark.remarkID)
        .then(response => {
          this.classes = response.body
          console.log(response.body)
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

