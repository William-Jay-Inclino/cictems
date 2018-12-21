<section id="app" class="section" v-cloak>
	<div class="container">
		<h3 class="title is-3 my-title"> {{page_title}} </h3>
		<div class="box">

		</div>
	</div>

</section>


<script>

document.addEventListener('DOMContentLoaded', function() {

	new Vue({
	    el: '#app',
	    data: {
	    	page_title: 'Dashboard',
	       
	    },
	    created() {
	        
	    },
	    watch: {

	    },
	    computed: {

	    },
	    methods: {

	    }
	})

}, false)



</script>
