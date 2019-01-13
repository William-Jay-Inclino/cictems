<script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma_divider/bulma-divider.min.css">
<style>
    .my-height{
        height: 40px;
      }
</style>

<section class="section" id="app" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title">Enrolment</h3>
    <div class="box">
      <label class="label">Status:</label>
      <?php
        if($data['status'] == 'Enrolled'){ ?>
          <div class="message is-success">
            <div class="message-body has-text-centered has-text-success">
              Enrolled
            </div>
          </div>
          <?php
        }else if($data['status'] == 'Pending'){
          echo "<span class='has-text-primary'>Pending</span>";
        }else{
          echo "<span class='has-text-danger'>Unenrolled</span>";
        }

        if($data['status'] != 'Enrolled'){ ?>
          <hr>
          <?php 
            if($data['status'] != 'Pending'){ ?>
                <div class="field has-addons" v-if="!has_classes && has_sections">
                  <div class="control" style="width: 100%">
                    <multiselect v-model="section" track-by="secID" label="secName" :options="sections" placeholder="Select Section"></multiselect>
                  </div>
                  <div class="control">
                      <button @click="section_add" :class="{'button is-primary my-height': true, 'is-loading': loading_btn}" :disabled="section == null">Go</button>
                  </div>
              </div>
              <br>
              <div class="is-divider" data-content="OR" v-if="!has_classes && has_sections"></div>
                <?php
            }
          ?>

          <div v-if="!has_sections" class="message is-danger">
            <div class="message-body has-text-centered">
              No classes offered
            </div>
          </div>

          <div class="table__wrapper" v-if="has_classes && has_sections">
              <table class="table is-fullwidth is-centered">
                  <thead>
                    <tr>
                      <th style="text-align: left">Class Code</th>
                      <th style="text-align: left">Description</th>
                      <th>Units</th>
                      <th>Days</th>
                      <th>Time</th>
                      <th v-if="status == 'Unenrolled'">Remove</th>
                    </tr>
                </thead>
                <tbody>
                   <tr v-for="record, i in classes">
                      <td style="text-align: left">{{record.classCode}}</td>
                      <td style="text-align: left">{{record.subDesc}}</td>
                      <td>{{ record.units }}</td>
                      <td>{{record.day}}</td>
                      <td>{{record.class_time}}</td>
                      <td v-if="status == 'Unenrolled'">
                         <button class="button is-small is-danger" v-on:click="remove(record.classID,i)">
                            <span class="icon">
                               <i class="fa fa-trash"></i>
                            </span>
                         </button>
                      </td>
                   </tr>
                   <tr>
                      <th></th>
                      <th>Total units: </th>
                      <th>{{ total_units }}</th>
                      <th colspan="3"></th>
                   </tr>
                </tbody>
              </table>
          </div>

          <?php 
            if($data['status'] != 'Pending'){ ?>
              <br>
              <div class="has-text-centered" v-if="has_sections">
                <button class="button is-primary" @click="classModal = true">Add Single Class</button>    
              </div>
                <?php
            }
          ?>
          <?php
        }

      ?>
    </div>
	</div>
    
    <div class="modal is-active" v-if="classModal">
       <div class="modal-background"></div>
       <div class="modal-card">
        <header class="modal-card-head">
           <p class="modal-card-title">Add Class</p>
           <button class="delete" aria-label="close" v-on:click="close_classModal"></button>
        </header>
        <section class="modal-card-body">
           <div class="field">
              <label class="label">Select section</label>
              <div class="control">
                 <multiselect @input="get_classes" v-model="active_section" track-by="secID" label="secName" :options="active_sections" placeholder=""></multiselect>   
              </div>
           </div>
           <div class="field">
              <label class="label">Enter class code</label>
              <div class="control">
                 <multiselect open-direction="bottom" v-model="selected_class" label="classCode" track-by="classID" placeholder="" :options="class_suggestions" :loading="isLoading2">
                 </multiselect>      
              </div>
           </div>
           <div v-if="selected_class != null">
              <hr>
              <div class="table__wrapper">
                  <table class="table is-fullwidth">
                     <tr>
                        <td><b>Description: </b></td>
                        <td> {{selected_class.subDesc}} </td>
                        <td><b>Faculty: </b></td>
                        <td> {{ selected_class.faculty }} </td>
                     </tr>
                     <tr>
                        <td><b>Days: </b></td>
                        <td> {{ selected_class.day }} </td>
                        <td><b>Room: </b></td>
                        <td> {{ selected_class.roomName }} </td>
                     </tr>
                     <tr>
                        <td><b>Time: </b></td>
                        <td> {{ selected_class.class_time }} </td>
                        <td><b>Units: </b></td>
                        <td> {{ selected_class.units }} </td>
                     </tr>
                  </table>
              </div>
              
           </div>
        </section>
        <footer class="modal-card-foot pull-right">
           <button class="button is-primary is-fullwidth is-medium" @click="addClass" :disabled="selected_class == null">Add</button>
        </footer>
       </div>
     </div>

</section>



<script>

document.addEventListener('DOMContentLoaded', function() {

  Vue.component('multiselect', window.VueMultiselect.default) 

  new Vue({

   el: '#app',
   data: {
        classModal: false,
        isLoading2: false,
        loading_btn: false,
        status: '<?php echo $data['status']; ?>',
        section: null,
        sections: [],
        classes: [],

        active_section: null,
        active_sections: [],

        selected_class: null,
        class_suggestions: []
   },
   created(){  
    this.populate()
   },
   watch: {

   },
   computed: {
    has_sections(){
      if(this.sections.length > 0){
        return true
      }else{
        return false
      }
    },
    has_classes(){
        if(this.classes.length > 0){
          return true
        }else{
          return false
        }
    },
    total_units(){
         return this.classes.reduce((total, c) => {
          return total + Number(c.units)
         }, 0)
      },
   },
   methods: {
    populate(){
         this.$http.get('<?php echo base_url() ?>student_users/enrolment_populate')
         .then(response => {
            const c = response.body
            console.log(c)
            this.sections = c.sections
            this.active_sections = c.active_sections
            this.classes = c.classes
         }, e => {
          console.log(e.body)

         })
    },
    remove(classID,index){
        this.classes.splice(index, 1)
        this.$http.get('<?php echo base_url() ?>student_users/enrolment_deleteClass/'+classID)
            .then(response => {
               
        }, e => {
            console.log(e.body)
        })
      },
      section_add(){
         this.loading_btn = true
         this.$http.get('<?php echo base_url() ?>student_users/enrolment_section_add/' + this.section.secID)
         .then(response => {
            this.loading_btn = false
            this.classes = response.body
            this.section = null
          }, e => {
            console.log(e.body)
          })
      },
      close_classModal(){
        this.classModal = false
        this.selected_class = null
        this.class_suggestions = []
        this.active_section = null
      },
      addClass(){
        const sc = this.selected_class
        const classes = this.classes
        let exist = false 

        for(let c of classes){
            if(c.classID == sc.classID){
                exist = true 
                break
            }
        }

        if(exist){
            swal('Error!', 'Class already exist in your form', 'error')
        }else{
            swal('Success', 'Successfully added '+sc.classCode, 'success')
            classes.push(sc)
            this.selected_class = null
            this.active_section = null 
            this.class_suggestions = []
        }

        this.$http.get('<?php echo base_url() ?>student_users/enrolment_addClass/'+sc.classID)
         .then(response => {
            console.log(response.body)

         }, e => {
            console.log(e.body)
         })
      },
      get_classes(){
        this.class_suggestions = []
        this.selected_class = null
        const section = this.active_section
         if(section){
            this.isLoading2 = true
            this.$http.get('<?php echo base_url() ?>student_users/enrolment_get_classes/'+section.secID)
            .then(response => {
               this.isLoading2 = false
               this.class_suggestions = response.body
            }, e => {
               console.log(e.body)

            })   
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
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
