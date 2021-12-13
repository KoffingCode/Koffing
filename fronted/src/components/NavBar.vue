<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<i class="fas fa-mug-hot mx-1"></i>
		<router-link class="navbar-brand" to="/">Restaurante Koffing</router-link>
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
			<router-link class="nav-link" to="/acerca"><i class="fas fa-laptop-code mx-1"></i>Acerca del proyecto</router-link>
		</span>
		<a href="/" @click="disconnect()" v-if="checkAnyCookieActive()">Cerrar sesión</a>
		</div>
	</div>
</nav>
</template>

<script>
import CookieControl from '@/utils/CookieControl.js'

export default {
	name: "NavBar",
	props: {
		routes: {
			type: Array,
		}
	},
	methods: {
		disconnect() {
			CookieControl.removeCookies();
			//window.location.reload();
		},
		checkAnyCookieActive() {
			return CookieControl.checkAnyCookieActive();
		}
	}
}
</script>

<style scoped>
a{
	color: #958bb7;
}

.navbar-dark .navbar-brand{
	color: #eae280;
}
</style>
