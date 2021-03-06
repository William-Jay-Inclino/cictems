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
        <div class="is-pulled-right">
          <div :class="{'dropdown is-right': true, 'is-active': is_settings_open}">
           <div class="dropdown-trigger">
              <button @click="is_settings_open = !is_settings_open" class="button" aria-haspopup="true">
                <span class="icon has-text-primary">
                  <i class="fa fa-cog"></i>
                </span> &nbsp;
                Settings
              </button>
           </div>
           <div class="dropdown-menu" role="menu" style="min-width: 300px;">
              <form @submit.prevent="updateSettings" class="dropdown-content">
                <div class="dropdown-item">
                  <div class="field">
                     <label class="label">Date updated: </label>
                     <div class="control">
                        <input type="date" class="input" v-model.trim="updated_at" required>
                     </div>
                  </div>
               </div>
                <hr class="dropdown-divider">
                 <div class="dropdown-item">
                    <button type="submit" class="button is-primary is-fullwidth">Save</button>
                 </div>
              </form>
           </div>
        </div>
          <a :href="reportLink" target="_blank" class="button is-primary">Generate Report</a>  
        </div>
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
                    <th>Section</th>
                  </thead>
                  <tbody v-for="x of class_schedules">
                    <tr>
                       <td> {{x.classCode}} <span v-if="x.type == 'lab'"><b>(lab)</b></span> </td>
                       <td> {{x.subDesc}} </td>
                       <td> {{x.day}} </td>
                       <td> {{x.class_time}} </td>
                       <td>
                         <span v-if="x.roomID == 0" class="has-text-danger">
                           Unassigned
                         </span>
                         <span v-else>
                           {{x.roomName}}
                         </span>
                       </td>
                       <td> {{x.secName}} </td>
                    </tr>
                    <tr>
                      <td colspan="6" v-if="x.mergeClass" class="has-text-primary"> {{x.mergeClass}} </td>
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
                    <th>Section</th>
                  </thead>
                  <tbody v-for="x of class_schedules">
                    <tr>
                       <td> {{x.classCode}} <span v-if="x.type == 'lab'"><b>(lab)</b></span> </td>
                       <td> {{x.subDesc}} </td>
                       <td> {{x.day}} </td>
                       <td> {{x.class_time}} </td>
                       <td>
                         <span v-if="x.facID == 0" class="has-text-danger">
                           Unassigned
                         </span>
                         <span v-else>
                           {{x.ln + ',' + x.fn}}
                         </span>
                        </td>
                        <td> {{x.secName}} </td>
                    </tr>
                    <tr>
                      <td colspan="6" v-if="x.mergeClass" class="has-text-primary"> {{x.mergeClass}} </td>
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
                     <tbody v-for="x of c.classes">
                        <tr>
                           <td> 
                            {{x.classCode}} 
                            <span v-if="x.type == 'lab'">
                              <b>(lab)</b>
                            </span> 
                            </td>
                            <td>  {{x.subDesc}} </td>
                           <td> {{x.day}} </td>
                           <td> {{x.class_time}} </td>
                           <td>
                             <span v-if="x.roomID == 0" class="has-text-danger">
                               Unassigned
                             </span>
                             <span v-else>
                               {{x.roomName}}
                             </span>
                           </td>
                           <td>
                             <span v-if="x.facID == 0" class="has-text-danger">
                               Unassigned
                             </span>
                             <span v-else>
                               {{x.ln + ',' + x.fn}}
                             </span>
                           </td>
                        </tr>
                        <tr>
                          <td colspan="6" v-if="x.mergeClass" class="has-text-primary"> {{x.mergeClass}} </td>
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

      is_settings_open: false,
      updated_at: new Date('<?php echo $date_updated; ?>').toISOString().slice(0,10)
   },
   created(){  
    this.populate()
   },
   computed: {
    reportLink(){
      const link = '<?php echo base_url() ?>reports/class/'
      let x = 'download/class/'
      if(this.filter == 'room'){
        x = 'download/room/'
      }else if(this.filter == 'faculty'){
        x = 'download/faculty/'
      }
      return link + x + this.term.termID
    },
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
              faculty: (c.facID == 0) ? 'Unassigned' : c.ln + ', ' + c.fn
            })  
          }
        }
      }
      return arr
    }
   },
   methods: {
    updateSettings(){
      swal('Success', 'Settings successfully updated!', 'success')
      this.is_settings_open = false
      this.$http.post('<?php echo base_url() ?>reports_class/updateSettings', {termID: this.term.termID, updated_at: this.updated_at})
       .then(res => {
        console.log(res.body)
     }, e => {
      console.log(e.body);

     })
    },
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

        for(let cc of c.class_list){
          for(let x of cc.classes){
            if(x.class_time == '12:00AM-12:00AM'){
              x.class_time = ''
            }
          }
        }
        this.class_list = c.class_list
        this.loader = false
      })
    },
    fetch_class_list(){
       this.loader = true
       this.$http.get('<?php echo base_url() ?>reports_class/get_class_list/' + this.term.termID)
         .then(response => {
          const c = response.body
          console.log(c);
           this.class_list = c.classes
           this.updated_at = new Date(c.updated_at).toISOString().slice(0,10)
           this.loader = false
       }, e => {
        console.log(e.body)

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
