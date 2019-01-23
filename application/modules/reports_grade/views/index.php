<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
   .btn-width{
      width: 90px;
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
                     <button class="button is-info btn-width">Prospectus</button>
                     <a :href="'<?php echo base_url() ?>reports/grade/by-class' + '/' + selected_student.studID" class="button is-info is-outlined btn-width">Class</a>
                  </div>
               </div>
            </div>
         </div>
         
         <div v-show="loader" class="loader"></div>

         <div v-show="!loader && ready">
            <div class="hero-body has-text-centered">
                <div class="container">
                  <h1 class="title">
                    {{prospectus.description}}
                  </h1>
                  <h2 class="subtitle">
                    Effectivity {{prospectus.effectivity}}
                  </h2>
                </div>
              </div>
               
               <h2 class="subtitle has-text-centered">
                  Curriculum Structure
               </h2>
               
               <div v-for="subject of subjects">
                  <div class="box">
                     <h6 class="title is-6">
                        {{ subject.term }}
                     </h6>
                     <hr>
                     <table class="table is-fullwidth is-bordered">
                        <thead>
                           <th width="5%">Grade</th>
                           <th width="15%">Subject Code</th>
                           <th width="30%">Description</th>
                           <th width="5%">Units</th>
                           <th width="20%">Prerequisites</th>
                           <th width="13%">School Year</th>
                           <th width="12%">Semester</th>
                        </thead>
                        <tbody>
                           <tr v-for="row of subject.subjects">
                              <td style="text-align: center">
                                 <span v-if="row.subject.grade_type == 'Credit'">
                                    <i class="fa fa-check has-text-primary"></i>
                                 </span>
                                 <span v-else>
                                    <span v-if="row.subject.grade == 0.0">
                                       INC
                                    </span>
                                    <span v-else>
                                       {{row.subject.grade}}
                                    </span>
                                 </span>
                              </td>
                              <td> {{row.subject.subCode}} <span v-if="row.subject.type == 'lab'"><b>(lab)</b></span> </td>
                              <td> {{row.subject.subDesc}} </td>
                              <td> {{row.subject.units}} </td>
                              <td>
                                 <span v-for="row2 of row.sub_req">
                                    <span v-if="row2.req_type == 2">
                                       Corequisite
                                    </span>
                                    {{ row2.req_code }}
                                 </span>
                                 {{ row.subject.year_req }}
                                 <span v-if="row.subject.year_req">
                                    Standing
                                 </span>
                                 {{row.subject.nonSub_pre}}
                              </td>
                              <td>{{row.subject.sy}}</td>
                              <td>{{row.subject.sem}}</td>
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
      btnGenerate_link: '<?php echo base_url() ?>reports/grade/download-by-prospectus/',
      page_title: 'Grade Reports',
      loader: false,
      studID: '<?php echo $studID ?>',

      ready: false,
      isLoading: false,
      selected_student: null,
      suggestions: [],

      prospectus: '',
      subjects: []
   },
   created(){  
      if(this.studID != 0){
         this.get_student()
      }
   },


   watch: {
      selected_student(val){
         if(val === null){
            this.ready = false
         }else{
            this.btnGenerate_link += this.selected_student.studID
            this.get_grade()
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
      get_grade(){
         this.loader = true
         this.$http.get('<?php echo base_url() ?>reports_grade/get_grade_by_pros/'+this.selected_student.studID)
         .then(response => {
            const c = response.body
            this.prospectus = c.prospectus
            this.subjects = c.subjects.map(x => {
               
               for(let s of x.subjects){
                  if(s.subject.term){
                     const arr = s.subject.term.split('|')
                     s.subject.grade_type = arr[0]
                     s.subject.sy = arr[1]
                     s.subject.sem = arr[2]   
                  }
                  
               }

               return x
            })
            console.log(this.subjects)
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
      display_term(x,term){
         if(term != null){
            const a = (x == 'sy') ? 1 : 2
            return term.split('|')[a]
         }
      },
      generateReport(){
         window.open(this.btnGenerate_link, '_blank')
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

