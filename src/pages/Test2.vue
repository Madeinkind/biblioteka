<template>
	
</template>

<style lang="css">

</style>

<script>
import lib from '@/lib';
import { useMeta } from 'vue-meta';

export default {
	name: 'Test2',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Test2 | Krasp'});
	},
	data: () => ({
		
	}),
	methods: {
		
	},
	beforeMount(){
		window.scrollTo(0, 0);
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
	},
	computed: {},
	components: {
		//Navbar,
	},
}
</script>