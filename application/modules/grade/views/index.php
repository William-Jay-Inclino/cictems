<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Grade 
      </h1>
    </div>
  </div>
</section>

<div id="app" v-cloak>
   <section class="section">
      <div class="container">
         <div class="box">
            <div class="columns">
               <div class="column is-half">
                  <div class="field">
                     <label class="label">Search student:</label>
                     <div class="control">
                        <multiselect v-model="selected_student" label="student" track-by="studID" placeholder="Enter name / control no" :options="suggestions" :loading="isLoading" :internal-search="false" @search-change="search">
                        </multiselect>
                     </div>
                  </div>
               </div>
               <div class="column" v-show="ready">
                  <a :href="grade_link" class="button is-primary is-pulled-right" target="_blank">View student's prospectus</a>
                  <br>
               </div>
            </div>
         </div>
         <br>

         <div v-show="ready">
            <div class="columns">
               <div class="column is-half">
                  <div class="box">
                     <div class="field">
                        <label class="label">Search subject:</label>
                        <div class="control">
                           <multiselect v-model="selected_subject" label="subCode" track-by="subID" placeholder="Enter subject code" :options="suggestions_subject" :loading="isLoading2" :internal-search="false" @search-change="search_subject">
                           </multiselect>
                        </div>
                     </div>
                     <hr>
                     <table class="table is-fullwidth">
                        <tr>
                           <td><b>Description: </b></td>
                           <td> {{desc}} </td>
                        </tr>
                        <tr>
                           <td><b>Lecture: </b></td>
                           <td>{{lec}}</td>
                        </tr>
                        <tr>
                           <td><b>Laboratory: </b></td>
                           <td>{{lab}}</td>
                        </tr>
                        <tr>
                           <td><b>Prerequisites:</b></td>
                           <td>
                              <span v-for="x of pre">
                                 {{x}}                                 
                              </span>
                           </td>
                        </tr>
                        <tr>
                           <td><b>Corequisites: </b></td>
                           <td>
                              <span v-for="x of co">
                                 {{x}}&nbsp;                               
                              </span>
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="column" v-show="ready_form">
                  <div class="box">
                     <div v-if="form_is_ok">
                        <div class="columns">
                           <div class="column">
                              <h5 class="title is-5">{{ action }} Grade</h5>
                           </div>
                           <div class="column" v-show="action == 'Update'">
                              <button v-on:click="remove_grade" class="button is-rounded is-pulled-right">
                                 <i class="fa fa-trash fa-lg has-text-danger"></i>
                              </button>
                           </div>
                        </div>
                        <hr>
                        <div class="columns is-centered">
                           <div class="column is-5">
                              <div class="field">
                                 <div class="control">
                                    <input type="number" class="input has-text-centered" v-model.number.trim="grade"
                                    style="height: 100px; font-size: 50px" onpaste="return false;" onKeyPress="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58)return false;" v-on:keyup.enter="submit_grade">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <button v-on:click="submit_grade" class="button is-rounded is-link is-pulled-right">
                           {{action}}
                        </button>
                        <br>
                     </div>
                     <div v-else>
                        <i class="fa fa-warning has-text-warning"></i> {{action}}
                     </div>
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
      link: '<?php echo base_url() ?>reports/grade/',
      loader: false,
      ready: false,
      ready_form: false,
      isLoading: false,
      selected_student: null,
      suggestions: [],
      
      grade: '',
      action: '',
      suggestions_subject: [],
      selected_subject: null,
      isLoading2: false,
      desc: '',
      lec: '',
      lab: '',
      pre: '',
      co: ''
    },   


    watch: {
      selected_student(val){
         this.selected_subject = null
         this.suggestions_subject = []
         if(val === null){
            this.ready = false
         }else{
            this.ready = true
         }
      },
      selected_subject(val){
         if(val === null){
            this.ready_form = false
         }else{
            this.set_form()
            this.ready_form = true
         }
      }
    },


    computed: {
      grade_link(){
         const x = this.selected_student
         if(x != null){
            return this.link + x.studID
         }
          
      },
      form_is_ok(){
         const x = this.action
         return (x != 'Insert' && x != 'Update') ? false : true
      },
      new_grade(){
         return parseFloat(this.grade).toFixed(1)
      }
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
      search_subject(value){
         if(value.trim() != ''){
            this.isLoading2 = true
            value = value.replace(/\s/g, "_")
            this.$http.get('<?php echo base_url() ?>grade/search_subject/'+value+'/'+this.selected_student.studID)
            .then(response => {
               this.isLoading2 = false
               this.suggestions_subject = response.body
            })
         }
      },
      set_form(){
         this.$http.get('<?php echo base_url() ?>grade/set_form/'+this.selected_student.studID+'/'+this.selected_subject.subID)
         .then(response => {
            const c = response.body
            this.desc = c.subject.subDesc
            this.lec = c.subject.lec
            this.lab = c.subject.lab
            this.action = c.data
            this.grade = c.grade
            this.pre = c.pre
            this.co = c.co
         })
      },
      submit_grade(){
         const g = this.new_grade
         if(this.validate(g)){
            const x = {
                        studID: this.selected_student.studID, 
                        subID: this.selected_subject.subID, 
                        grade: g, 
                        action: this.action
            }
            this.$http.post('<?php echo base_url() ?>grade/submit_grade', x)
            .then(response => {
               a = (this.action == 'Insert') ? 'Inserted' : 'Updated'
               swal('Grade successfully '+a+'!', {icon: 'success'})
               this.action = 'Update'
               this.grade = g
            })
         }
      },
      validate(g){
         let x = false
         if(g == '' || g == null){
            swal('Please enter grade', {icon: 'warning'})
         }else if(isNaN(g)){
            swal('Please enter valid grade!', {icon: 'error'})
         }else if(g < 1 || g > 5){
            swal('Grade should only be 1 - 5', {icon: 'warning'})
         }else{
            x = true
         }
         return x
      },
      remove_grade(){
         const s = this.selected_subject.subCode
         swal({
           title: "Please Confirm",
           text: "Are you sure you want to remove grade in "+s+"?",
           icon: "warning",
           buttons: {
            cancel: true,
            confirm: {
               closeModal: false
            }
           },
           dangerMode: true
         })
         .then((willDelete) => {
            if (willDelete) {
               const x = {studID: this.selected_student.studID, subID: this.selected_subject.subID}
               this.$http.post('<?php echo base_url() ?>grade/delete_grade', x)
               .then(response => {
                  swal('Poof! '+s+' has been deleted!', {
                     icon: 'success',
                   });
                  this.grade = ''
                  this.action = 'Insert'
               })
            }
         });
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

