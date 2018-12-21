
<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
	</div>
	<br>
	<div class="container" style="max-width: 600px;">
		<div class="box">
			<table class="table is-fullwidth is-centered">
				<thead>
					<th>Prelim</th>
					<th>Midterm</th>
					<th>Prefi</th>
					<th>Finals</th>
				</thead>
				<tbody>
					<td>
						<input type="number" class="input has-text-centered" v-model.number.trim="form.prelim" onpaste="return false;" onKeyPress="if(this.value.length==2 && event.keyCode>47 && event.keyCode < 58)return false;">
					</td>
					<td>
						<input type="number" class="input has-text-centered" v-model.number.trim="form.midterm" onpaste="return false;" onKeyPress="if(this.value.length==2 && event.keyCode>47 && event.keyCode < 58)return false;">
					</td>
					<td>
						<input type="number" class="input has-text-centered" v-model.number.trim="form.prefi" onpaste="return false;" onKeyPress="if(this.value.length==2 && event.keyCode>47 && event.keyCode < 58)return false;">
					</td>
					<td>
						<input type="number" class="input has-text-centered" v-model.number.trim="form.final" onpaste="return false;" onKeyPress="if(this.value.length==2 && event.keyCode>47 && event.keyCode < 58)return false;">
					</td>
				</tbody>
			</table>
			<hr>
			<button class="button is-link is-pulled-right" v-on:click="update">Update</button>
			<br><br>
		</div>
	</div>

</section>






<script>

document.addEventListener('DOMContentLoaded', function() {

	new Vue({
	    el: '#app',
	    data: {
	    	page_title: 'Grade Formula',
	    	form:{
	    		prelim: '<?php echo $percentage->prelim ?>',
	    		midterm: '<?php echo $percentage->midterm ?>',
	    		prefi: '<?php echo $percentage->prefi ?>',
	    		final: '<?php echo $percentage->final ?>'
	    	}
	    },
	    computed: {
	    	total_percentage(){
	    		const f = this.form
	    		return parseFloat(f.prelim) + parseFloat(f.midterm) + parseFloat(f.prefi) + parseFloat(f.final)
	    	}
	    },
	    methods: {
	    	update(){
	    		const f = this.form 
	    		if(this.checkForm(f)){
	    			this.$http.post('<?php echo base_url() ?>maintenance_formula/update',f)
		    		.then(response => {
		    			const c = response.body
		    			f.prelim = c.prelim
		    			f.midterm = c.midterm
		    			f.prefi = c.prefi
		    			f.final = c.final
	    				swal('Grade formula successfully updated!', {
					      icon: 'success',
					    });
		    		})
	    		}
	    	},
	    	checkForm(f){
	    		let ok = true 
	    		let msg = 'Please enter a valid value'
	    		if(!(f.prelim && f.midterm && f.prefi && f.final)){
	    			ok = false
	    		}else if(f.prelim < 0 || f.midterm < 0 || f.prefi < 0 || f.final < 0){
	    			ok = false
	    		}else if(this.total_percentage != 100){
	    			ok = false 
	    			msg = 'Total percentage must be 100. Current percentage is '+this.total_percentage
	    		}

	    		if(ok == false){
	    			swal(msg, {
				      icon: 'warning',
				    });
	    		}
	    		return ok
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