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
	.is-note{
		color: #9c9fa6
	}
	.dang-msg{
		color: #d9534f;
		font-weight: bold;
	}
	.table__wrapper {
      overflow-x: auto;
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
			<div class="table__wrapper">
				<table class="table is-fullwidth">
					<tr :class="{'active-input': editName}">
						<td><b>Name</b></td>
						<td>
							<span v-if="editName">
								<input type="text" v-model="form.fn" class="input" autofocus="true" placeholder="Firstname" @keyup.enter="save('name')"> 
								<p class="help dang-msg"> {{error.fn}} </p>
								<br>
								<input type="text" v-model="form.mn" class="input" placeholder="Middlename" @keyup.enter="save('name')"> <br>
								<p>&nbsp;</p>
								<input type="text" v-model="form.ln" class="input" placeholder="Lastname" @keyup.enter="save('name')">
								<p class="help dang-msg"> {{error.ln}} </p>
								<hr>
								<button class="button is-link is-small" @click="save('name')">Save Changes</button>
								<br><br>
							</span>
							<span v-else>
								{{fullName}}
							</span>
						</td>
						<td>
							<?php if($roleID != 4): ?>
							<span v-if="editName">
								<button class="button is-small" @click="editName = false"><i class="fa fa-times has-text-danger"></i></button>
							</span>
							<span v-else>
								<button class="button is-small" @click="focus('name')"><i class="fa fa-pencil"></i></button>
							</span>
							<?php endif ?>
						</td>
					</tr>
					<tr :class="{'active-input': editSex}">
						<td><b>Sex</b></td>
						<td>
							<span v-if="editSex">
								<div class="select">
								  <select v-model="form.sex">
								    <option value="Male">Male</option>
								    <option value="Female">Female</option>
								  </select>
								</div>
								<hr>
								<button class="button is-link is-small" @click="save('sex')">Save Changes</button>
								<br><br>
							</span>
							<span v-else>
								{{sex}}
							</span>
						</td>
						<td>
							<?php if($roleID != 4): ?>
							<span v-if="editSex">
								<button class="button is-small" @click="editSex = false"><i class="fa fa-times has-text-danger"></i></button>
							</span>
							<span v-else>
								<button class="button is-small" @click="focus('sex')"><i class="fa fa-pencil"></i></button>
							</span>
							<?php endif ?>
						</td>
					</tr>
					<tr :class="{'active-input': editDob}">
						<td><b>Date of birth</b></td>
						<td>
							<span v-if="editDob">
								<input type="date" v-model="form.dob" class="input" autofocus="true" @keyup.enter="save('dob')">
								<p class="help"><i>Month / Day / Year</i></p>
								<p class="help dang-msg"> {{error.dob}} </p>
								<hr>
								<button class="button is-link is-small" @click="save('dob')">Save Changes</button>
								<br><br>
							</span>
							<span v-else>
								{{dob}}
							</span>
						</td>
						<td>
							<?php if($roleID != 4): ?>
							<span v-if="editDob">
								<button class="button is-small" @click="editDob = false"><i class="fa fa-times has-text-danger"></i></button>
							</span>
							<span v-else>
								<button class="button is-small" @click="focus('dob')"><i class="fa fa-pencil"></i></button>
							</span>
							<?php endif ?>
						</td>
					</tr>
					<tr :class="{'active-input': editCn}">
						<td><b>Contact No.</b></td>
						<td>
							<form @submit.prevent="save('cn')">
								<span v-if="editCn">
									<input type="text" class="input" v-model.trim="form.cn" pattern="^[1-9][0-9]*$" required maxlength="10">
									<p class="help">format: 9038429187</p>
									<hr>
									<button type="submit" class="button is-link is-small">Save Changes</button>
									<br><br>
								</span>
								<span v-else>
									{{cn}}
								</span>
							</form>
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
	    		const res = this.is_valid(value)
	    		if(res.valid){
	    			this.$http.post('<?php echo base_url() ?>profile/save',{data: res.data[0]})
		        	.then(response => {
		        		if(response.body == ''){
		        			this.after_update(res.data, value)
		        		}else{
		        			alert('Oooops something went wrong!')
		        			window.location.href = '<?php echo base_url() ?>/profile'
		        		}
					 })
	    		}
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
<?php if($roleID == 4): ?>
		<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
<?php endif ?>