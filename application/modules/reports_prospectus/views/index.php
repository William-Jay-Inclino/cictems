<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Prospectus 
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
                  <label class="label">Select prospectus:</label>
                  <div class="control">
                     <multiselect v-model="selected_pros" track-by="prosID" label="prosCode" :options="prospectus"></multiselect>
                  </div>
                  <br>
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
                           <th width="15%">Subject Code</th>
                           <th width="30%">Description</th>
                           <th width="5%">Units</th>
                           <th width="20%">Prerequisites</th>
                        </thead>
                        <tbody>
                           <tr v-for="row of subject.subjects">
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
                              </td>
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
      loader: false,
      ready: false,

      selected_pros: null,
      titlePros: [],
      subjects: [],
      prospectus: []
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
   methods: {
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

