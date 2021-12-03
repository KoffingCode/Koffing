<template>
	<div  class="Verificar">
		<transition name="fade">
			<div v-if="errors.length>0" class="alert alert-danger">
				<b>Por favor, corrija el(los) siguiente(s) error(es):</b>
				<ul>
					<li v-for="(error,k) in errors" :key="k">{{ error }}</li>
				</ul>
			</div>
		</transition>
		<transition name="fade">
			<div v-if="enviado" class="alert alert-success">
				<b>Registro almacenado correctamente</b>
			</div>
		</transition>
	</div>
</template>

<script>
export default {
	name: 'Verificar',
	props: {
		enviado:Boolean,
		errors:Array
	}
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
	transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
	opacity: 0;
}
</style>