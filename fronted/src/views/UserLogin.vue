<template>
	<div class="TableView">
		<div class="row mt-3">
			<div class="col-6">
				<div class="row mb-3">
					<label for="name" class="col-sm-2 col-form-label">Email: </label>
					<div class="col-sm-10">
						<input @click="setEmail" v-model="data.email" type="text" class="form-control" id="name">
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="row mb-3">
					<label for="surname" class="col-sm-2 col-form-label">Contraseña: </label>
					<div class="col-sm-10">
						<input @click="setPassword" v-model="data.password" type="password" class="form-control" id="surname">
					</div>
				</div>
			</div>
		</div>

		<Verificar @mouseover="send=false" :errors="errors" :enviado="send"/>

		<div class="row mt-1">
			<div class="col-12 d-flex justify-content-center">
				<div class="mb-3">
					<button @click="sendWaiterData" :class="stateButton()">
						{{txtButton()}} 
						<i class="bi bi-save2-fill"></i>
					</button>
					<button v-if="update" @click="cancelUpdate" class="btn btn-danger px-5 mx-2">
						Cancelar Actualización 
						<i class="bi bi-x-square-fill"></i>
					</button>
				</div>
			</div>
		</div>

		<Modal idModal="exampleModal">
			<template v-slot:contenido >
				CONTENIDO DEL MODAL
			</template>
			<template v-slot:botones >
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</template>
		</Modal>
	</div>

</template>