<section id="app" class="section" v-cloak>
	<div class="container">
		<nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
		  <ul>
		    <li><a :href="page.main">Main</a></li>
		    <li><a :href="page.back">Selected Class</a></li>
		    <li class="is-active"><a href="#" aria-current="page">Update Grade</a></li>
		  </ul>
		</nav>
		<br>
	</div>

	<div class="container" style="max-width: 500px">
		<h5 class="title is-5 has-text-centered">Update grade in {{grading.toUpperCase()}} </h5>
		<div class="box">
			<table class="table is-fullwidth">
				<tr v-for="student,i in students">
					<td :class="statusClass(student.remarks)" width="65%"> {{student.name}} </td>
					<td class="has-text-centered">
						<span v-if="student.remarks == 'Dropped'" class="has-text-danger">
							Dropped
						</span>
						<span v-else>
							<input type="number" class="input has-text-centered" v-model.number.trim="student.grading" onpaste="return false;" onKeyPress="if(this.value.length==3 && event.keyCode>47 && event.keyCode < 58)return false;">
						</span>
					</td>
				</tr>
			</table>
			<hr>
			<input type="button" class="button is-link is-pulled-right" value="Update" v-on:click="submitForm">
			<br><br>
		</div>

	</div>

</section>

<script>
	document.addEventListener('DOMContentLoaded', function(){

		new Vue({
			el: '#app',
			data:{
				page: {
		    		main: '<?php echo base_url() ?>classes',
		    		back: '<?php echo base_url()."class-selected/".$classID ?>'
		    	},
				classID: '<?php echo $classID ?>',
				grading: '<?php echo $grading ?>',
		    	students: []
			},
			created(){
				this.fetch_Students_in_Class()
			},
			watch:{


			},
			computed:{
				capitalize_grading(){
					return this.grading.replace(/^\w/, c => c.toUpperCase())
				}
			},
			methods:{
		    	fetch_Students_in_Class(){
		    		this.$http.get('<?php echo base_url() ?>classes/fetch_Students_in_Class/'+this.grading+'/'+this.classID)
		            .then(response => {
		               this.students = response.body
		            })
		    	},
		    	submitForm(){
		    		this.$http.post('<?php echo base_url() ?>classes/update_by_group',{students: this.students, classID: this.classID, grading: this.grading})
		            .then(response => {
		               	console.log(response.body)
		               	swal(this.capitalize_grading+' grades successfully updated!', {icon: 'success'})
		               	.then((x) => {
		               		if(x){
		               			window.location.href='<?php echo base_url() ?>class-selected/'+this.classID
		               		}
		               	})
		            })
		    	},
		    	statusClass(rem){
		    		if(rem == 'Dropped'){
		    			return {'has-text-danger': true}
		    		}
		    	}
			},

		   http: {
		      emulateJSON: true,
		      emulateHTTP: true
			}

		});

	});
</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-swal/vue-swal.min.js"></script>