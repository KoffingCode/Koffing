<template>
	<div class="form">
		
		<div class="form-group row">
			<div class="col">
				<label for="server">Nombre:</label>
				<input type="text" class="form-control" id="nombre" v-model = "nombre">
			</div>
		</div>
		<div class="form-group row">
			<div class="col">
				<label for="apellido">Apellido:</label>
				<input type="text" class="form-control" id="apellido" v-model = "apellido">
			</div>
		</div>
		<div class="form-group row">
			<div class="col">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email" v-model = "email">
			</div>
		</div>

	</div>
</template>

<script>
export default {
	name: 'Form',
	props:{
		campos: Array,
	}
}
</script>

<style>

</style>