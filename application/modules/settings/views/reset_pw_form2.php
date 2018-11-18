<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma-tooltip/bulma-tooltip.min.css">
<section id="app" class="section" v-cloak>
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="settings_link">Settings</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Reset password</a></li>
		  </ul>
		</nav>
	</div>
	<br>
	<div class="container" style="max-width: 600px">
		<h3 class="title is-3 has-text-centered has-text-primary">Reset password</h3>
		<div class="box">
			<button class="button is-link is-outlined" @click="generate_new_pw">Generate new password</button> 
			<button class="button tooltip is-pulled-right" data-tooltip="Hover on the lock icon to view the password" v-show="has_pw">
				<i class="fa fa-info has-text-info"></i>
			</button>
			<br><br>
			<div v-if="has_pw">
				<div class="field has-addons">
				  <div class="control" style="width: 100%">
				    <input class="input" :type="pw_field_type" class="input" v-model="new_pass" readonly>
				  </div>
				  <div class="control">
				    <a class="button is-outlined is-link" v-on:mouseover="togglePass('in')" v-on:mouseout="togglePass('out')">
				    	<span v-if="showPass">
				      		<i class="fa fa-unlock"></i>
				    	</span>
				    	<span v-else>
				    		<i class="fa fa-lock"></i>
				    	</span>
				    </a>
				  </div>
				</div>
			</div>
		</div>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {
	new Vue({
	    el: '#app',
	    data: {
	    	settings_link: '<?php echo base_url() ?>settings',
	    	showPass: false,
	    	has_pw: false,
	    	new_pass: '',
	    	pw_field_type: 'password'
	    },
	    created() {
	        
	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {
	    	generate_new_pw(){
	    		swal({
				  title: "Are you sure?",
				  text: "You will be given a new password",
				  icon: "info",
				  buttons: {
				  	cancel: true,
				  	confirm: {
				  		closeModal: false
				  	}
				  }
				})
				.then((ok) => {
				  if (ok) {
				    this.$http.get('<?php echo base_url() ?>settings/generate_new_pw')
		        	.then(response => {
		        		const c = response.body
		        		if(c.newPassword){
		        			swal('Success', 'You have now a new password!', 'success')
		        			this.new_pass = c.newPassword
		        			this.has_pw = true
		        		}else{
		        			alert('Oooops something went wrong! '+c)
		        			window.location.href = '<?php echo base_url() ?>/settings/password-reset'
		        		}
					 })
				  }
				})
	    	},
	    	togglePass(action){
	    		if(action == 'in'){
	    			this.showPass = true
	    			this.pw_field_type = 'text'
	    		}else{
	    			this.showPass = false
	    			this.pw_field_type = 'password'
	    		}
	    	}
	    }
	})

}, false)



</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>