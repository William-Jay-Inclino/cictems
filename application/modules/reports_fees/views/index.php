<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
  .tag-width{
    width: 80px;
  }
</style>

<div id="app" v-cloak>
   <section class="section">
      <div class="container">
        <h3 class="title is-3 my-title"> {{page_title}} </h3>
        <div class="columns">
          <div class="column">
            <label class="label">Term</label>
            <multiselect v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false" @input="changeTerm"></multiselect>
          </div>
          <div class="column">
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
              <button @click="generateReport" class="button is-primary" class="button is-primary">Generate Report</button>
            </div>
            
          </div>
        </div>
        
        <div class="box">
          <label class="label">Select academic activity</label>
          <multiselect @input="getStudents" v-model="fee" track-by="feeID" label="feeName" :options="fees" :allow-empty="false"></multiselect>
        </div>
          
        <div v-if="fee">

          <div class="box">
            <h5 class="title is-5"> <span class="icon has-text-primary"> <i class="fa fa-info-circle"></i> </span> Contribution Info</h5>
            <hr>
            <table class="table is-fullwidth">
              <thead>
                <th>Academic activity</th>
                <th>Year level & courses involved</th>
                <th>Contribution each student</th>
                <th>Deadline of payment</th>
                <th>Status</th>
              </thead>
              <tbody>
                <td> {{fee.feeName}} </td>
                <td> {{fee.feeDesc}} </td>
                <td> {{fee.amount}} </td>
                <td> {{fee.dueDate}} </td>
                <td>
                  <span v-if="fee.termID != current_termID && fee.feeStatus != 'cancelled'">
                    <span class="tag is-success tag-width">Done</span>
                  </span>
                  <span v-else-if="fee.feeStatus == 'cancelled'">
                    <span class="tag is-danger tag-width">Cancelled</span>
                  </span>
                  <span v-else>
                    <span class="tag is-link tag-width">On going</span>
                  </span>
                </td>
              </tbody>
            </table>
          </div>
          
          <div class="box">
            <div class="columns">
              <div class="column">
                <h5 class="title is-5"> <span class="icon has-text-primary"> <i class="fa fa-group"></i> </span> Involved Students</h5>
              </div>
              <div class="column">
                <multiselect v-model="filter" track-by="filterID" label="filterDesc" :options="filters" @input="filterStudents" placeholder="Filter students"></multiselect>
              </div>
            </div>
            <hr>
            <table class="table is-fullwidth">
              <thead>
                <th>#</th>
                <th>Control no</th>
                <th>Name</th>
                <th>Course</th>
                <th>Year</th>
                <th>Payable</th>
                <th>Receivable</th>
                <th>Status</th>
              </thead>
              <tbody>
                <tr v-for="student,i in students">
                  <td> {{++i}} </td>
                  <td> {{student.controlNo}} </td>
                  <td> {{student.name}} </td>
                  <td> {{student.courseCode}} </td>
                  <td> {{student.yearDesc}} </td>
                  <td> {{student.payable}} </td>
                  <td> {{student.receivable}} </td>
                  <td>
                    <span v-if="student.status == 'Unpaid'">
                      <span class="tag is-danger tag-width">Unpaid</span>
                    </span>
                    <span v-else-if="student.status == 'Paid'">
                      <span class="tag is-success tag-width">Paid</span>
                    </span>
                    <span v-else-if="student.status == 'Partial'">
                      <span class="tag is-link tag-width">Partially Paid</span>
                    </span>
                    <span v-else-if="student.status == 'Refundable'">
                      <span class="tag is-primary tag-width">Refundable</span>
                    </span>
                    <span v-else>
                      
                    </span>
                  </td>
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
    page_title: 'Fees Report',
      loader: false,
      ready: false,
      term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
      current_termID: '<?php echo $current_term->termID ?>',
      terms: [],
      fee: null,
      fees: [],
      students: [],
      students2: [],

      filter: null,
      filters: [
              {filterID: 'Paid', filterDesc: 'Paid'},
              {filterID: 'Unpaid', filterDesc: 'Unpaid'},
              {filterID: 'Partial', filterDesc: 'Partially Paid'},
              {filterID: 'Refundable', filterDesc: 'Refundable'}
      ],

       is_settings_open: false,
       updated_at: new Date('<?php echo $date_updated; ?>').toISOString().slice(0,10)
   },
   created(){  
    this.populate()
   },


   watch: {

   },
   methods: {
    updateSettings(){
      swal('Success', 'Settings successfully updated!', 'success')
      this.is_settings_open = false
      this.$http.post('<?php echo base_url() ?>reports_fees/updateSettings', {termID: this.term.termID, updated_at: this.updated_at})
       .then(res => {
        console.log(res.body)
     }, e => {
      console.log(e.body);

     })
    },
    filterStudents(){
      const f = this.filter 
      const students = this.students2 
      let filtered_students = []

      if(f == null){
        filtered_students = students
      }else{
        for(let s of students){
          if(f.filterID == s.status){
            filtered_students.push(s)
          }
        }  
      }

      
      this.students = filtered_students
    },
    populate(){
      this.$http.get('<?php echo base_url() ?>reports_fees/populate/'+this.term.termID)
        .then(response => {
        const r = response.body
        this.terms = r.terms 
        this.fees = r.fees
      }, e => {
        console.log(e.body)
      })
    },
    changeTerm(){
      this.fee = null
      this.$http.get('<?php echo base_url() ?>reports_fees/changeTerm/'+this.term.termID)
        .then(response => {
          const r = response.body
          this.fees = r.fees
      }, e => {
        console.log(e.body)
      })
    },
    getStudents(){
      this.filter = null
      this.$http.get('<?php echo base_url() ?>reports_fees/getStudents/'+this.fee.feeID)
        .then(response => {
          const res = response.body
          const students = res.students 
          this.fee.amount = res.amount
          const students2 = []

          for(let s of students){
            if(this.fee.feeStatus == 'cancelled' && s.payable == 0 && s.receivable == 0){
              status = ''
            }else if(s.payable > 0){
              if(s.payable != this.fee.amount){
                status = 'Partial'
              }else{
                status = 'Unpaid'
              }
            }else if(s.receivable > 0){
              status = 'Refundable'
            }else{
              status = 'Paid'
            }

            students2.push({
              controlNo: s.controlNo,
              name: s.name,
              courseCode: s.courseCode,
              yearDesc: s.yearDesc,
              payable: s.payable,
              receivable: s.receivable,
              status: status,
            })
          }

          this.students = students2
          this.students2 = students2
          console.log(students2);
      }, e => {
        console.log(e.body)
      })
    },
    generateReport(){
      swal("Please select type of report", {
        buttons: {
          Paid: true,
          Unpaid: true,
          Refundable: true,
          Cancelled: true,
        }
      }).then(val => {
        if(val){
          window.open('<?php echo base_url() ?>reports/fees/download/'+this.term.termID+'/'+val.toLowerCase(), '_blank')  
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
