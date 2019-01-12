<style>
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
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="settings_link">Settings</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Renew password</a></li>
		  </ul>
		</nav>
	</div>
	<br>
	<div class="container" style="max-width: 600px">
		<h3 class="title is-3 has-text-centered my-title">Renew password</h3>
		<div class="box" v-if="!has_code">
			<p>Code will be send via email to <b>{{email}}</b> </p>
			<hr>
			<button :class="{'button is-link is-outlined is-pulled-right': true, 'is-loading': btnContinue}" @click="sendCode">Continue</button>
			<br><br>
		</div>
		<div class="box" v-else>
			<p>Didn't receive the code? <a href="javascript:void(0)" @click="sendCode_again">Send code again</a> </p>
			<hr>
			<div class="field">
				<label class="label">Code</label>
				<div class="control">
					<input type="password" class="input" autofocus="true" v-model="form.code">
				</div>
				<p class="help dang-msg"> {{errorCode}} </p>
			</div>
			<div class="field">
				<label class="label">New password</label>
				<div class="control">
					<input type="password" class="input" @keyup="newpass_checker()" v-model="form.newPass">
				</div>
				<p class="help" v-html="newPass_msg"></p>
			</div>
			<div class="field">
				<label class="label">Retype password</label>
				<div class="control">
					<input type="password" class="input" @keyup="conpass_checker()" v-model="form.conPass">
				</div>
				<p class="help" v-html="conPass_msg"></p>
			</div>
			<button class="button is-link is-pulled-right" @click="submitForm" :disabled="pw_has_error">Submit</button>
			<br><br>
		</div>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {
	new Vue({
	    el: '#app',
	    data: {
	    	has_code: '<?php echo $record['has_code'] ?>',
	    	btnContinue: false,
	    	email: '<?php echo $record['email'] ?>',
	    	settings_link: '<?php echo base_url() ?>settings',
	    	form: {
	    		code: '',
	    		newPass: '',
	    		conPass: ''
	    	},
	    	newPass_msg: '',
	    	conPass_msg: '',
	    	errorCode: '',
	    	disable_pw: []
	    },
	    created() {
	        
	    },
	    watch: {

	    },
	    computed: {
	    	pw_has_error(){
	    		let x = true
	    		if(this.form.code != '' && this.form.newPass != '' && this.form.conPass != '' && this.disable_pw.length == 0){
	    			x = false
	    		}
	    		return x
	    	}
	    },
	    methods: {
	    	newpass_checker(){
	    		const np = this.form.newPass 
	    		const cp = this.form.conPass

	    		if(np == ''){
	    			this.newPass_msg = "<span class='dang-msg'>You cannot use a blank password</span>"
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
	    		const np = this.form.newPass 
	    		const cp = this.form.conPass

	    		if(cp != np && np != ''){
	    			this.conPass_msg = "<span class='warn-msg'>Password did not match</span>"
	    			this.add_el(2)
	    		}else if(cp == np && np != ''){
	    			this.conPass_msg = "<span class='succ-msg'>Password match</span>"
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
	    	sendCode(){
	    		this.btnContinue = true
	    		this.$http.get('<?php echo base_url() ?>settings/sendCode')
	        	.then(response => {
	        		const c = response.body
	        		console.log(c)
	        		if(c == ''){
	    				swal('Success', 'Code successfully send to '+this.email, 'success')
						.then((x) => {
							this.btnContinue = false
					  		this.has_code = true
						})    			
	        		}else{
	        			alert('Oooops something went wrong! '+c)
		        		window.location.href = '<?php echo base_url() ?>/settings/password-reset'
	        		}
	    
				 })
	    	},
	    	sendCode_again(){
	    		this.$http.get('<?php echo base_url() ?>settings/sendCode')
	        	.then(response => {
	        		const c = response.body
	        		console.log(c)
	        		if(c == ''){
	    				swal('Success', 'Code successfully send to '+this.email, 'success')   			
	        		}else{
	        			alert('Oooops something went wrong! '+c)
		        		window.location.href = '<?php echo base_url() ?>/settings/password-reset'
	        		}
	    
				 })
	    	},
	    	submitForm(){
	    		if(this.is_valid()){
	    			const data = {
	    				new_pw: this.form.newPass,
	    				code: this.form.code
	    			}
	    			this.$http.post('<?php echo base_url() ?>settings/updatePassword', data)
		        	.then(response => {
		        		const c = response.body
		        		console.log(c)
		        		if(c == '1'){
		        			this.errorCode = 'Code is incorrect'
		        		}else if(c == ''){
		        			swal('Success', 'Password successfully renewed', 'success')
		        			.then((x) => {
								window.location.href = this.settings_link
							})    

		        		}else{
		        			alert('Oooops something went wrong! '+c)
			        		window.location.href = '<?php echo base_url() ?>/settings/renew-password'
		        		}
		    
					 })
	    		}
	    	},
	    	is_valid(){
	    		let ok = true 
	    		let msg = ''

	    		if(this.form.newPass != this.form.conPass){
	    			this.conPass_msg = "<span class='warn-msg'>Password did not match</span>"
	    			ok = false
	    		}
	    		if(!this.password_validation(this.form.newPass)){
					swal('Please follow password requirements', {
				      icon: 'error',
				    })
				    ok = false
				}
	    		return ok
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
			    	msg = "Password strength: <span class='succ-msg'>Strong</span>"
			    }else if (score > 60){
			    	msg = "Password strength: <span class='has-text-link'><b>Medium</b></span>"
			    }else{
			    	msg = "Password strength: <span class='gray-msg'>Weak</span>"
			    }
			    this.newPass_msg = msg
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