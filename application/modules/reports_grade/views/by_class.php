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
   .table__wrapper {
  overflow-x: auto;
}
</style>

<div id="app" v-cloak>
   <section class="section">
      <div class="container">
         <h3 class="title is-3 my-title"> {{page_title}} </h3> <br>
        <button :disabled="!selected_student" @click="generateReport" class="button is-primary is-pulled-right">Generate Report</button>
         <br><br>
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
            
            <div class="columns">
              <div class="column is-half">
                <multiselect @input="get_class_grade" v-model="term" label="term" track-by="termID" :options="terms" :allow-empty="false">
                </multiselect>
              </div>
            </div>

            <div class="box">
               <div class="table__wrapper">
                  <table class="table is-fullwidth is-bordered is-centered">
                     <tr class="tbl-headers">
                        <th class="row-10" style="text-align: left">Code</th>
                          <th class="row-10" style="text-align: left">Description</th>
                          <th class="row-10" style="text-align: left">Instructor</th>
                          <th class="row-5">PR</th>
                          <th class="row-5">MD</th>
                          <th class="row-5">SF</th>
                          <th class="row-5">F</th>
                          <th class="row-5">FG</th>
                          <th class="row-5">Equiv</th>
                          <th class="row-10">Remarks</th>
                     </tr>
                     <tr v-for="cc of classes">
                        <td style="text-align: left">{{cc.class.classCode}} <span v-if="cc.class.type == 'lab'"><b>(lab)</b></span> </td>
                        <td style="text-align: left"> {{cc.class.subDesc}} </td>
                        <td style="text-align: left">
                           <span v-if="cc.class.facID == 0" class="has-text-danger">
                              Unassigned
                           </span>
                           <span v-else>
                              {{cc.class.faculty}}
                           </span>
                        </td>
                        <td> {{cc.class.prelim}} </td>
                        <td> {{cc.class.midterm}} </td>
                        <td> {{cc.class.prefi}} </td>
                        <td> {{cc.class.final}} </td>
                        <td> {{cc.class.finalgrade}} </td>
                        <td> {{cc.equiv}} </td>
                        <td>
                           <span v-if="cc.class.remarks == 'Incomplete'">
                              INC
                           </span>
                           <span v-else>
                              {{cc.class.remarks}}
                           </span>
                        </td>
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
      btnGenerate_link: '<?php echo base_url() ?>reports/grade/download-by-class/',
      page_title: 'Grade Reports',
      loader: false,
      studID: '<?php echo $studID ?>',
      ready: false,
      isLoading: false,
      selected_student: null,
      suggestions: [],
      classes: [],

      term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
      terms: []
   },
   created(){  
      this.get_student()
      this.get_terms()
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
         this.$http.get('<?php echo base_url() ?>reports_grade/get_grade_by_class/'+this.selected_student.studID+'/'+this.term.termID)
         .then(response => {
            const c = response.body
            console.log(c);
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
            this.classes = c.class
            this.loader = false
            this.ready = true
         }, e => {
            console.log(e.body);

         })
      },
      get_student(){
         this.isLoading = true
         this.$http.get('<?php echo base_url() ?>reports_grade/get_student/'+this.studID)
         .then(response => {
            this.isLoading = false
            this.selected_student = response.body
         }, e => {
          console.log(e.body);

         })
      },
      get_terms(){
         this.isLoading = true
         this.$http.get('<?php echo base_url() ?>reusable/get_all_term')
         .then(response => {
            this.terms = response.body
         })
      },
      generateReport(){
        // window.open(this.btnGenerate_link + this.selected_student.studID, '_blank')
         swal("Please select type of report", {
           buttons: {
             PR: true,
             MD: true,
             SF: true,
             F: true,
             RC: true,
             TG: true
           }
         }).then(val => {
           if(val){
            window.open(this.btnGenerate_link + this.selected_student.studID + '/' + this.term.termID + '/' + val.toLowerCase(), '_blank')  
           }
           
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
