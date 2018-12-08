<script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/flatpickr/flatpickr.min.css">
<style>
	.my-height{
	    height: 40px;
	  }
</style>

<section class="section" id="app" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title">Payment Transaction Logs</h3>
		<div class="box">
			<div class="columns">
				<div class="column is-half">
					<flat-pickr v-model="filteredDate" :config="dateConfig" placeholder="Input date range"></flat-pickr>
				</div>
				<div class="column">
					<button :class="{'button is-primary my-height': true, 'is-loading': is_generating}" @click="populate(1,'generate')">Generate</button>
				</div>
			</div>
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
	              <th>Fee</th>
	              <th>Amount</th>
	              <th>Payee</th>
	              <th>Action</th>
	              <th>OR #</th>
	            </thead>

	            <td colspan="7" class="has-text-centered" v-show="loading">Loading please wait ...</td>
	            <td colspan="7" class="has-text-centered" v-show="msg">No record found</td>

	            <tbody>
	              <tr v-for="record, i in records">
	              	<td> {{record.paidDate}} </td>
	              	<td> {{record.feeName}} </td>
	              	<td> {{record.amount}} </td>
	                <td> {{record.faculty}} </td>
	                <td> {{record.action}} </td>
	                <td> {{record.or_number}} </td>
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

<script>

document.addEventListener('DOMContentLoaded', function() {

  Vue.component('paginate', VuejsPaginate)
  Vue.component('multiselect', window.VueMultiselect.default) 
  Vue.component('flat-pickr', VueFlatpickr)

  new Vue({

   el: '#app',
   data: {
      loading: true,
      msg: false,
      is_generating: false,
      pagination: true,
      filteredDate: null,
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

      records: []

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
    populate(page, val){
    	if(val == 'generate'){
    		this.is_generating = true
    	}else{
    		this.loading = true	
    	}
    	
      const data = {
        page: page,
        per_page: this.per_page,
        filteredDate: this.filteredDate2
      }
      this.$http.post('<?php echo base_url() ?>student_users/populate_payment_logs', data)
      .then(response => {
      	this.is_generating = false
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
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
