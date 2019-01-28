
<section id="app" class="section" v-cloak>
	<div class="container">
		<button class="button is-primary" @click="sendSMS">Send SMS</button>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {

	new Vue({
	    el: '#app',
	    data: {

	       
	    },
	    created() {

	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {
	    	sendSMS(){
	    		this.$http.post('<?php echo base_url() ?>sms/sendSMS')
	        	.then(res => {
	        		const c = res.body
	        		console.log(c)
				 }, e => {
				 	console.log(e.body);

				 })
	    	}
	    },

	   http: {
        emulateJSON: true,
        emulateHTTP: true
		}
	})

}, false)



</script>

