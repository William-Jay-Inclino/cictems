<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CICTE</title>
    <script src="<?php echo base_url(); ?>assets/vendor/pace/pace.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pace/pace-theme-minimal.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma/bulma.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/headroom/headroom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma-steps/bulma-steps.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
    <style>
    body{
      background-image: url("<?php echo base_url() ?>assets/img/bg-tile.png");
    }
      .no-hover{
        pointer-events: none;
      }
      .has-image-centered {
        margin-left: auto;
        margin-right: auto;
      }
      .btn-users{
        width: 100px;
      }
      .btn-backNext{
        width: 70px;
      }
      .is-note{
        color: #9c9fa6
      }
      .fa-sm{
        font-size: 8px;
      }
      .step-small{
        font-size: 13px;
        font-weight: bold;
      }
      .warn-msg{
        color: #fbac00;
        font-weight: bold;
      }
      .gray-msg{
        color: #808eae;
        font-weight: bold;
      }
    </style>
  </head>
<body class="Site">
  
  <header class="header">

    <nav class="animate-top navbar is-transparent is-fixed-top card">
      <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
          <img src="<?php echo base_url() ?>assets/img/cictelogo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
        </a>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
      </div>
    
      <div id="navMenu" class="navbar-menu">
        <div class="navbar-end">
          <a class="navbar-item" href="<?php echo base_url() ?>login">
           Login
          </a>
          <a class="navbar-item bg-primary has-text-white no-hover" href="javascript:void(0)">
           Register
          </a>
        </div>
      </div>

    </nav>
  </header>
  <br><br>






  <main class="Site-content">
    <script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
    <section id="app" class="section" v-cloak>
      <div class="container" style="max-width: 600px">
        <h3 class="title is-3 has-text-centered my-title">Register</h3>
        <br><br>
        <div class="steps">
          <div :class="{'step-item': true, 'is-primary is-completed': step1Active ,'is-completed is-success': step1Completed}">
            <div class="step-marker">
              <span v-if="step1Completed"> <i class="fa fa-check"></i> </span>
              <span v-else>1</span>
            </div>
            <div class="step-details is-note step-small">
              Step 1
            </div>
          </div>
          <div :class="{'step-item': true, 'is-primary is-completed': step2Active ,'is-completed is-success': step2Completed}">
            <div class="step-marker">
              <span v-if="step2Completed"> <i class="fa fa-check"></i> </span>
              <span v-else>2</span>
            </div>
            <div class="step-details is-note step-small">
              Step 2
            </div>
          </div>
          <div :class="{'step-item': true, 'is-primary is-completed': step3Active ,'is-completed is-success': step3Completed}">
            <div class="step-marker">
              <span v-if="step3Completed"> <i class="fa fa-check"></i> </span>
              <span v-else>3</span>
            </div>
            <div class="step-details is-note step-small">
              Step 3
            </div>
          </div>
          <div :class="{'step-item': true, 'is-primary is-completed': step4Active ,'is-completed is-success': step4Completed}">
            <div class="step-marker">
              <span v-if="step4Completed"> <i class="fa fa-check"></i> </span>
              <span v-else>
                <i class="fa fa-flag"></i>
              </span>
            </div>
            <div class="step-details is-note step-small">
              Finish
            </div>
          </div>
        </div>
        <div class="box">

          <div class="field" v-if="current_step == 1">
            <label class="label">Select type of user</label>
            <br>
            <div class="control">
              <button :class="{'button is-primary btn-users': true, 'is-outlined': is_student}" @click="selectUser('Student')">Student</button>
              <button :class="{'button is-primary btn-users': true, 'is-outlined': is_guardian}" @click="selectUser('Guardian')">Guardian</button>
              <!-- <div class="columns">
                <div class="column">
                  <button :class="{'button is-primary btn-users': true, 'is-outlined': is_faculty}" @click="selectUser('Faculty')">Faculty</button>
                </div>
                <div class="column">
                  <button :class="{'button is-primary btn-users': true, 'is-outlined': is_staff}" @click="selectUser('Staff')">Staff</button>
                </div>
                <div class="column">
                  <button :class="{'button is-primary btn-users': true, 'is-outlined': is_student}" @click="selectUser('Student')">Student</button>
                </div>
                <div class="column">
                  <button :class="{'button is-primary btn-users': true, 'is-outlined': is_guardian}" @click="selectUser('Guardian')">Guardian</button>
                </div>
              </div> -->
            </div>
          </div>

          <div v-if="current_step == 2">
            <div class="field">
              <label class="label">Role</label>
              <div class="control">
                <p class="has-text-primary"> <b> {{form.role}} </b></p>
              </div>
            </div>
            <div class="field" v-if="form.role == 'Student'">
              <label class="label">Your name <p class="help is-note">Format: Lastname, Firstname Middlename</p> </label>
              <div class="control">
                <multiselect :show-labels="false" v-model="form.student" label="name" track-by="uID" placeholder="Type your name here" :options="students" :loading="isLoading" :internal-search="false" @search-change="fetchStudents">
               </multiselect>
              </div>
              <p class="help has-text-danger"> {{error.student}} </p>
            </div>
            <div v-else>
              <label class="label">Name</label>
                <div class="columns">
                  <div class="column">
                    <div class="field">
                      <div class="control">
                        <input type="text" class="input" placeholder="Firstname" v-model.trim="form.fn" autofocus="true" @keyup.enter="nextStep">
                      </div>
                      <p class="help has-text-danger"> {{error.fn}} </p>
                    </div>
                  </div>
                  <div class="column">
                    <div class="field">
                      <div class="control">
                        <input type="text" class="input" placeholder="Middlename (optional)" v-model.trim="form.mn" @keyup.enter="nextStep">
                      </div>
                    </div>
                  </div>
                  <div class="column">
                    <div class="field">
                      <div class="control">
                        <input type="text" class="input" placeholder="Lastname" v-model.trim="form.ln" @keyup.enter="nextStep">
                      </div>
                      <p class="help has-text-danger"> {{error.ln}} </p>
                    </div>
                  </div>
                </div>
            </div>
            <!-- <div class="field">
              <label class="label">Date of Birth</label>
              <div class="control">
                <input type="date" class="input" v-model="form.dob" @keyup.enter="nextStep">
              </div>
              <p class="help has-text-danger"> {{error.dob}} </p>
            </div> -->
            <div class="field" v-if="form.role != 'Student'">
              <label class="label">Sex</label>
              <div class="control">
                <button :class="{'button is-primary': true, 'is-outlined': formMale}" @click="changeSex('Male')">Male</button>
                <button :class="{'button is-primary': true, 'is-outlined': formFemale}" @click="changeSex('Female')">Female</button>
              </div>
              <p class="help has-text-danger"> {{error.sex}} </p>
            </div>
            <!-- <div class="field">
              <label class="label">Address</label>
              <div class="control">
                <input type="text" class="input" v-model.trim="form.address" @keyup.enter="nextStep">
              </div>
              <p class="help has-text-danger"> {{error.address}} </p>
            </div> -->
            <!-- <div class="field">
              <label class="label">Contact number</label>
              <div class="control">
                <input type="text" class="input" v-model.trim="form.cn" @keyup.enter="nextStep">
              </div>
              <p class="help has-text-danger"> {{error.cn}} </p>
            </div> -->
            <div class="field">
              <label class="label">Email</label>
              <div class="control">
                <input type="email" class="input" v-model="form.email" @keyup.enter="nextStep">
              </div>
              <p class="help has-text-danger"> {{error.email}} </p>
            </div>
            
            <div v-if="form.role == 'Guardian'">
              <div class="field">
                <label class="label">My students</label><p class="help is-note">Format: Lastname, Firstname Middlename</p> </label>
                <multiselect v-model="form.students" :multiple="true" track-by="studID" label="name" :options="students" :loading="isLoading" :internal-search="false" @search-change="fetchStudents" placeholder="Type your student's name"></multiselect>
              </div>
              <p class="help has-text-danger"> {{error.guardian}} </p>
            </div>

          </div>

          <div v-if="current_step == 3">
            <p class="help is-note"> <i class="fa fa-circle fa-sm"></i> Password must have atleast 8 characters </p>
            <p class="help is-note"> <i class="fa fa-circle fa-sm"></i> Password must use atleast three of the four available character types: lowercase letters, uppercase letters, numbers, and symbols. </p>
            <hr>
            <div class="field">
              <label class="label">Password</label>
              <div class="control">
                <input type="password" class="input" @keyup="newpass_checker()" v-model="form.userPass">
              </div>
              <p class="help" v-html="newPass_msg"></p>
            </div>
            <div class="field">
              <label class="label">Retype password</label>
              <div class="control">
                <input type="password" class="input" @keyup="conpass_checker()" v-model="conPass">
              </div>
              <p class="help" v-html="conPass_msg"></p>
            </div>
          </div>

          <div v-if="current_step == 4">
            <h5 class="title is-5 is-note">Final Step</h5>
            <p> <i class="fa fa-circle fa-sm"></i> Proceed to the cicte office for confirmation</p>
            <p> <i class="fa fa-circle fa-sm"></i> Bring your student ID <span class="is-note">(student)</span> </p> <p> <i class="fa fa-circle fa-sm"></i> Bring any valid ID <span class="is-note">(guardian)</span> </p>
            <hr>
            <table class="table is-fullwidth">
              <tr>
                <td><b>Role</b></td>
                <td> {{form.role}} </td>
              </tr>
              <tr>
                <td><b>Username</b></td>
                <td> {{form.userName}} </td>
              </tr>
              <tr>
                <td><b>Password</b></td>
                <td><i class="fa fa-circle fa-sm" v-for="n in 8"></i></td>
              </tr>
              <tr>
                <td><b>Name</b></td>
                <td> {{fullName}} </td>
              </tr>
              <!-- <tr>
                <td><b>Date of Birth</b></td>
                <td> {{form.dob}} </td>
              </tr> -->
              <tr>
                <td><b>Sex</b></td>
                <td> {{form.sex}} </td>
              </tr>
              <!-- <tr>
                <td><b>Address</b></td>
                <td> {{form.address}} </td>
              </tr>
              <tr>
                <td><b>Contact number</b></td>
                <td> {{form.cn}} </td>
              </tr> -->
              <tr>
                <td><b>Email</b></td>
                <td> {{form.email}} </td>
              </tr>
            </table>
            <div v-if="form.role == 'Guardian'">
              <hr>
              <h6 class="title is-6 is-note">My Student/s</h6>
              <p v-for="student of form.students">
                <i class="fa fa-circle fa-sm"></i> {{student.name}}
              </p>
            </div>
          </div>

          <hr>
          <button class="button btn-backNext" @click="--current_step" v-show="current_step > 1 && current_step < 4">Back</button>
          <button :class="{'button is-link is-pulled-right btn-backNext': true, 'is-loading': loadingctn}" :disabled="btnContinue2" @click="nextStep" v-show="current_step < 4">Continue</button>
          <br><br>

          

        </div>
      </div>
    </section>
  </main>
    





    <script>
    
      document.addEventListener('DOMContentLoaded', function() {
        Vue.component('multiselect', window.VueMultiselect.default) 

        //sa guardian utrohon ang pa agi sa pag add og student. dapat multiple select nana 

        new Vue({
            el: '#app',
            data: {
              btnContinue: true,
              loadingctn: false,
              is_faculty: true,
              is_staff: true,
              is_student: true,
              is_guardian: true,

              current_step: 1,

              step1Active: true,
              step2Active: false,
              step3Active: false,
              step4Active: false,

              step1Completed: false,
              step2Completed: false,
              step3Completed: false,
              step4Completed: false,
              formMale: true,
              formFemale: true,
              form: {
                role: '',
                student: null,
                fn: '',
                mn: '',
                ln: '',
                sex: '',
                address: '',
                email: '',
                userName: '',
                userPass: '',
                students: []
              },
              error:{
                student: '',
                fn: '',
                mn: '',
                ln: '',
                dob: '',
                sex: '',
                address: '',
                cn: '',
                email: '',
                guardian: ''
              },
              conPass: '',
              un_msg: '',
              newPass_msg: '',
              conPass_msg: '',
              disable_pw: [],
              students: [],
              isLoading: false,
            },
            created() {
                
            },
            watch: {
              current_step(step){
                this.step1Active = false
                this.step2Active = false
                this.step3Active = false
                this.step4Active = false
                this.step1Completed = false
                this.step2Completed = false
                this.step3Completed = false
                this.step4Completed = false
                if(step == 1){
                  this.step1Active = true
                  this.step1Completed = false
                }else if(step == 2){
                  this.step2Active = true
                  this.step1Completed = true
                }else if(step == 3){
                  this.step3Active = true
                  this.step1Completed = true
                  this.step2Completed = true
                }else if(step == 4){
                  this.step4Active = true
                  this.step1Completed = true
                  this.step2Completed = true
                  this.step3Completed = true
                }
              }
            },
            computed: {
              btnContinue2(){
                let x = this.btnContinue
                if(this.current_step == 3){
                  x = true
                }
                if(this.form.userPass != '' && this.conPass != '' && this.disable_pw.length == 0){
                  x = false
                }
                return x
              },
              fullName(){
                let name
                if(this.form.role == 'Student'){
                  name = this.form.student.name
                }else{
                  name = this.form.ln + ', ' + this.form.fn + ' ' + this.form.mn
                }
                return name
              }
            },
            methods: {
              newpass_checker(){
                const np = this.form.userPass 
                const cp = this.conPass

                if(np == ''){
                  this.newPass_msg = "<span class='warn-msg'><b>You cannot use a blank password</b></span>"
                  this.add_el(0)
                }else if(np.length < 6){
                  this.newPass_msg = "<span class='warn-msg'>Password too short</span>"
                  this.add_el(1)
                }else{
                  this.remove_el(0)
                  this.remove_el(1)
                  this.checkPassStrength(np)
                }

                if(np == ''){
                  this.conPass_msg = ''
                }else if(np != cp && cp != ''){
                  this.conPass_msg = "<span class='warn-msg'>Password did not match</span>"
                  this.add_el(2)
                }else if(np == cp && cp != ''){
                  this.conPass_msg = "<span class='has-text-success'><b>Password match</b></span>"
                  this.remove_el(2)
                }
              },
              conpass_checker(){
                const np = this.form.userPass 
                const cp = this.conPass

                if(cp != np){
                  this.conPass_msg = "<span class='warn-msg'>Password did not match</span>"
                  this.add_el(2)
                }else if(cp == np){
                  this.conPass_msg = "<span class='has-text-success'><b>Password match</b></span>"
                  this.remove_el(2)
                }
              },
              remove_el(val){
                const index = this.disable_pw.indexOf(val)
                if (index > -1) {
                  this.disable_pw.splice(index, 1)
                  
                }
              },
              add_el(val){
                if (!this.disable_pw.includes(val)) {
                    this.disable_pw.push(val)
                    
                }
              },
              fetchStudents(value){
                if(value.trim() != ''){
                  this.isLoading = true
                  value = value.replace(/\s/g, "_")
                  this.$http.get('<?php echo base_url() ?>login/get_students/'+value)
                  .then(response => {
                    console.log(response.body)
                     this.isLoading = false
                     this.students = response.body
                  })
               }else{
                  this.students = []
               }
              },
              selectUser(user){
                this.form.role = user
                this.btnContinue = false
                this.is_faculty = true
                this.is_staff = true
                this.is_student = true
                this.is_guardian = true
                if(user == 'Faculty'){
                  this.is_faculty = false
                }else if(user == 'Staff'){
                  this.is_staff = false
                }else if(user == 'Student'){
                  this.is_student = false
                }else if(user == 'Guardian'){
                  this.is_guardian = false
                }
              },
              changeSex(sex){
                if(sex == 'Male'){
                  this.formFemale = true
                  this.formMale = false
                }else{
                  this.formMale = true
                  this.formFemale = false
                }
                this.form.sex = sex
              },
              removeStudents(i){
                this.form.students.splice(i,1)
                --this.gstudents
              },
              nextStep(){
                const step = this.current_step
                if(step == 1){
                  this.loadingctn = false
                  ++this.current_step
                }else if(step == 2){
                  if(this.is_valid_step2()){
                    this.loadingctn = false
                    ++this.current_step
                  }
                }else if(step == 3){
                  if(this.is_valid_step3()){
                    this.loadingctn = true
                    this.submitForm()
                  }
                }

              },
              is_valid_step2(){
                let ok = true 
                let msg = 'This field is required'
                const f = this.form
                if(f.role == 'Student'){
                  if(f.student == null){
                    this.error.student = msg 
                    ok = false
                  }else{
                    this.error.student = ''
                  }
                }else{
                  if(!f.fn){
                    this.error.fn = msg 
                    ok = false
                  }else{
                    this.error.fn = ''
                  }
                  if(!f.ln){
                    this.error.ln = msg 
                    ok = false
                  }else{
                    this.error.ln = '' 
                  }
                }
                // if(!Date.parse(f.dob)){
                //   this.error.dob = 'Invalid date of birth'
                //   ok = false
                // }else{
                //   this.error.dob = ''
                // }
                if(!f.sex && f.role != 'Student'){
                  this.error.sex = msg 
                  ok = false
                }else{
                  this.error.sex = '' 
                }
                // if(!f.address){
                //   this.error.address = msg 
                //   ok = false
                // }else{
                //   this.error.address = '' 
                // }
                // if(!f.cn){
                //   this.error.cn = msg 
                //   ok = false
                // }else{
                //   this.error.cn = '' 
                // }
                if(!this.validEmail(f.email)){
                  this.error.email = 'Please enter valid email'
                  ok = false
                }else{
                  this.error.email = ''
                }
                if(f.role == 'Guardian'){
                  if(f.students.length == 0){
                    this.error.guardian = msg 
                    ok = false 
                  }else{
                    this.error.guardian = ''
                  }
                }

                return ok
              },
              is_valid_step3(){
                let ok = true 
                if(!this.password_validation(this.form.userPass)){
                  swal('Follow password requirements', {
                    icon: 'error',
                  })
                  ok = false
                }
                
                return ok
              },
              submitForm(){
                this.$http.post('<?php echo base_url() ?>login/submit_registration', {data: this.form})
                .then(response => {
                  const c = response.body
                  console.log(c)
                  this.loadingctn = false
                  if(c.output == 'success'){
                    ++this.current_step
                    this.form.userName = c.un
                  }
                  if(this.form.role == 'Student'){
                    this.form.sex = c.sex
                  }
          
                }, e => {
                  console.log(e.body)

                })
              },
              password_validation(pw){
                let ctr = 0
                let ok = false
                if(/[a-z]/.test(pw)){
                  ctr = 1
                }
                if(/[A-Z]/.test(pw)){
                  ctr = 2

                }
                if(/\d/.test(pw)){
                  ctr = 3

                }
                if(/\W/.test(pw)){
                  ctr = 4
                }
                if(pw.length >= 8 && ctr >= 3){
                  ok = true
                }
                return ok
              },
              scorePassword(pass){
                let score = 0
                const pass_length = pass.length
                if (!pass)
                    return score

                // award every unique letter until 5 repetitions
                let letters = new Object()

                for (let i=0; i<pass_length; ++i) {
                    letters[pass[i]] = (letters[pass[i]] || 0) + 1
                    score += 5.0 / letters[pass[i]]
                }

                // bonus points for mixing it up
                let variations = {
                    digits: /\d/.test(pass),
                    lower: /[a-z]/.test(pass),
                    upper: /[A-Z]/.test(pass),
                    nonWords: /\W/.test(pass),
                }

                variationCount = 0
                for (let check in variations) {
                    variationCount += (variations[check] == true) ? 1 : 0
                }
                score += (variationCount - 1) * 10

                return parseInt(score)
              },
              checkPassStrength(pass) {
                const score = this.scorePassword(pass)
                let msg = ''
                if (score > 80){
                  msg = "Password strength: <span class='has-text-success'><b>Strong</b></span>"
                }else if (score > 60){
                  msg = "Password strength: <span class='has-text-link'><b>Medium</b></span>"
                }else{
                  msg = "Password strength: <span class='gray-msg'>Weak</span>"
                }
                this.newPass_msg = msg
              },
              validEmail(email){
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
              }
            },
             http: {
                  emulateJSON: true,
                  emulateHTTP: true
              }
        })

      }, false)



      </script>



<br><br><br><br>


  <footer class="footer bg-white">
        <div class="container">
          <div class="content has-text-centered">
              Developed by <a href="#" class="has-text-primary"><b>Team RAWR</b></a>. Copyright &copy; <?php echo date("Y"); ?> All Rights Reserved
          </div>
        </div>
      </footer>
  <script src="<?php echo base_url(); ?>assets/js/navBurger.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/headroom/headroom-config.js"></script>
</body>
</html>