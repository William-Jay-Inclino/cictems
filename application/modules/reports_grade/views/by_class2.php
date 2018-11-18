<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
   .btn-width{
      width: 90px;
   }
   .tbl-headers{
      background-color: #f2f2f2 
   }
   td .cCode-style{
      background-color: white;
      text-align: center; 
      vertical-align: middle;
   }
</style>

<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Grade 
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
         <div class="box columns bg-white">
            <div class="column is-half">
               <div class="field">
                  <label class="label">Search student:</label>
                  <div class="control">
                     <multiselect v-model="selected_student" label="student" track-by="studID" placeholder="Enter name / control no" :options="suggestions" :loading="isLoading" :internal-search="false" @search-change="search">
                     </multiselect>
                  </div>
                  <br>
               </div>
            </div>
            <div class="column" v-if="ready">
               <div class="is-pulled-right">
                  <label class="label">Filter by:</label>
                  <a :href="'<?php echo base_url() ?>reports/grade/' + studID" class="button is-info is-outlined btn-width">Prospectus</a>
                  <button class="button is-info btn-width">Class</button>
               </div>
               <br>
               <br>
               <br>
            </div>
         </div>
         
         <div v-show="loader" class="loader"></div>

         <div v-show="!loader && ready">
            <div class="box" v-for="c of classes">
               <h6 class="title is-6">
                  {{ c.term }}
               </h6>
               <hr>
               
               <table class="table is-fullwidth is-bordered" v-for="cc of c.class2">
                  <tr class="tbl-headers">
                     <th width="15%" rowspan="5" style="text-align: center; vertical-align: middle; background-color: white">{{cc.class.classCode}}</th>
                     <th width="20%">Description</th>
                     <th width="10%">Day</th>
                     <th width="20%">Time</th>
                     <th width="15%">Room</th>
                     <th width="20%">Instructor</th>
                  </tr>
                  <tr>
                     <td> {{cc.class.subDesc}} </td>
                     <td> {{cc.class.day}} </td>
                     <td> {{cc.class.class_time}} </td>
                     <td> {{cc.class.roomName}} </td>
                     <td> {{cc.class.faculty}} </td>
                  </tr>
                  <tr class="tbl-headers">
                     <th>Prelim</th>
                     <th>Midterm</th>
                     <th>Prefi</th>
                     <th>Finals</th>
                     <th>FG</th>
                  </tr>
                  <tr>
                     <td> {{cc.class.prelim}} </td>
                     <td> {{cc.class.midterm}} </td>
                     <td> {{cc.class.prefi}} </td>
                     <td> {{cc.class.final}} </td>
                     <td> {{cc.class.finalgrade}} </td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <th>Equivalent: {{cc.equiv}} </th>
                     <th>Remarks: {{cc.class.remarks}} </th>
                  </tr>
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
      loader: false,
      studID: '<?php echo $studID ?>',
      ready: false,
      isLoading: false,
      selected_student: null,
      suggestions: [],

      classes: []
   },
   created(){  
      this.get_student()
   },


   watch: {
      selected_student(val){
         if(val === null){
            this.ready = false
         }else{
            this.get_class_grade()
         }
      }
   },

   computed: {


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
         }
      },
      get_class_grade(){
         this.loader = true
         this.$http.get('<?php echo base_url() ?>reports_grade/get_grade_by_class/'+this.selected_student.studID)
         .then(response => {
            const c = response.body
            console.log(c)
            this.classes = response.body 
            this.loader = false
            this.ready = true
         })
      },
      get_student(){
         this.isLoading = true
         this.$http.get('<?php echo base_url() ?>reports_grade/get_student/'+this.studID)
         .then(response => {
            this.isLoading = false
            this.selected_student = response.body
         })
      },
   },


   http: {
      emulateJSON: true,
      emulateHTTP: true
   }

  })

}, false)


</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>

