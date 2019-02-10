<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<div id="app" v-cloak>
<section class="section">
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.list">List</a></li>
		    <li><a :href="page.show">Show</a></li>
		    <li class="is-active"><a href="#" aria-current="page">T-shirt sizes</a></li>
		  </ul>
		</nav>
	</div>
	<div class="container" style="max-width: 600px;">
		<div class="box">
			<table class="table is-fullwidth">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>T-shirt size</th>
					<th width="5%"></th>
				</thead>
				<tbody>
					<tr v-for="student, i in students">
						<td> {{i + 1}} </td>
						<td> {{student.name}} </td>
						<td>
							<multiselect @input="updateSize(i)" v-model="student.tsize" track-by="tsize" label="tsize" :options="tsizes" :allow-empty="false"></multiselect>
						</td>
						<td>
							<span v-if="student.updated" class="icon has-text-success"> <i class="fa fa-check"></i> </span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>


</div>

<script>
	
	document.addEventListener('DOMContentLoaded', function() {
		Vue.component('multiselect', window.VueMultiselect.default)	
		new Vue({
		    el: '#app',
		    data: {
		    	page:{
		    		show: '<?php echo base_url()."maintenance/fees/show/".$feeID ?>',
		    		list: '<?php echo base_url() ?>maintenance/fees',
		    	},
		    	id: '<?php echo $feeID ?>',
		    	students: [],
		    	tsizes: [
		    		{tsize: 'XXL'},
		    		{tsize: 'XL'},
		    		{tsize: 'L'},
		    		{tsize: 'M'},
		    		{tsize: 'S'},
		    		{tsize: '20'},
		    		{tsize: '18'},
		    		{tsize: '16'}
		    	]
		    },
		    created(){
		    	this.get_tshirt_size()
		    },
		    methods: {
		    	get_tshirt_size(){
		    		this.$http.get('<?php echo base_url() ?>maintenance_fees/get_tshirt_size/'+this.id)
			        	.then(res => {
		        		this.students = res.body.map(s => {
		        			s.tsize = {tsize: s.tsize}
		        			s.updated = false
		        			return s
		        		})
		        		console.log(this.students);
					 }, e => {
					 	console.log(e)

					 })
		    	},
		    	updateSize(i){
		    		const student = this.students[i]
		    		student.updated = true
		    		if(student.tsize == null) student.tsize = {tsize: ''}
		    		this.$http.post('<?php echo base_url() ?>maintenance_fees/update_tsize', student)
			        	.then(res => {
			        		console.log(res.body);
		        		
					 }, e => {
					 	console.log(e)

					 })

		    	}
		    },

		   http: {
            emulateJSON: true,
            emulateHTTP: true
    		}


		});


	}, false);

</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
