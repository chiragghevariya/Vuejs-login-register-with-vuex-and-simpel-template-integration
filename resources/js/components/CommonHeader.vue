<template>
    <div id="new">
	    <div class="site-mobile-menu site-navbar-target">
		   <div class="site-mobile-menu-header">
		      <div class="site-mobile-menu-close mt-3">
		        <span class="icofont-close js-menu-toggle"></span>
		      </div>
		   </div>
		   <div class="site-mobile-menu-body"></div>
		</div>

	    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
			<div class="container">
	      <div class="row align-items-center">

	        <div class="col-6 col-lg-2">
	          <h1 class="mb-0 site-logo">
	          	<router-link :to="{name:'Home'}" class="mb-0">Vuejs-CMS</router-link>
	          </h1>
	        </div>

	        <div class="col-12 col-md-10 d-none d-lg-block">
	          <nav class="site-navigation position-relative text-right" role="navigation">

	            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
	              <li class="active"><router-link :to="{name:'Home'}" class="nav-link">Home</router-link>
	              <li><router-link :to="{name:'BlogListing'}">Blog</router-link></li>
	              <li><router-link :to="{name: 'ContactUs'}">Contact</router-link></li>
	              <li v-if="isLoggedIn !=true"><router-link :to="{name: 'Login'}">Login</router-link></li>
	              <li v-if="isLoggedIn !=true"><router-link :to="{name: 'Register'}">Register</router-link></li>
	              <li v-if="isLoggedIn ==true"><router-link :to="{name: 'Dashboard'}">Dashboard</router-link></li>
	              <li v-if="isLoggedIn ==true" v-on:click="logout">Logout</li>
	            </ul>
	          </nav>
	        </div>

	        <div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">

	          <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
	            <span></span>
	          </a>
	        </div>

	      </div>
	    	</div>
		</header>
	</div>
</template>
<script>
import { mapState } from 'vuex'
export default {
	name:"common-header",
	computed: {

		...mapState(['isLoggedIn','userData','token'])	
	},
	methods:{

    	logout(){
    		let token = localStorage.getItem('token');
    		this.$store.dispatch('logout',token);
    	}
    }
}
</script>