<?php if($roleID == 4): ?>
		<script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
<?php endif ?>

<style>
	.has-image-centered {
	  margin-left: auto;
	  margin-right: auto;
	}
	.active-input{
		background-color: #f2f2f2 
	}
	.fa-sm{
		font-size: 8px;
	}
	.is-note{
		color: #9c9fa6
	}
	.warn-msg{
		color: #fbac00;
		font-weight: bold;
	}
	.dang-msg{
		color: #ce6666;
		font-weight: bold;
	}
	.succ-msg{
		color: #5cb85c;
		font-weight: bold;
	}
	.gray-msg{
		color: #808eae;
		font-weight: bold;
	}
</style>
<section id="app" class="section" v-cloak>
	<div class="container" style="max-width: 600px">
		<h3 class="title is-3 has-text-centered my-title">Settings</h3>
		<div class="box">
		    <figure class="image is-128x128 has-image-centered">
			  <img src="<?php echo base_url(); ?>assets/img/settings.png">
			</figure>
			<hr>
			<h6 class="title is-6 is-note">User account</h6>
			<table class="table is-fullwidth">
				<tr :class="{'active-input': editUn}">
					<td width="45%"><b>Username</b></td>
					<td width="45%">
						<span v-if="editUn">
							<input type="text" v-model.trim="form.userName" class="input" autofocus="true" placeholder="Username" @keyup.enter="save('un')"> 
							<p class="help dang-msg"> {{error.userName}} </p>
							<hr>
							<button class="button is-link is-small" @click="save('un')">Save Changes</button>
							<br><br>
						</span>
						<span v-else>
							{{userName}}
						</span>
					</td>
					<td width="10%" v-if="false">
						<span v-if="editUn">
							<button class="button is-small" @click="editUn = false"><i class="fa fa-times has-text-danger"></i></button>
						</span>
						<span v-else>
							<button class="button is-small" @click="focus('un')"><i class="fa fa-pencil"></i></button>
						</span>
					</td>
				</tr>
				<tr :class="{'active-input': editPw}">
					<td>
						<b>Password</b>
						
					</td>
					<td>
						<span v-if="editPw">
							<input type="password" v-model.trim="form.curPass" class="input" placeholder="Current" @keyup.enter="save('name')" autofocus="true"> 
							<p class="help dang-msg"> {{error.curPass}} </p>
							<br>
							<input type="password" v-model.trim="form.newPass" class="input" placeholder="New" @keyup.enter="save('name')" @keyup="newpass_checker(0)">
							<p class="help is-note" v-html="newPass_msg"></p>
							<br>
							<input type="password" v-model.trim="form.conPass" class="input" placeholder="Retype new" @keyup.enter="save('name')" @keyup="conpass_checker(0)">
							<p class="help" v-html="conPass_msg"></p>
							<p class="help is-note">
								<i class="fa fa-circle fa-sm"></i> Password must have atleast eight characters. 
							</p>
							<p class="help is-note">
								<i class="fa fa-circle fa-sm"></i> Password must use atleast three of the four available character types: <b> lowercase letters, uppercase letters, numbers, and symbols. </b> 
							</p>
							<br>
							<a :href="pw_reset_link" v-if="editPw" class="help">Forgotten your password?</a>
							<hr>
							<button class="button is-link is-small" @click="save('pw')" :disabled="pw_has_error">Save Changes</button>
							<br><br>
						</span>
						<span v-else>
							<i class="fa fa-circle fa-sm" v-for="n in 8"></i>
						</span>
					</td>
					<td>
						<span v-if="editPw">
							<button class="button is-small" @click="editPw = false"><i class="fa fa-times has-text-danger"></i></button>
						</span>
						<span v-else>
							<button class="button is-small" @click="focus('pw')"><i class="fa fa-pencil"></i></button>
						</span>
					</td>
				</tr>
			</table>
		</div>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {

	new Vue({
	    el: '#app',
	    data: {
	    	pw_reset_link: '<?php echo base_url() ?>settings/renew-password',
	    	userName: '<?php echo $record->userName ?>',
	    	userPass: '<?php echo $record->userPass ?>',
	    	enrolPass: '<?php echo $record->enrolPass ?>',
	    	editUn: false,
	    	editPw: false,
	    	editEnrol: false,
	    	form: {
	    		userName: '<?php echo $record->userName ?>',
	    		curPass: '',
	    		newPass: '',
	    		conPass: '',
	    		curPass2: '',
	    		newPass2: '',
	    		conPass2: '',
	    	},
	    	error: {
	    		userName: '',
	    		curPass: '',
	    		curPass2: '',
	    	},
	    	newPass_msg: '',
	    	conPass_msg: '',
	    	newPass_msg2: '',
	    	conPass_msg2: '',
	    	disable_pw: []
	       
	    },
	    created() {
	        
	    },
	    watch: {
	    	editUn(val){
	    		if(!val){
	    			this.error.userName = ''
	    			this.form.userName = this.userName 
	    		}
	    	},
	    	editPw(val){
	    		if(!val){
	    			this.form.curPass = ''
	    			this.form.newPass = ''
	    			this.form.conPass = ''
	    			this.error.curPass = ''
	    			this.newPass_msg = ''
	    			this.conPass_msg = ''
	    		}
	    	},
	    	editEnrol(val){
	    		if(!val){
	    			this.form.curPass2 = ''
	    			this.form.newPass2 = ''
	    			this.form.conPass2 = ''
	    			this.error.curPass2 = ''
	    			this.newPass_msg2 = ''
	    			this.conPass_msg2 = ''
	    		}
	    	}
	    },
	    computed: {
	    	pw_has_error(){
	    		let x = true
	    		if(this.form.curPass != '' && this.form.newPass != '' && this.form.conPass != '' && this.disable_pw.length == 0){
	    			x = false
	    		}
	    		return x
	    	},
	    	pw_has_error2(){
	    		let x = true
	    		if(this.form.curPass2 != '' && this.form.newPass2 != '' && this.form.conPass2 != '' && this.disable_pw.length == 0){
	    			x = false
	    		}
	    		return x
	    	}
	    },
	    methods: {
	    	newpass_checker(val){
	    		let np = ''
	    		let cp = ''
	    		let msg = ''
	    		if(val == 0){
	    			np = this.form.newPass 
	    			cp = this.form.conPass
	    		}else if(val == 1){
	    			np = this.form.newPass2 
	    			cp = this.form.conPass2
	    		}

	    		if(np == ''){
	    			msg = "<span class='dang-msg'>You cannot use a blank password</span>"
	    			this.display_msg(val, 'np', msg)
	    			this.add_el(0)
	    		}else if(np.length < 6){
	    			msg = "<span class='warn-msg'>Password too short</span>"
	    			this.display_msg(val, 'np', msg)
	    			this.add_el(1)
	    		}else{
	    			this.remove_el(0)
	    			this.remove_el(1)
	    			this.checkPassStrength(np, val)
	    		}

	    		if(np != cp && cp != ''){
	    			msg = "<span class='warn-msg'>Password did not match</span>"
	    			this.display_msg(val, 'cp', msg)
	    			this.add_el(2)
	    		}else if(np == cp && cp != ''){
	    			msg = "<span class='succ-msg'>Password match</span>"
	    			this.display_msg(val, 'cp', msg)
	    			this.remove_el(2)
	    		}
	    	},
	    	conpass_checker(val){
	    		if(val == 0){
	    			np = this.form.newPass 
	    			cp = this.form.conPass
	    		}else if(val == 1){
	    			np = this.form.newPass2 
	    			cp = this.form.conPass2
	    		}

	    		if(cp == np && np != ''){
	    			msg = "<span class='succ-msg'>Password match</span>"
	    			this.display_msg(val, 'cp', msg)
	    			this.remove_el(2)
	    		}else if(cp != np && np != ''){
	    			msg = "<span class='warn-msg'>Password did not match</span>"
	    			this.display_msg(val, 'cp', msg)
	    			this.add_el(2)
	    		}
	    	},
	    	display_msg(val, el, msg){
	    		if(val == 0){
	    			if(el == 'np'){
	    				this.newPass_msg = msg
	    			}else{
	    				this.conPass_msg = msg
	    			}
	    		}else{
	    			if(el == 'np'){
	    				this.newPass_msg2 = msg
	    			}else{
	    				this.conPass_msg2 = msg
	    			}
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
	    	save(value){
	    		const res = this.is_valid(value)
    			if(res.valid){
    				if(value == 'enrolPass'){
    					this.$http.post('<?php echo base_url() ?>settings/save2',{data: res.data[0]})
			        	.then(response => {
			        		const c = response.body
			        		if(c == ''){
			        			this.after_update(res.data, value)
			        		}else{
			        			alert('Oooops something went wrong! '+c)
		        				window.location.href = '<?php echo base_url() ?>/settings'
			        		}
						 })
    				}else{
    					this.$http.post('<?php echo base_url() ?>settings/save',{data: res.data[0]})
			        	.then(response => {
			        		const c = response.body
			        		if(c == 0){
			        			this.after_update(res.data, value)
			        		}else if(c == 1){
							    this.error.userName = "Username is not available"
			        		}else{
			        			alert('Oooops something went wrong! '+c)
		        				window.location.href = '<?php echo base_url() ?>/settings'
			        		}
						 })
    				}
    			}
	    	},
	    	after_update(data, value){
	    		let msg = ' successfully updated!'
	    		if(value == 'un'){
	    			this.userName = data[0].userName
	    			this.editUn = false
	    			msg = 'Username' + msg
	    		}else if(value == 'pw'){
	    			this.userPass = data[0].userPass
	    			this.editPw = false
	    			msg = 'Account password' + msg
	    		}else if(value == 'enrolPass'){
	    			this.enrolPass = data[0].enrolPass
	    			this.editEnrol = false
	    			msg = 'Enrollment password' + msg
	    		}
	    		swal(msg)
	    	},
	    	focus(value){
	    		this.editUn = false
	    		this.editPw = false
	    		this.editEnrol = false

	    		if(value == 'un'){
	    			this.editUn = true
	    		}else if(value == 'pw'){
	    			this.editPw = true
	    		}else if(value == 'enrol'){
	    			this.editEnrol = true
	    		}
	    	},
	    	is_valid(value){
	    		let ok = true
	    		const data = []
	    		if(value == 'un'){
	    			if(!this.form.userName){
	    				this.error.userName = 'You cannot use a blank username'
	    				ok = false
	    			}else{
	    				this.error.userName = ''
	    			}
	    			data.push({
	    				userName: this.form.userName
	    			})
	    		}else if(value == 'pw'){
	    			if(this.userPass != this.form.curPass){
	    				this.error.curPass = 'Current password is incorrect'
	    				ok = false
	    			}else{
	    				this.error.curPass = ''
	    				if(!this.password_validation(this.form.newPass)){
	    					swal('Please follow password requirements', {
						      icon: 'error',
						    })
						    ok = false
	    				}
	    			}
    				data.push({
	    				userPass: this.form.newPass
	    			})
	    		}else if(value == 'enrolPass'){
	    			if(this.enrolPass != this.form.curPass2){
	    				this.error.curPass2 = 'Current password is incorrect'
	    				ok = false
	    			}else{
	    				this.error.curPass2 = ''
	    				if(!this.password_validation(this.form.newPass2)){
	    					swal('Please follow password requirements', {
						      icon: 'error',
						    })
						    ok = false
	    				}
	    			}
    				data.push({
	    				enrolPass: this.form.newPass2
	    			})
	    		}
	    		return {
	    			valid: ok,
	    			data: data
	    		} 
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
	    	checkPassStrength(pass, val) {
			    const score = this.scorePassword(pass)
			    let msg = ''
			    if (score > 80){
			    	msg = "Password strength: <span class='succ-msg'>Strong</span>"
			    }else if (score > 60){
			    	msg = "Password strength: <span class='has-text-link'><b>Medium</b></span>"
			    }else{
			    	msg = "Password strength: <span class='gray-msg'>Weak</span>"
			    }
			    this.display_msg(val, 'np', msg)
			}
	    },

		   http: {
            emulateJSON: true,
            emulateHTTP: true
    		}
	})

}, false)



</script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>
<?php if($roleID == 4): ?>
		<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
<?php endif ?>