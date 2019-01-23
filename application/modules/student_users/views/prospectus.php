<script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
<style>
   .tbl-headers{
      background-color: #f2f2f2 
   }
</style>

<div id="app" v-cloak>
   <section class="section">
      <div class="container">
         <h3 class="title is-3 my-title"> {{page_title}} </h3>
         <br>
         <!-- <button @click="generateReport" class="button is-primary is-pulled-right">Generate Report</button> <br><br><br> -->
      

         <div v-show="loader" class="loader"></div>

         <div v-show="!loader && ready">
            <div class="hero-body has-text-centered">
                <div class="container">
                  <h1 class="title">
                    {{titlePros.description}}
                  </h1>
                  <h2 class="subtitle">
                    Effectivity {{titlePros.effectivity}}
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
                  <div class="table__wrapper">
                     <table class="table is-fullwidth">
                        <thead>
                           <tr class="tbl-headers">
                              <th width="20%">Course Code</th>
                              <th width="30%">Description</th>
                              <th width="30%" colspan="3" style="text-align: center">Units</th>
                              <th width="20%">Pre-requisite / Remarks</th>   
                           </tr>        
                           <tr class="tbl-headers">
                              <td></td>
                              <td></td>
                              <th style="text-align: center">lec</th>
                              <th style="text-align: center">lab</th>
                              <th style="text-align: center">total</th>
                              <td></td>
                           </tr>                   
                        </thead>
                        <tbody>
                           <tr :style="{color: row.subject.specColor}" v-for="row of subject.subjects">
                              <td> {{row.subject.subCode}} <span v-if="row.subject.type == 'lab'"><b>(lab)</b></span> </td>
                              <td> {{row.subject.subDesc}} </td>
                              <td style="text-align: center"> {{row.lec}} </td>
                              <td style="text-align: center"> {{row.lab}} </td>
                              <td style="text-align: center"> {{row.subject.total_units}} </td>
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
                           </tr>
                           <tr>
                              <td colspan="2"></td>
                              <th colspan="3" style="text-align: center">Total units: {{subject.tot_units}}</th>
                              <td></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <br>
            </div>
               
            <div class="columns">
               <div class="column is-1 has-text-centered">
                  <p style="font-size: 12px;">Prepared by:</p>
               </div>
               <div style="font-size: 12px;" class="column is-3 has-text-centered">
                  <br>
                  {{dean.name}} <br>
                  {{dean.description}}
               </div>
               <div class="column is-2"></div>
               <div class="column is-half">
                  <div class="box">
                     <table class="table is-fullwidth is-centered">
                        <thead>
                           <tr class="tbl-headers">
                              <th colspan="3">SUMMARY OF COURSES</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr :style="{color: sp.specColor}" v-for="sp of specializations">
                              <td style="text-align: left"> {{sp.specDesc}} </td>
                              <td> {{sp.total}} </td>
                              <td>units</td>
                           </tr>   
                           <tr>
                              <th style="text-align: right">TOTAL:</th>
                              <th> {{total_units}} </th>
                              <th>UNITS</th>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>




<script>

document.addEventListener('DOMContentLoaded', function() {

  new Vue({

   el: '#app',
   data: {
      btnGenerate_link: '<?php echo base_url() ?>reports/prospectus/download/',
     page_title: 'Prospectus',
     errName: '',
     errDesc: '',
      loader: false,
      ready: false,
      titlePros: [],
      subjects: [],
      specializations: [],
      dean: {}
   },
   created(){  
      this.get_subjects()
   },

   computed: {
      total_units(){
         const specs = this.specializations
         let count = 0
         for(let s of specs){
            count += s.total
         }
         return count
      }
   },
   methods: {
      get_subjects(){
         this.loader = true
         this.$http.get('<?php echo base_url() ?>student_users/prospectus_populate')
         .then(response => {
            const c = response.body
            console.log(c);
            this.titlePros = c.prospectus
            this.subjects = c.subjects
            this.dean = c.dean
            this.loader = false
            this.ready = true
            this.specializations = c.specializations.map(x => {
               x.total = 0
               return x
            })
            this.course_summary()
         }, e => {
          console.log(e.body)

         })
      },
      course_summary(){
         const specs = this.specializations
         const subjects = this.subjects

         for(let ss of subjects){

            for(let s of ss.subjects){

               for(let spec of specs){
                  if(spec.specID == s.subject.specID){
                     spec.total += Number(s.subject.total_units)
                     break
                  }
               }

            }

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

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>