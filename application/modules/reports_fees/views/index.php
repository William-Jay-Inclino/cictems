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
            <button @click="generateReport" class="button is-primary is-pulled-right" class="button is-primary">Generate Report</button>
          </div>
        </div>
        
        <div class="box">
          <label class="label">Select Fee</label>
          <multiselect @input="getStudents" v-model="fee" track-by="feeID" label="feeName" :options="fees" :allow-empty="false"></multiselect>
        </div>
          
        <div v-if="fee">

          <div class="box">
            <h5 class="title is-5">Fee Info</h5>
            <hr>
            <table class="table is-fullwidth">
              <thead>
                <th>Name of fee</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Due date</th>
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
                <h5 class="title is-5">Involved Students</h5>
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
      ]
   },
   created(){  
    this.populate()
   },


   watch: {

   },
   methods: {
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
      const fee = this.fee
      this.$http.get('<?php echo base_url() ?>reports_fees/getStudents/'+this.fee.feeID)
        .then(response => {
          const res = response.body
          const students = res.students 
          this.fee.amount = res.amount
          const students2 = []
          let status = ''
          for(let s of students){
            if(fee.feeStatus == 'cancelled' && s.payable == 0 & s.receivable == 0){
              status = ''
            }else if(s.payable > 0 && s.receivable == 0){
              if(s.payable == fee.amount){
                status = 'Unpaid'
              }else if(s.payable == 0){
                status = 'Paid'
              }else{
                status = 'Partial'
              }
            }else if(s.receivable > 0 && s.payable == 0){
              status = 'Refundable'
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
        }
      }).then(val => {
        window.open('<?php echo base_url() ?>reports/fees/download/'+this.term.termID+'/'+val.toLowerCase(), '_blank')
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
