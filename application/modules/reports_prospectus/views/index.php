<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
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
        <a v-if="selected_pros" :href="'<?php echo base_url() ?>reports/prospectus/download/' + selected_pros.prosID" target="_blank" class="button is-primary is-pulled-right">Generate Report</a> <br><br><br>
         <div class="box columns bg-white">
            <div class="column">
               <div class="field">
                  <label class="label">Select prospectus:</label>
                  <div class="control">
                     <multiselect v-model="selected_pros" track-by="prosID" label="prosCode" :options="prospectus"></multiselect>
                  </div>
                  <br>
               </div>
            </div>
            <div class="column">
               <div class="is-pulled-right">
                  <div :class="{'dropdown is-right': true, 'is-active': is_settings_open}">
                     <div class="dropdown-trigger">
                        <button @click="toggle_settings" class="button" aria-haspopup="true"> <i class="fa fa-cog has-text-primary"></i> </button>
                     </div>
                     <div class="dropdown-menu" role="menu" style="min-width: 300px;">
                        <form @submit.prevent="updateReport" class="dropdown-content">
                           <div class="dropdown-item">
                              <div class="field">
                                 <label class="label">Prepared by: </label>
                                 <div class="control">
                                    <input type="text" class="input" v-model.trim="name" autofocus="true">
                                 </div>
                                 <p class="help has-text-danger"> {{errName}} </p>
                              </div>
                           </div>
                           <div class="dropdown-item">
                              <div class="field">
                                 <label class="label">Description: </label>
                                 <div class="control">
                                    <input type="text" class="input" v-model.trim="description">
                                 </div>
                                 <p class="help has-text-danger"> {{errDesc}} </p>
                              </div>
                           </div>
                           <hr class="dropdown-divider">
                           <div class="dropdown-item">
                              <button type="submit" class="button is-primary is-fullwidth">Save</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               
            </div>
      </div>

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
                     <table class="table is-fullwidth">
                        <thead>
                           <tr class="tbl-headers">
                              <th width="15%">Subject Code</th>
                              <th width="30%">Description</th>
                              <th style="text-align: center" width="5%">Units</th>
                              <th width="20%">Pre-requisite / Remarks</th>   
                           </tr>                           
                        </thead>
                        <tbody>
                           <tr v-for="row of subject.subjects">
                              <td> {{row.subject.subCode}} <span v-if="row.subject.type == 'lab'"><b>(lab)</b></span> </td>
                              <td> {{row.subject.subDesc}} </td>
                              <td style="text-align: center"> {{row.subject.units}} </td>
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
                        </tbody>
                     </table>
                  </div>
                  <br>
               </div>
               
               <div class="columns">
                  <div class="column is-1 has-text-centered">
                     <p style="font-size: 12px;">Prepared by:</p>
                  </div>
                  <div style="font-size: 12px;" class="column is-3 has-text-centered">
                     <br>
                     {{name}} <br>
                     {{description}}
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
                              <tr v-for="sp of specializations">
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

  Vue.component('multiselect', window.VueMultiselect.default) 

  new Vue({

   el: '#app',
   data: {
     page_title: 'Prospectus Reports',
     name : '<?php echo $data->name ?>',
     description : '<?php echo $data->description ?>',
     errName: '',
     errDesc: '',
      loader: false,
      ready: false,
      is_settings_open: false,
      selected_pros: null,
      titlePros: [],
      subjects: [],
      prospectus: [],
      specializations: []
   },
   created(){  
      this.fetchProspectus()
   },

   watch: {
      selected_pros(value){
         if(value === null){
            this.ready = false
         }else{
            this.get_subjects(value.prosID)
         }
      }
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
      updateReport(){
         const msg = "This field must not be empty"
         let ok = true
         if(!this.name){
            this.errName = msg
            ok = false
         }else{
            this.errName = ''
         }

         if(!this.description){
            this.errDesc = msg
            ok = false
         }else{
            this.errDesc = ''
         }

         if(ok){
            const data = {
               name: this.name,
               description: this.description
            }
            this.$http.post('<?php echo base_url() ?>reports_prospectus/updateReport', {data: data})
            .then(response => {
               this.is_settings_open = false 
               swal('Success', 'Settings successfully updated!', 'success')
            }, e => {
               console.log(e.body)

            })
         }

      }, 
      toggle_settings(){
         if(this.is_settings_open){
            this.is_settings_open = false
         }else{
            this.is_settings_open = true
         }
      },
      fetchProspectus(){
         this.$http.get('<?php echo base_url() ?>reports_prospectus/get_prospectuses')
         .then(response => {
            this.prospectus = response.body
         })
      },
      get_subjects(prosID){
         this.loader = true
         this.$http.get('<?php echo base_url() ?>reports_prospectus/get_subjects/' + prosID)
         .then(response => {
            const c = response.body
            console.log(c)
            this.titlePros = c.prospectus
            this.subjects = c.subjects
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
                     spec.total += 1
                     break
                  }
               }

            }

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
