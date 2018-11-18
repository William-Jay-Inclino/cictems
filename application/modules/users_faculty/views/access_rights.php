<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma_switch/bulma-switch.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bulma_divider/bulma-divider.min.css">

<div id="app" v-cloak>
<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li><a :href="page.show">Show</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Access Rights</a></li>
		  </ul>
		</nav>
	</div>
	<div class="container" style="max-width: 600px;">
		<div class="box">
			<table class="table is-fullwidth">
				<tr>
					<td width="50%"><b>Username: </b></td>
					<td width="50%"><?php echo $record['user']->userName ?></td>
				</tr>
				<tr>
					<td><b>Name: </b></td>
					<td><?php echo $record['user']->name ?></td>
				</tr>
			</table>
		</div>
		<div class="box">
			<h5 class="title is-4 has-text-primary">Modules</h5>
			<hr>
			<table class="table is-fullwidth">
				<tr>
					<td width="50%">Classes</td>
					<td width="50%">
						<div class="field">
						  <input id="switchClasses" type="checkbox" name="switchNormal" class="switch is-rounded" @change="updateAccess(1)" <?php if(in_array("1", $record['modules'])){echo 'checked="checked"';} ?> >
						  <label for="switchClasses"></label>
						</div>
					</td>
				</tr>
			</table>
			<div class="is-divider" data-content="TRANSACTIONS"></div>
			<table class="table is-fullwidth">
				<tr>
					<td width="50%">Enrollment</td>
					<td width="50%">
						<div class="field">
						  <input id="switchEnrol" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(2)" <?php if(in_array("2", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchEnrol"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Grade</td>
					<td width="50%">
						<div class="field">
						  <input id="switchGrade" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(3)" <?php if(in_array("3", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchGrade"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Payment</td>
					<td width="50%">
						<div class="field">
						  <input id="switchPayment" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(4)" <?php if(in_array("4", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchPayment"></label>
						</div>
					</td>
				</tr>
			</table>
			<div class="is-divider" data-content="MAINTENANCE"></div>
			<table class="table is-fullwidth">
				<tr>
					<td width="50%">Term</td>
					<td width="50%">
						<div class="field">
						  <input id="switchTerm" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(5)" <?php if(in_array("5", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchTerm"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Room</td>
					<td width="50%">
						<div class="field">
						  <input id="switchRoom" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(6)" <?php if(in_array("6", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchRoom"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Course</td>
					<td width="50%">
						<div class="field">
						  <input id="switchCourse" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(7)" <?php if(in_array("7", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchCourse"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Prospectus</td>
					<td width="50%">
						<div class="field">
						  <input id="switchProspectus" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(8)" <?php if(in_array("8", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchProspectus"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Section</td>
					<td width="50%">
						<div class="field">
						  <input id="switchSection" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(9)" <?php if(in_array("9", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchSection"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Subject</td>
					<td width="50%">
						<div class="field">
						  <input id="switchSubject" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(10)" <?php if(in_array("10", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchSubject"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Class</td>
					<td width="50%">
						<div class="field">
						  <input id="switchClass" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(11)" <?php if(in_array("11", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchClass"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Grade Formula</td>
					<td width="50%">
						<div class="field">
						  <input id="switchFormula" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(12)" <?php if(in_array("12", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchFormula"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Fees</td>
					<td width="50%">
						<div class="field">
						  <input id="switchFees" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(13)" <?php if(in_array("13", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchFees"></label>
						</div>
					</td>
				</tr>
			</table>
			<div class="is-divider" data-content="USERS"></div>
			<table class="table is-fullwidth">
				<tr>
					<td width="50%">Student</td>
					<td width="50%">
						<div class="field">
						  <input id="switchStudent" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(14)" <?php if(in_array("14", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchStudent"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Faculty</td>
					<td width="50%">
						<div class="field">
						  <input id="switchFac" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(15)" <?php if(in_array("15", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchFac"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Staff</td>
					<td width="50%">
						<div class="field">
						  <input id="switchStaff" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(16)" <?php if(in_array("16", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchStaff"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Guardian</td>
					<td width="50%">
						<div class="field">
						  <input id="switchGuard" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(17)" <?php if(in_array("17", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchGuard"></label>
						</div>
					</td>
				</tr>
			</table>
			<div class="is-divider" data-content="REPORTS"></div>
			<table class="table is-fullwidth">
				<tr>
					<td width="50%">Prospectus</td>
					<td width="50%">
						<div class="field">
						  <input id="switchRpros" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(18)" <?php if(in_array("18", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchRpros"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Student</td>
					<td width="50%">
						<div class="field">
						  <input id="switchRstud" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(19)" <?php if(in_array("19", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchRstud"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Grade</td>
					<td width="50%">
						<div class="field">
						  <input id="switchRgrade" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(20)" <?php if(in_array("20", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchRgrade"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Fees</td>
					<td width="50%">
						<div class="field">
						  <input id="switchRfees" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(21)" <?php if(in_array("21", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchRfees"></label>
						</div>
					</td>
				</tr>
				<tr>
					<td width="50%">Class Schedules</td>
					<td width="50%">
						<div class="field">
						  <input id="switchRsched" type="checkbox" name="switchRoundedDefault" class="switch is-rounded" @change="updateAccess(22)" <?php if(in_array("22", $record['modules'])){echo 'checked="checked"';} ?>>
						  <label for="switchRsched"></label>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {

		new Vue({
		    el: '#app',
		    data: {
		    	uID: '<?php echo $record['user']->uID ?>',
		    	page:{
		    		show: '<?php echo base_url()."users/faculty/show/".$record['facID'] ?>',
		    		list: '<?php echo base_url() ?>users/faculty'
		    	},
		    },
		    methods: {
		    	updateAccess(val){
		    		this.$http.post('<?php echo base_url() ?>users_faculty/updateAccess', {uID: this.uID, modID: val})
		        	.then(response => {
		        		if(response.body != ''){
		        			alert('Oooops! Something wrong happen')
		        			window.location.href = '<?php echo base_url()."users/faculty/access-rights/".$record['facID'] ?>'
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


