<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/flatpickr/flatpickr.min.css">

<style>
  .my-height{
    height: 40px;
  }
  .table__wrapper {
  overflow-x: auto;
}
</style>


<div id="app" v-cloak>
  <section class="section">
    <div class="container">
      <h3 class="title is-3 my-title"> {{page_title}} </h3> <br>
      <button @click="generateReport" class="button is-primary is-pulled-right" class="button is-primary" :disabled="!filteredDate">Generate Report</button>
      <br><br>
      <div class="box">
        <h5 class="title is-5">Filter</h5>
        <hr>
        <div class="columns">
          <div class="column is-5">
            <flat-pickr v-model="filteredDate" :config="dateConfig" placeholder="Input date range"></flat-pickr>  
          </div>
          <div class="column is-5">
            <multiselect v-model="student" label="student" track-by="studID" placeholder="Enter name / control no" :options="students" :loading="isLoading" :internal-search="false" @search-change="searchStudent">
            </multiselect>
          </div>
          <div class="column">
            <button class="button is-primary my-height" @click="populate(1)">Generate</button>
          </div>
        </div>
      </div>

      <div class="box">
        <h5 class="title is-5">Logs</h5>
        <hr>
        <div class="column is-2">
          <div class="control has-icons-left">
            <div class="select">
                <select v-model="per_page">
                  <option v-for="entry in entries" :value="entry">{{ entry }}</option>
                </select>
              </div>
              <div class="icon is-small is-left">
                <i class="fa fa-eye"></i>
              </div>
          </div>
        </div>
        <br>
        <div class="table__wrapper">
          <table class="table is-fullwidth">
            <thead>
              <th>Date</th>
              <th>OR#</th>
              <th>Student</th>
              <th>User</th>
              <th>Fee</th>
              <th>Amount</th>
              <th>Action</th>
              
            </thead>

            <td colspan="7" class="has-text-centered" v-show="loading">Loading please wait ...</td>
            <td colspan="7" class="has-text-centered" v-show="msg">No record found</td>

            <tbody>
              <tr v-for="record, i in records">
                <td> {{record.paidDate}} </td>
                <td> {{record.or_number}} </td>
                <td> {{record.student}} </td>
                <td> {{record.faculty}} </td>
                <td> {{record.feeName}} </td>
                <td> {{record.amount}} </td>
                <td> {{record.action}} <span v-if="record.action == 'transfer debit'">{{record.trans_feeName}}</span> </td>
                
              </tr>
            </tbody>
          </table>
        </div>
        <hr>
        <div class="is-pulled-right">
          <div v-if="pagination">
            <paginate
              :container-class="'pagination'"
              :page-count="pages"
              :click-handler="nextPage"
              :hide-prev-next="true"
              :prev-text="'&laquo;'"
              :next-text="'&raquo;'"
              :no-li-surround="true"
              >
            </paginate>
          </div>
        </div>
        <br>
      </div>

    </div>
  </section>
</div>




<script>

document.addEventListener('DOMContentLoaded', function() {

  Vue.component('paginate', VuejsPaginate)
  Vue.component('multiselect', window.VueMultiselect.default) 
  Vue.component('flat-pickr', VueFlatpickr)

  new Vue({

   el: '#app',
   data: {
      btnGenerate_link: '<?php echo base_url() ?>reports/payment-logs/download/',
      page_title: 'Payment Log Reports',
      loading: true,
      msg: false,
      loader: false,
      ready: false,
      pagination: true,
      filteredDate: null,
      isLoading: false,
      dateConfig: {
        mode: "range",
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        altInputClass: 'input my-height'
      },

      entries: ['10','25','50','100'],
      total_records: 0,
      per_page: '10',
      pagination_links: '',
      current_page: 1,

      records: [],
      student: null,
      students: []

   },
   created(){  
    this.populate(1)
   },
   watch: {
    per_page(){
      this.pagination = false
      this.populate(1)
    }
   },
   computed: {
    report_link(){
      const fd = this.filteredDate2
      const studID = (this.student) ? this.student.studID : 0
      const date_filtered = (fd) ? fd.dateFrom + '/' + fd.dateTo : 'no-date'

      return this.btnGenerate_link + date_filtered + '/' +studID
    },
    pages(){
      return Math.ceil(this.total_records / this.per_page)
    },
    filteredDate2(){
      const fd = this.filteredDate
      let x = null
      let a = []
      if(fd){
        if(fd.includes('to')){
          a = fd.split(' to ')
        }else{
          a = [fd,fd]
        }
        x = {
          dateFrom: a[0],
          dateTo: a[1]
        }
      }

      return x
    }
   },
   methods: {
    nextPage(page){
      this.populate(page)
    },
    populate(page){
      const studID = (this.student) ? this.student.studID : null
      const data = {
        page: page,
        per_page: this.per_page,
        filteredDate: this.filteredDate2,
        studID: studID
      }
      this.$http.post('<?php echo base_url() ?>reports_payment_logs/populate', data)
      .then(response => {
        this.loading = false
        const r = response.body
        this.records = r.records
        this.total_records = r.total_rows
        if(r.total_rows == 0){
          this.pagination = false
          this.msg = true
        }else{
          this.pagination = true
          this.msg = false
        }
      }, e => {
        console.log(e.body)
      })
    },
    searchStudent(value){
      if(value.trim() != ''){
          this.isLoading = true
          value = value.replace(/\s/g, "_")
          this.$http.get('<?php echo base_url() ?>reusable/search_student/'+value)
          .then(response => {
             this.isLoading = false
             this.students = response.body
          })
       }
    },
      generateReport(){
         window.open(this.report_link, '_blank')
      }
   },


   http: {
      emulateJSON: true,
      emulateHTTP: true
   }

  })

}, false)


</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-paginate/vue-paginate.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/flatpickr/flatpickr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/flatpickr/vue-flatpickr-component@8.js"></script>
