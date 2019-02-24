<style>
	.is-note{
		color: #9c9fa6
	}
</style>
<section id="app" class="section" v-cloak>
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a href="<?php echo base_url() ?>e-confirmation">List</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Show</a></li>
		  </ul>
		</nav>
		<div class="box">
			<div class="columns">
				<div class="column">
					<h5 class="title is-5">
						Name: <span class="is-note"><?php echo $student; ?></span>
					</h5>
				</div>
				<div class="column">
					<button class="button is-link is-pulled-right" @click="enrolStudent">Confirm</button>
				</div>
			</div>
		</div>
		<div class="box">
			<h5 class="title is-5">Classes selected</h5>
			<hr>
			<table class="table is-fullwidth is-centered">
                <thead>
                   <tr>
                      <th style="text-align: left">Class Code</th>
                      <th style="text-align: left">Description</th>
                      <th>Units</th>
                      <th>Days</th>
                      <th>Time</th>
                   </tr>
                </thead>
                <tbody>
                	<?php
                		$tot = 0;
                		foreach($records as $record){ 
                		?>
							<tr>
								<td style="text-align: left"> 
									<?php 
										echo $record->classCode;
										if($record->type == 'lab'){echo " <b>(lab)</b>";}
									?> 
								</td>
								<td style="text-align: left"> <?php echo $record->subDesc ?> </td>
								<td> <?php echo $record->units ?> </td>
								<td> <?php echo $record->day ?> </td>
								<td> <?php echo $record->class_time ?> </td>
							</tr>
							<?php
							$tot += $record->units;
                		}
                	?>
                   <tr>
                      <th></th>
                      <th>Total number of units: </th>
                      <th> <?php echo $tot; ?> </th>
                      <th></th>
                      <th colspan="2"></th>
                   </tr>
                </tbody>
             </table>
		</div>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {

	new Vue({
	    el: '#app',
	    data: {
	    	term: '<?php echo $current_term->term ?>'
	    },
	    created() {

	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {
	    	enrolStudent(){
	    		swal({
		           title: "Confirm?",
		           text: "Once confirmed, student will be enrolled in the term: "+this.term,
		           icon: "warning",
		           buttons: true,
		         })
		         .then((confirm) => {
		           if(confirm) {
		             this.$http.post('<?php echo base_url() ?>e_confirmation/set_enrolled', {studID: '<?php echo $studID ?>'})
		            .then(response => {
		               swal("Succesfully enrolled student! ", {
		                  icon: "success",
		                })
		               .then(s => {
		               		window.location.href = "<?php echo base_url() ?>e-confirmation"
		               })
		            })
		           }
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

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>