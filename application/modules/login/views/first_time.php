<script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>

<section class="section">
  <div class="container" style="max-width: 500px">
    <h3 class="title is-3 has-text-centered has-text-primary">Change Password</h3>
    <div class="box" id="app" v-cloak>
      <p class="help is-note"> <i class="fa fa-circle fa-sm"></i> Password must have atleast 8 characters </p>
        <p class="help is-note"> <i class="fa fa-circle fa-sm"></i> Password must use atleast three of the four available character types: lowercase letters, uppercase letters, numbers, and symbols. </p>
        <hr>  
      <?php 
        $js = '@submit="submitForm"';
        echo form_open(base_url() . 'login/changePass', $js); 
      ?>
        <div class="field">
            <label class="label">New Password</label>
            <div class="control has-icons-right">
            <input class="input is-rounded" type="password" name="np" required v-model="newPass" @keyup="newpass_checker()">
            <span class="icon is-small is-right">
              <i class="fa fa-key"></i>
            </span>
          </div>
          <p class="help" v-html="newPass_msg"></p>
        </div>
        <div class="field">
            <label class="label">Retype Password</label>
            <div class="control has-icons-right">
            <input class="input is-rounded" type="password" name="retypepw" required v-model="conPass" @keyup="conpass_checker()">
            <span class="icon is-small is-right">
              <i class="fa fa-key"></i>
            </span>
          </div>
          <p class="help" v-html="conPass_msg"></p>
        </div>
        <br>
        <div style="text-align: center">
          <button type="submit" class="button is-primary is-outlined login-btn" :disabled="is_disabled">Submit</button> <br><br>
        </div>
        
      <?php echo form_close(); ?>
      
    </div>
  </div>
  </section>

  <script>

  document.addEventListener('DOMContentLoaded', function() {

    new Vue({
        el: '#app',
        data: {
          newPass: '',
          conPass: '',
          newPass_msg: '',
          conPass_msg: '',
          disable_pw: []
        },
        created() {
            
        },
        watch: {

        },
        computed: {
          is_disabled(){
            let x = true
            if(this.newPass != '' && this.conPass != '' && this.disable_pw.length == 0){
              x = false
            }
            return x
          },
        },
        methods: {
          newpass_checker(){
            const np = this.newPass
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
            const np = this.newPass
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
          submitForm(e){
            if(!this.password_validation(this.newPass)){
              swal('Follow password requirements', {
                icon: 'error',
              })
              e.preventDefault()
            }
          }
        }
    })

  }, false)



  </script>

  <script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>