<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			<li class="nav-item" v-for="(item,ind) of routes" :key="ind">
				<router-link class="nav-link" :to="item.url">{{item.name}}</router-link>
			</li>

		</ul>
		<span class="navbar-text">
			Navbar text with an inline element
		</span>
	</div>
  </div>
</nav>
</template>

<script>
export default {
	name: "NavBar",
	props: {
		routes: {
			type: Array,
		}
	},
}
</script>

<style>

</style>