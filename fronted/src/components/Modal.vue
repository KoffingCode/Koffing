<template>
	<div>
		<div class="modal fade" :id="idModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<slot name="contenido" ></slot>
					</div>
					<div class="modal-footer">
						<slot name="botones" ></slot>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    name: 'Modal',
    props: {
        idModal: String
    }
}
</script>

<style>

</style>