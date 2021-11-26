<template>

    <div class="home">
		{{test}}
        <img alt="Vue logo" src="../assets/logo.png">
        <HelloWorld @evento="procesoDelHijo" msg="Welcome to Your Vue.js App" :obj="{'n':1}"/>

		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
			Launch demo modal
		</button>

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

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'
import Modal from '@/components/Modal.vue'

export default {
    name: 'Home',
	props: ['test','test2'],
	created() {
		this.$router.push({
			name: 'Home',
			params: {
				test: 'hello there',
				test2: 'dfdf' 
			}
		})},
    components: {
        HelloWorld,
		Modal
    },methods: {
		procesoDelHijo(data){
			console.log(data);
		}
	}
}
</script>
