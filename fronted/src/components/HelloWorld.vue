<template>
    <div >
		<img @click="proceso" alt="Vue logo" src="../assets/logo.png" />
        <h1>{{ msg }}</h1>
		{{ obj.n }}
    </div>
</template>

<script>


export default {
    name: 'HelloWorld',
    props: {
        msg: String,
		obj: Object
    },
	emits: ['evento'],
	methods: {
		proceso() {
			this.$emit('evento', 'hola');
		}

	}
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
