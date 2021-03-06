<script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>

<style>
	.has-image-centered {
	  margin-left: auto;
	  margin-right: auto;
	}
	.active-input{
		background-color: #f2f2f2 
	}
	.is-note{
		color: #9c9fa6
	}
	.dang-msg{
		color: #d9534f;
		font-weight: bold;
	}
</style>
<section id="app" class="section" v-cloak>
	<div class="container" style="max-width: 600px">
		<h3 class="title is-3 has-text-centered my-title">My Profile</h3>
		<div class="box">
		    <figure class="image is-128x128 has-image-centered">
			  <img src="<?php echo base_url(); ?>assets/img/avatar.png">
			</figure>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td><b>Name</b></td>
					<td colspan="2">
						{{fullName}}
					</td>
				</tr>
				<tr>
					<td><b>Sex</b></td>
					<td colspan="2">
						{{sex}}
					</td>
				</tr>
				<tr>
					<td><b>Date of birth</b></td>
					<td colspan="2">
						{{dob}}
					</td>
				</tr>
				<tr :class="{'active-input': editCn}">
					<td><b>Contact No.</b></td>
					<td>
						<span v-if="editCn">
							<input type="text" class="input" v-model.trim="form.cn" onpaste="return false;" onKeyPress="if(this.value.length==11 && event.keyCode>47 && event.keyCode < 58)return false;" autofocus="true" maxlength="11" @keyup.enter="save('cn')">
							<hr>
							<button class="button is-link is-small" @click="save('cn')">Save Changes</button>
							<br><br>
						</span>
						<span v-else>
							{{cn}}
						</span>
					</td>
					<td>
						<span v-if="editCn">
							<button class="button is-small" @click="editCn = false"><i class="fa fa-times has-text-danger"></i></button>
						</span>
						<span v-else>
							<button class="button is-small" @click="focus('cn')"><i class="fa fa-pencil"></i></button>
						</span>
					</td>
				</tr>
				<tr :class="{'active-input': editAddress}">
					<td><b>Address</b></td>
					<td>
						<span v-if="editAddress">
							<input type="text" v-model="form.address" class="input" autofocus="true" @keyup.enter="save('address')">
							<hr>
							<button class="button is-link is-small" @click="save('address')">Save Changes</button>
							<br><br>
						</span>
						<span v-else>
							{{address}}
						</span>
					</td>
					<td>
						<span v-if="editAddress">
							<button class="button is-small" @click="editAddress = false"><i class="fa fa-times has-text-danger"></i></button>
						</span>
						<span v-else>
							<button class="button is-small" @click="focus('address')"><i class="fa fa-pencil"></i></button>
						</span>
					</td>
				</tr>
				<tr :class="{'active-input': editEmail}">
					<td><b>Email</b></td>
					<td>
						<span v-if="editEmail">
							<input type="email" v-model="form.email" class="input" autofocus="true" @keyup.enter="save('email')">
							<p class="help dang-msg"> {{error.email}} </p>
							<hr>
							<button class="button is-link is-small" @click="save('email')">Save Changes</button>
							<br><br>
						</span>
						<span v-else>
							{{email}}
						</span>
					</td>
					<td>
						<span v-if="editEmail">
							<button class="button is-small" @click="editEmail = false"><i class="fa fa-times has-text-danger"></i></button>
						</span>
						<span v-else>
							<button class="button is-small" @click="focus('email')"><i class="fa fa-pencil"></i></button>
						</span>
					</td>
				</tr>
			</table>
		</div>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {
	// Vue.prototype.$http = axios
	new Vue({
	    el: '#app',
	    data: {
	    	fn: '<?php echo $record->fn ?>',
	    	mn: '<?php echo $record->mn ?>',
	    	ln: '<?php echo $record->ln ?>',
	    	dob: '<?php echo $record->dob ?>',
	    	sex: '<?php echo $record->sex ?>',
	    	cn: '<?php echo $record->cn ?>',
	    	address: '<?php echo $record->address ?>',
	    	email: '<?php echo $record->email ?>',

	    	editName: false,
	    	editDob: false,
	    	editSex: false,
	    	editCn: false,
	    	editAddress: false,
	    	editEmail: false,

	    	form:{
	    		fn: '<?php echo $record->fn ?>',
	    		mn: '<?php echo $record->mn ?>',
	    		ln: '<?php echo $record->ln ?>',
		    	dob: '<?php echo $record->dob ?>',
		    	sex: '<?php echo $record->sex ?>',
		    	cn: '<?php echo $record->cn ?>',
		    	address: '<?php echo $record->address ?>',
		    	email: '<?php echo $record->email ?>'
	    	},
	    	error:{
	    		fn: '',
	    		ln: '',
	    		dob: '',
	    		email: ''
	    	}
	    },
	    created(){
	    	this.save('a')
	    },
	    watch: {
	    	editName(val){
	    		if(!val){
	    			this.form.fn = this.fn
	    			this.form.mn = this.mn
	    			this.form.ln = this.ln
	    			this.error.fn = ''
	    			this.error.ln = ''
	    		}
	    	},
	    	editSex(val){
	    		if(!val){
	    			this.form.sex = this.sex
	    		}
	    	},
	    	editDob(val){
	    		if(!val){
	    			this.form.dob = this.dob
	    			this.error.dob = ''
	    		}
	    	},
	    	editCn(val){
	    		if(!val){
	    			this.form.cn = this.cn
	    		}
	    	},
	    	editAddress(val){
	    		if(!val){
	    			this.form.address = this.address
	    		}
	    	},
	    	editEmail(val){
	    		if(!val){
	    			this.form.email = this.email
	    			this.error.email = ''
	    		}
	    	}
	    },
	    computed: {
	    	fullName(){
	    		return this.form.fn + " " + this.form.mn + " " + this.form.ln
	    	}
	    },
	    methods: {
	    	save(value){
	    		this.$http.get('<?php echo base_url() ?>student_users/populate_class_sched')
	    		.then(res => {
	    			console.log(res);

	    		})
	    		
	    	},
	    	after_update(data, value){
	    		let msg = ' successfully updated!'
	    		if(value == 'name'){
	    			// this.fn = data[0].fn
	    			// this.mn = data[0].mn
	    			// this.ln = data[0].ln
	    			// this.editName = false
	    			msg = 'Name' + msg
	    		}else if(value == 'dob'){
	    			this.dob = data[0].dob
	    			this.editDob = false
	    			msg = 'Date of birth' + msg
	    		}else if(value == 'sex'){
	    			this.sex = data[0].sex
	    			this.editSex = false
	    			msg = 'Sex' + msg
	    		}else if(value == 'cn'){
	    			this.cn = data[0].cn
	    			this.editCn = false
	    			msg = 'Contact number' + msg
	    		}else if(value == 'address'){
	    			this.address = data[0].address
	    			this.editAddress = false
	    			msg = 'Address' + msg
	    		}else if(value == 'email'){
	    			this.email = data[0].email
	    			this.editEmail = false
	    			msg = 'Email' + msg
	    		}
	    		swal(msg).then(x => {
	    			if(value == 'name'){
	    				window.location.href = '<?php echo base_url() ?>profile'
	    			}
	    		})
	    	},
	    	focus(value){
	    		this.editName = false
	    		this.editSex = false
	    		this.editDob = false
	    		this.editCn = false
	    		this.editAddress = false
	    		this.editEmail = false

	    		if(value == 'name'){
	    			this.editName = true
	    		}else if(value == 'sex'){
	    			this.editSex = true
	    		}else if(value == 'dob'){
	    			this.editDob = true
	    		}else if(value == 'cn'){
	    			this.editCn = true
	    		}else if(value == 'address'){
	    			this.editAddress = true
	    		}else if(value == 'email'){
	    			this.editEmail = true
	    		}


	    	},	
	    	is_valid(value){
	    		let ok = true
	    		const data = []
	    		const msg = 'This field is required'
	    		if(value == 'name'){
	    			if(!this.form.fn){
	    				this.error.fn = msg
	    				ok = false
	    			}else{
	    				this.error.fn = ''
	    			}
	    			if(!this.form.ln){
	    				this.error.ln = msg
	    				ok = false
	    			}else{
	    				this.error.ln = ''
	    			}
	    			data.push({
	    				fn: this.form.fn,
	    				mn: this.form.mn,
	    				ln: this.form.ln
	    			})
	    		}else if(value == 'dob'){
	    			if(!Date.parse(this.form.dob)){
		        		this.error.dob = msg
		        		ok = false
		        	}else{
		        		this.error.dob = ''
		        	}
		        	data.push({
		        		dob: this.form.dob
		        	})
	    		}else if(value == 'sex'){
	    			data.push({
		        		sex: this.form.sex
		        	})
	    		}else if(value == 'cn'){
	    			data.push({
		        		cn: this.form.cn
		        	})
	    		}else if(value == 'address'){
	    			data.push({
		        		address: this.form.address
		        	})
	    		}else if(value == 'email'){
	    			if(!this.validEmail(this.form.email)){
	    				this.error.email = 'Please enter valid email'
			        	ok = false
	    			}else{
	    				this.error.email = ''
	    			}
	    			data.push({
		        		email: this.form.email
		        	})
	    		}
	    		return {
	    			valid: ok,
	    			data: data
	    		}
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
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>