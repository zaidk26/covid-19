<template>
  <header class="bg-dark">
    <div class="container">     
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0">
        <a class="navbar-brand" href="/">
          <div class="row">
            <div class="col-auto">
              <img src="/img/virus.png" height="32" alt="corona virus" />
            </div>
            <div class="col-auto" style="line-height:1;">
              <h5 class="m-0">COVID 19</h5>
              <small class="text-white-50">Statistics & News</small>
            </div>
          </div>          
          
        </a>
        <button 
        @click="toggleMenu()"
        class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent" :class="{show: menuActive}" >
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link font-weight-bold text-white" href="/"  >STATISTICS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-weight-bold text-white" href="/social-media-feeds"  >SOCIAL MEDIA FEEDS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-weight-bold text-white" href="/symptoms">SYMPTOMS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-weight-bold text-white" href="/contacts">CONTACTS <small class="font-weight-normal text-white-50">(South Africa)</small></a>
            </li>
          </ul>
        
        </div>
      </nav>      
    </div>
  </header>
</template>
<script>
export default {
  data(){	
		return {
      menuActive:false
    }
  },
  methods:{
    toggleMenu() {
			this.menuActive = !this.menuActive;
		},
  }
}
</script>