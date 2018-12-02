<script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.css">

<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title">Class Schedules</h3>
		<div class="box">
          <div class="columns">
            <div class="column">
              <label class="label">Current Term</label>
              <div class="control">
                <multiselect v-model="term" track-by="termID" label="term" :options="terms" :allow-empty="false" @input="fetch_class_list"></multiselect>
              </div>
            </div>
            <div class="column">
              <label class="label">Filter Course</label>
              <div class="control">
                <multiselect v-model="course" track-by="courseID" label="courseCode" :options="courses" :allow-empty="false" @input="fetch_class_list"></multiselect>
              </div>
            </div>
          </div>
        </div>
        <div v-show="loader" class="loader"></div>
         <div v-show="!loader">
            <div v-for="c of class_list">
               <div class="box">
                  <h6 class="title is-6"><span class="has-text-primary">SECTION:</span> {{c.secName}}</h6>
                  <hr>
                  <div class="table__wrapper">
	                  <table class="table is-fullwidth">
	                     <thead>
	                        <th width="15%">Class Code</th>
	                        <th width="20%">Description</th>
	                        <th width="10%">Days</th>
	                        <th width="20%">Time</th>
	                        <th width="15%">Room</th>
	                        <th width="20%">Instructor</th>
	                     </thead>
	                     <tbody>
	                        <tr v-for="x of c.classes">
	                           <td> {{x.classCode}} </td>
	                           <td> {{x.subDesc}} </td>
	                           <td> {{x.day}} </td>
	                           <td> {{x.class_time}} </td>
	                           <td> {{x.roomName}} </td>
	                           <td> {{x.faculty}} </td>
	                        </tr>
	                     </tbody>
	                  </table>
              	</div>
               </div>
               <br>
            </div>
         </div>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {
	Vue.component('multiselect', window.VueMultiselect.default) 

	new Vue({
	    el: '#app',
	    data: {
	    	loader: true,
	      	term: {termID: '<?php echo $current_term->termID ?>', term: '<?php echo $current_term->term ?>'},
	      	terms: [],
	      	class_list: [],
	      	course: null,
	      	courses: [],
	      	has_data: true
	       
	    },
	    created() {
	        this.populate()
	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {
	    	populate(){
	         this.$http.get('<?php echo base_url() ?>student_users/populate_class_sched')
	        .then(response => {
	          const c = response.body
	          this.terms = c.terms 
	          this.courses = c.courses
	          this.course = c.courses[0]
	          this.class_list = c.class_list
	          this.loader = false
	        }, e => {
	        	console.log(e.body)
	        })
	      },
	      fetch_class_list(){
	         this.loader = true
	         this.$http.get('<?php echo base_url() ?>student_users/get_class_list/' + this.term.termID +'/'+this.course.courseID)
	           .then(response => {
	           	console.log(response.body);
	             this.class_list = response.body
	             this.loader = false
	         }, e => {
	        	console.log(e.body)
	        })
	      }
	    }
	})

}, false)



</script>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-multiselect/vue-multiselect.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/vue/vue-resource.js"></script>
