<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
   .my-btn{
      width: 85px;
   }   
</style>


<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Student 
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
         <div class="box">
            <div class="columns">
               <div class="column">
                  <label class="label">Current Term</label>
                   <div class="control">
                       <multiselect @input="fetchData(1)" v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false"></multiselect>
                   </div>   
               </div>
               <div class="column">
                  <label class="label">Filter</label>
                  <button @click="filter = 0" :class="{'button is-primary my-btn': true, 'is-outlined': filter != 0}">All</button>
                  <button @click="filter = 1" :class="{'button is-primary my-btn': true, 'is-outlined': filter != 1}">Course</button>
                  <button @click="filter = 2" :class="{'button is-primary my-btn': true, 'is-outlined': filter != 2}">Subject</button>
                  <button @click="filter = 3" :class="{'button is-primary my-btn': true, 'is-outlined': filter != 3}">Instructor</button>   
               </div>
            </div>
         </div>
         
         <div class="column is-4" v-if="filter == 1">
            <multiselect v-model="course" track-by="courseID" :allow-empty="false" label="courseCode" :options="courses" @input="fetchData(1)" placeholder="Select course"></multiselect>
         </div>
          
        <div class="column is-4" v-if="filter == 2">
            <label class="label">Search subject:</label>
            <div class="control">
               <multiselect v-model="subject" label="subCode" track-by="subID" placeholder="Enter subject code" :options="subjects" :loading="isLoading2" :internal-search="false" @search-change="fetchSubjects">
               </multiselect>
            </div>
         </div>

         <div class="box" v-if="ready">
            <h5 class="title is-5"> {{title}} </h5>
            <hr>
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
            <br>
            <table class="table is-fullwidth">
               <thead>
                  <th>Control number</th>
                  <th>Name</th>
                  <th>Course</th>
                  <th>Yearlevel</th>
               </thead>
               <td colspan="4" class="has-text-centered" v-show="loading">Loading please wait ...</td>
               <td colspan="4" class="has-text-centered" v-show="total_records == 0 && filter != 2">No record found</td>
               <tbody>
                  <tr v-for="student, i in students2">
                     <td>{{student.controlNo}}</td>
                     <td>{{student.name}}</td>
                     <td>{{student.courseCode}}</td>
                     <td>{{student.yearDesc}}</td>
                  </tr>
               </tbody>
            </table>
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
   Vue.component('paginate', VuejsPaginate);
   Vue.component('multiselect', window.VueMultiselect.default) 

  new Vue({

   el: '#app',
   data: {
      isLoading2: false,
      filter: 0,
      loader: true,
      ready: true,
      term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
      course: null,
      subject: null,
      faculty: null,
      terms: [],
      students: [],
      students2: [],
      courses: [],
      subjects: [],
      total_count: '',

      pagination: true,
      entries: ['5','10','25','50','100'],
      total_records: 0,
      per_page: '10',
      pagination_links: '',
      current_page: 1,
      end: 0,
      loading: true
   },
   created(){  
      this.populate()
   },
   watch: {
      per_page(){
         this.pagination = false
         if(this.filter == 0){
            this.fetchData(1)
         }else{
            this.populate_students2(1)
         }
      },
      filter(val){
         this.ready = false
         this.students = []
         this.total_records = 0
         if(val == 0){
            this.fetchData(1)
         }else if(val == 2){
          //this.fetchSubjects()
         }
      },
      subject(val){
        this.fetchStudent_sub(val.subID)
      }
   },
   computed: {
      title(){
         const f = this.filter 
         let x = ''
         if(f == 0){
            x = 'All enrolled students'
         }else if(f == 1 && this.course != null){
            x = 'All enrolled students ('+this.course.courseCode+')'
         }else if(f == 2 && this.subject != null){
            x = 'Enrolled students in '+this.subject.subCode
         }else if(f == 3 && this.faculty != null){
            x = ' of'+this.faculty.faculty
         }
         return x
      },
      pages(){
         return Math.ceil(this.total_records / this.per_page)
      }
   },
   methods: {
      nextPage(page){
         console.log(page)
         if(this.filter == 0){
            this.fetchData(page)
         }else{
            this.current_page = page   
            this.populate_students2(1)
         }
      },
      fetchStudent_sub(subID){
        this.$http.get('<?php echo base_url() ?>reports_student/fetchStudent_sub/'+subID+'/'+this.term.termID)
        .then(response => {
           console.log(response.body)
           this.students2 = response.body
           this.ready = true
        })
      },
      fetchSubjects(value){
        if(value.trim() != ''){
            this.isLoading2 = true
            value = value.replace(/\s/g, "_")
            this.$http.get('<?php echo base_url() ?>reports_student/fetchSubjects/'+value)
            .then(response => {
               this.isLoading2 = false
               this.subjects = response.body
            })
        }
      },
      fetchData(page){
         this.msg = false
         this.current_page = page
         this.loading = true
         const filter = this.filter
         const id = this.get_selected_id(filter)
         this.$http.get('<?php echo base_url() ?>reports_student/fetchData/'+filter +'/'+ this.term.termID + '/' + page + '/' + this.per_page +'/'+ id)
         .then(response => {
            const c = response.body
            console.log(c)
            if(c.total_rows == 0){
               this.pagination = false
               this.msg = true
            }else{
               this.pagination = true
            }
            this.students = c.students
            this.students2 = c.students
            this.total_records = c.total_rows
            this.loading = false
            this.ready = true
            if(filter != 0 && c.total_rows != 0){
               this.populate_students2(0)
            }
          })
      },
      populate_students2(val){
         //while(true){
            let arr = []
            const students = this.students
            let start = 0
            let max = this.per_page
            if(val != 0){
               start = (this.current_page - 1) * max;
               max = Number(start) + Number(this.per_page)
            }else{
               this.current_page = 1
            }
            for(let i = start; i < max; ++i){
               if(students[i] == null){
                  break
               }
               arr.push(students[i])
            }
            // console.log('start: '+start+' max: '+max+' current_page: '+this.current_page+' per_page: '+this.per_page)
            if(arr.length > 0){
               this.students2 = arr
               this.pagination = true
              // break
            }else{
               this.fetchData(1)
            }
           // val = 0
         //}
         
         
      },
      get_selected_id(f){
         let id = 0
         if(f == 1){
            id = this.course.courseID 
         }else if(f == 2){
            id = this.subject.subID 
         }else if(f == 3){
            id = this.faculty.facID 
         }
         return id
      },
      populate(){
         this.$http.get('<?php echo base_url() ?>reports_student/populate')
        .then(response => {
          const c = response.body
          this.terms = c.terms 
          this.students = c.students
          this.students2 = c.students
          this.courses = c.courses
          this.total_records = c.total_rows
          this.loading = false
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

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-paginate/vue-paginate.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>

