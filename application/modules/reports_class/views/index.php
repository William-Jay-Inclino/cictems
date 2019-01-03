<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
  .btn-width{
    width: 80px;
  }
</style>

<div id="app" v-cloak>
   <section class="section">
      <div class="container">
        <h3 class="title is-3 my-title"> {{page_title}} </h3>
        <a :href="'<?php echo base_url() ?>reports/class/download/' + term.termID" target="_blank" class="button is-primary is-pulled-right">Generate Report</a>
        <br><br>
        <button @click="filter = 'class'" :class="{'button is-primary btn-width': true, 'is-outlined': filter != 'class'}">Class</button>
        <button @click="filter = 'room'" :class="{'button is-primary btn-width': true, 'is-outlined': filter != 'room'}">Room</button>
        <button @click="filter = 'faculty'" :class="{'button is-primary btn-width': true, 'is-outlined': filter != 'faculty'}">Faculty</button>
        <br><br>
        <div class="box">
          <div class="columns">
            <div class="column">
              <label class="label">Current Term</label>
              <div class="control">
                <multiselect v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false" @input="fetch_class_list"></multiselect>
              </div>
            </div>
            <div v-show="filter == 'class'" class="column">
              <label class="label">Filter Course</label>
              <div class="control">
                <multiselect v-model="course" track-by="courseID" label="courseCode" :options="courses" :allow-empty="false"></multiselect>
              </div>
            </div>
            <div v-show="filter == 'room'" class="column">
              <label class="label">Filter Room</label>
              <div class="control">
                <multiselect v-model="room" track-by="roomID" label="roomName" :options="rooms" :allow-empty="false"></multiselect>
              </div>
            </div>
            <div v-show="filter == 'faculty'" class="column">
              <label class="label">Filter Faculty</label>
              <div class="control">
                <multiselect v-model="faculty" track-by="facID" label="faculty" :options="faculties" :allow-empty="false"></multiselect>
              </div>
            </div>
          </div>
        </div>
          <div v-show="loader" class="loader"></div>
         <div v-show="!loader">
            <div v-show="filter == 'faculty'">
              <div class="box">
                <h6 class="title is-6" v-if="faculty"><span class="has-text-primary">FACULTY:</span> {{faculty.faculty}}</h6>
                <hr>
                <table class="table is-fullwidth">
                  <thead>
                    <th>Course Code</th>
                    <th>Course Description</th>
                    <th>Days</th>
                    <th>Time</th>
                    <th>Room</th>
                  </thead>
                  <tbody>
                    <tr v-for="x of class_schedules">
                       <td> {{x.classCode}} <span v-if="x.type == 'lab'"><b>(lab)</b></span> </td>
                       <td> {{x.subDesc}} </td>
                       <td> {{x.day}} </td>
                       <td> {{x.class_time}} </td>
                       <td> {{x.roomName}} </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div v-show="filter == 'room'">
              <div class="box">
                <h6 class="title is-6" v-if="room"><span class="has-text-primary">ROOM:</span> {{room.roomName}}</h6>
                <hr>
                <table class="table is-fullwidth">
                  <thead>
                    <th>Course Code</th>
                    <th>Course Description</th>
                    <th>Days</th>
                    <th>Time</th>
                    <th>Instructor</th>
                  </thead>
                  <tbody>
                    <tr v-for="x of class_schedules">
                       <td> {{x.classCode}} <span v-if="x.type == 'lab'"><b>(lab)</b></span> </td>
                       <td> {{x.subDesc}} </td>
                       <td> {{x.day}} </td>
                       <td> {{x.class_time}} </td>
                       <td> {{x.faculty}} </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div v-show="filter == 'class'" v-for="c of class_schedules">
               <div class="box">
                  <h6 class="title is-6"><span class="has-text-primary">SECTION:</span> {{c.secName}}</h6>
                  <hr>
                  <table class="table is-fullwidth">
                     <thead>
                        <th width="15%">Course Code</th>
                        <th width="20%">Course Description</th>
                        <th width="10%">Days</th>
                        <th width="20%">Time</th>
                        <th width="15%">Room</th>
                        <th width="20%">Instructor</th>
                     </thead>
                     <tbody>
                        <tr v-for="x of c.classes">
                           <td> {{x.classCode}} <span v-if="x.type == 'lab'"><b>(lab)</b></span> </td>
                           <td> {{x.subDesc}} </td>
                           <td> {{x.day}} </td>
                           <td> {{x.class_time}} </td>
                           <td> {{x.roomName}} </td>
                           <td> {{x.faculty}} </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <br>
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
      page_title: 'Class Schedules',
      loader: true,
      term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
      terms: [],
      class_list: [],
      course: {courseID: 'all', courseCode: 'All'},
      room: null,
      faculty: null,
      courses: [],
      has_data: true,
      filter: 'class',
   },
   created(){  
    this.populate()
   },
   computed: {
    class_schedules(){
      if(this.filter == 'class'){
        if(this.course.courseID == 'all'){
          return this.class_list
        }else{
          return this.class_list.filter(x => this.course.courseID == x.courseID)
        }
      }else if(this.filter == 'room'){
        const arr = []
        if(this.room){
          const class_lists = this.class_list 
          for(const classes of class_lists){
            for(const c of classes.classes){
              if(c.roomID == this.room.roomID){
                arr.push(c)  
              }
            }
          }
        }
        return arr
      }else if(this.filter == 'faculty'){
        const arr = []
        if(this.faculty){
          const class_lists = this.class_list 
          for(const classes of class_lists){
            for(const c of classes.classes){
              if(c.facID == this.faculty.facID){
                arr.push(c)  
              }
            }
          }
        }
        return arr
      }
      
    },
    rooms(){
      const arr = []
      const class_lists = this.class_list
      for(const classes of class_lists){
        for(const c of classes.classes){
          if(!arr.find(r => r.roomID == c.roomID)){
            arr.push({
              roomID: c.roomID,
              roomName: (c.roomID == 0) ? 'Unassigned' : c.roomName
            })  
          }
        }
      }
      return arr
    },
    faculties(){
      const arr = []
      const class_lists = this.class_list
      for(const classes of class_lists){
        for(const c of classes.classes){
          if(!arr.find(r => r.facID == c.facID)){
            arr.push({
              facID: c.facID,
              faculty: (c.facID == 0) ? 'Unassigned' : c.faculty
            })  
          }
        }
      }
      return arr
    }
   },
   methods: {
      populate(){
         this.$http.get('<?php echo base_url() ?>reports_class/populate')
        .then(response => {
          const c = response.body
          this.terms = c.terms 
          this.courses = c.courses
          this.courses.unshift({
            courseID: 'all',
            courseCode: 'All'
          })
          this.class_list = c.class_list
          this.loader = false
        })
      },
      fetch_class_list(){
         this.loader = true
         this.$http.get('<?php echo base_url() ?>reports_class/get_class_list/' + this.term.termID)
           .then(response => {
             this.class_list = response.body
             this.loader = false
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

