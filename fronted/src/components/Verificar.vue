<template>
	<div class="Verificar">
		<div v-if="errors.length>0" class="alert alert-danger">
			<b>Por favor, corrija el(los) siguiente(s) error(es):</b>
			<ul>
				<li v-for="(error,k) in errors" :key="k">{{ error }}</li>
			</ul>
		</div>
		<div v-if="enviado" class="alert alert-success">
			<b>Registro enviado correctamente</b>
		</div>
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

<style>

</style>