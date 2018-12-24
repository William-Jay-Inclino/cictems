<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<style>
   .btn-width{
      width: 90px;
   }
   .tbl-headers{
      background-color: #f2f2f2 
   }
   /*.table{
      table-layout: fixed;
   }*/
   .row-5{
      width: 5%;
   }
   .row-10{
      width: 5%;
   }
   .row-15{
      width: 15%;
   }
   .row-20{
      width: 20%;
   }
   td .cCode-style{
      background-color: white;
      text-align: center; 
      vertical-align: middle;
   }
   .table__wrapper {
  overflow-x: auto;
}
</style>

<div id="app" v-cloak>
   <section class="section">
      <div class="container">
         <h3 class="title is-3 my-title"> {{page_title}} </h3> <br>

         <div v-if="selected_student">
            <a :href="'<?php echo base_url() ?>reports/grade/download-by-class/' + selected_student.studID" target="_blank" class="button is-primary is-pulled-right">Generate Report</a>
            <br><br>
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
                     <br>
                  </div>
               </div>
               <div class="column" v-if="ready">
                  <div class="is-pulled-right">
                     <label class="label">Filter by:</label>
                     <a :href="'<?php echo base_url() ?>reports/grade/' + selected_student.studID" class="button is-info btn-width is-outlined">Prospectus</a>
                     <a href="javascript:void(0)" class="button is-info btn-width">Class</a>
                  </div>
               </div>
            </div>
         </div>
         
         <div v-show="loader" class="loader"></div>

         <div v-show="!loader && ready">
            <div class="box" v-for="c of classes">
               <h6 class="title is-6">
                  {{ c.term }}
               </h6>
               <hr>
               <div class="table__wrapper">
                  <table class="table is-fullwidth is-bordered">
                     <tr class="tbl-headers">
                        <th>Code</th>
                        <th>Description</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Instructor</th>
                        <th class="row-5">PR</th>
                        <th class="row-5">MD</th>
                        <th class="row-5">SF</th>
                        <th class="row-5">F</th>
                        <th class="row-5">FG</th>
                        <th class="row-5">Equiv</th>
                        <th class="row-10">Remarks</th>
                     </tr>
                     <tr v-for="cc of c.class2">
                        <td>{{cc.class.classCode}} <span v-if="cc.class.type == 'lab'"><b>(lab)</b></span> </td>
                        <td> {{cc.class.subDesc}} </td>
                        <td> {{cc.class.day}} </td>
                        <td> {{cc.class.class_time}} </td>
                        <td> {{cc.class.roomName}} </td>
                        <td> {{cc.class.faculty}} </td>
                        <td> {{cc.class.prelim}} </td>
                        <td> {{cc.class.midterm}} </td>
                        <td> {{cc.class.prefi}} </td>
                        <td> {{cc.class.final}} </td>
                        <td> {{cc.class.finalgrade}} </td>
                        <td> {{cc.equiv}} </td>
                        <td> {{cc.class.remarks}} </td>
                     </tr>
                  </table>
               </div>
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
      page_title: 'Grade Reports',
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
            // for(x of c){
            //    for(i of x.class2){
            //       // if(i.equiv == '' && i.class.remarks != 'Incomplete'){
            //       //    i.equiv = '5.0'
            //       // }
            //       if(i.prelim == 'INC' || i.midterm == 'INC' || i.prefi == 'INC' || i.final == 'INC'){
            //          i.equiv = ''
            //       }
            //    }
            // }
            this.classes = c
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

