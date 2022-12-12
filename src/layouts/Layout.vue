<template>
	<div class="container">

		<router-view/>
	</div>
</template>

<style lang="sass" scoped>

</style>

<script>
import lib from '@/lib';
import { useMeta } from 'vue-meta';
//import HeaderBlock from '@/components/Header.vue';

export default {
	name: 'LayoutMain',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Biblioteka'});
	},
	data: () => ({
		navbarMenu: [],
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
	mounted(){
		
	},
	created(){
		this.$http.interceptors.response.use(undefined, function(err){
			return new Promise(function(resolve, reject){
				if(err.status === 401 && err.config && !err.config.__isRetryRequest){
					//this.authModel.doLogout();
				}
				throw err;
			});
		});
	},
	computed: {},
	components: {},
}
</script>