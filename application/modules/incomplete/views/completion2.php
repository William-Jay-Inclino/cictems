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
						<multiselect :show-no-results="false" v-bind="override" :options-limit="2" v-model="prelim" track-by="grade" label="grade" :options="grades" placeholder=""></multiselect>
					</td>
					<td>
						<multiselect :show-no-results="false" v-bind="override" :options-limit="2" v-model="midterm" track-by="grade" label="grade" :options="grades" placeholder=""></multiselect>
					</td>
					<td>
						<multiselect :show-no-results="false" v-bind="override" :options-limit="2" v-model="prefi" track-by="grade" label="grade" :options="grades" placeholder=""></multiselect>
					</td>
					<td>
						<multiselect :show-no-results="false" v-bind="override" :options-limit="2" v-model="final" track-by="grade" label="grade" :options="grades" placeholder=""></multiselect>
					</td>
					<td> {{fg}} </td>
					<td> {{equiv}} </td>
					<td> {{remarks}} </td>
				</tr>
			</table>
			<hr>
			<button class="button is-link is-pulled-right" @click="comply">Comply</button>
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
	    	prelim: null,
	    	midterm: null,
	    	prefi: null,
	    	final: null,
	    	fg: '',
	    	equiv: '',
	    	remarks: '',
	       
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
	            }, response => {
					this.get_grades()
				})
	    	},
	    	comply(){
	    		alert('asd')
	    	}
	    }
	})

}, false)



</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>