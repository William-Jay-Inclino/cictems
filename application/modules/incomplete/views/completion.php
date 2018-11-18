<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">
<style>
	.is-note{
       color: #9c9fa6
     }
     .row-12{
		width: 14%
	}
	.table{
		table-layout: fixed;
	}
</style>
<section class="section" id="app" v-cloak>
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a href="<?php echo base_url() ?>incomplete">List</a></li>
		    <li><a :href="'<?php echo base_url() ?>incomplete/classes/' + studID + '/' + termID">Incomplete Classes</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Completion</a></li>
		  </ul>
		</nav>
		<div class="box">
			<div class="columns">
				<div class="column">
					<h5 class="title is-5">
					<table class="table">
						<tr>
							<td class="is-note">Name:</td>
							<td> <?php echo $record->name; ?> </td>
						</tr>
						<tr>
							<td class="is-note">Control No:</td>
							<td> <?php echo $record->controlNo; ?> </td>
						</tr>
					</table>
				</h5>
				</div>
				<div class="column" v-show="show_complied">
					<h5 class="title is-5 has-text-success is-pulled-right">
						<i class="fa fa-check"></i>
						Complied
					</h5>
				</div>
			</div>
			
		</div>
		<div class="box">
			<table class="table is-fullwidth is-centered">
				<thead>
					<th>Class Code</th>
					<th>Description</th>
					<th>Day</th>
					<th>Time</th>
					<th>Room</th>
					<th>Instructor</th>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $class->classCode ?></td>
						<td><?php echo $class->subDesc ?></td>
						<td><?php echo $class->day ?></td>
						<td><?php echo $class->class_time ?></td>
						<td><?php echo $class->roomName ?></td>
						<td><?php echo $class->faculty ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="box">
			<table class="table is-fullwidth is-centered">
				<th class="row-14">Prelim</th>
				<th class="row-14">Midterm</th>
				<th class="row-14">Prefi</th>
				<th class="row-14">Finals</th>
				<th class="row-14">Final Grade</th>
				<th class="row-14">Equivalent</th>
				<th>Remark</th>
				<tr>
					<td>
						<span v-if="remarks == 'Incomplete'">
							<multiselect :show-no-results="false" v-bind="override" :options-limit="2" v-model="prelim" track-by="grade" label="grade" :options="grades" placeholder=""></multiselect>
							<p class="help has-text-danger"> {{error.prelim}} </p>
						</span>
						<span v-else>
							<p v-if="prelim != null">{{prelim.grade}}</p>
						</span>
					</td>
					<td>
						<span v-if="remarks == 'Incomplete'">
							<multiselect :show-no-results="false" v-bind="override" :options-limit="2" v-model="midterm" track-by="grade" label="grade" :options="grades" placeholder=""></multiselect>
							<p class="help has-text-danger"> {{error.midterm}} </p>
						</span>
						<span v-else>
							<p v-if="midterm != null">{{midterm.grade}}</p>
						</span>
					</td>
					<td>
						<span v-if="remarks == 'Incomplete'">
							<multiselect :show-no-results="false" v-bind="override" :options-limit="2" v-model="prefi" track-by="grade" label="grade" :options="grades" placeholder=""></multiselect>
							<p class="help has-text-danger"> {{error.prefi}} </p>
						</span>
						<span v-else>
							<p v-if="prefi != null">{{prefi.grade}}</p>
						</span>
					</td>
					<td>
						<span v-if="remarks == 'Incomplete'">
							<multiselect :show-no-results="false" v-bind="override" :options-limit="2" v-model="final" track-by="grade" label="grade" :options="grades" placeholder=""></multiselect>
							<p class="help has-text-danger"> {{error.final}} </p>
						</span>
						<span v-else>
							<p v-if="final != null">{{final.grade}}</p>
						</span>
					</td>
					<td> {{fg}} </td>
					<td> {{equiv}} </td>
					<td> {{remarks}} </td>
				</tr>
			</table>
			<hr>
			<button class="button is-link is-pulled-right" @click="comply" v-if="remarks == 'Incomplete'" >Comply</button>
			<br><br>
		</div>

	</div>

</section>

<script>

document.addEventListener('DOMContentLoaded', function() {
	Vue.component('multiselect', window.VueMultiselect.default) 
	new Vue({
	    el: '#app',
	    data: {
	    	termID: '<?php echo $termID ?>',
	    	classID: '<?php echo $classID ?>',
	    	studID: '<?php echo $studID ?>',
	    	show_complied: false,
	    	prelim: null,
	    	midterm: null,
	    	prefi: null,
	    	final: null,
	    	fg: '',
	    	equiv: '',
	    	remarks: '',
	       	error: {
	       		prelim: '',
	       		midterm: '',
	       		prefi: '',
	       		final: ''
	       	}
	    },
	    created() {
	        this.get_grades()
	    },
	    watch: {

	    },
	    computed: {
	    	override() {
			    return {
			     tabIndex: 0,
			    }
			},
			grades(){
	    		const grades = []
	    		let g 
	    		grades.push(
	    			{grade: 'INC'},
	    			{grade: 'Dropped'},
	    		)
	    		for (let i =100; i >= 59.99; i -= 0.01) {
	    			g = i.toFixed(2)
			        grades.push({
	    				grade: g
	    			})
			    }
	    		return grades
	    	}
	    },
	    methods: {
	    	get_grades(){
	    		this.$http.get('<?php echo base_url() ?>incomplete/get_grades/'+this.classID+'/'+this.studID)
	            .then(response => {
	               console.log(response.body)
	               const c = response.body
	               this.prelim = {grade: c.prelim}
	               this.midterm = {grade: c.midterm}
	               this.prefi = {grade: c.prefi}
	               this.final = {grade: c.final}
	               this.fg = c.finalgrade
	               this.equiv = c.equiv
	               this.remarks = c.remarks
	               if(c.remarks != 'Incomplete'){
	               	this.show_complied = true
	               }
	            }, response => {
					this.get_grades()
				})
	    	},
	    	comply(){
	    		if(this.checkForm()){

	    			const data = {
	    				studID: this.studID,
	    				classID: this.classID,
	    				prelim: this.prelim,
	    				midterm: this.midterm,
	    				prefi: this.prefi,
	    				final: this.final
	    			}
	    			this.$http.post('<?php echo base_url() ?>incomplete/comply', data)
		            .then(response => {
		               console.log(response.body)
		               const c = response.body
		               this.fg = c.fg
		               this.equiv = c.equiv
		               this.remarks = c.remarks
		               this.show_complied = true
		               swal('Success!', 'Student is successfully complied', 'success')
		            }, response => {
						this.comply()
					})
	    		}
	    	},
	    	checkForm(){
	    		let ok = true
	    		const msg = 'Please input a grade'
	    		if(!this.prelim || !this.midterm || !this.prefi || !this.final){
	    			swal('Unable to comply!', 'All fields should have a grade', 'warning')
	    			ok = false
	    		}else{
	    			if(isNaN(this.prelim.grade)){
		    			this.error.prelim = msg 
		    			ok = false
		    		}else{
		    			this.error.prelim = '' 
		    		}
		    		if(isNaN(this.midterm.grade)){
		    			this.error.midterm = msg 
		    			ok = false
		    		}else{
		    			this.error.midterm = '' 
		    		}
		    		if(isNaN(this.prefi.grade)){
		    			this.error.prefi = msg 
		    			ok = false
		    		}else{
		    			this.error.prefi = '' 
		    		}
		    		if(isNaN(this.final.grade)){
		    			this.error.final = msg 
		    			ok = false
		    		}else{
		    			this.error.final = '' 
		    		}
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

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>