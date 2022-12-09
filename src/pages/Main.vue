<template>
	<div>
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-flex align-items-center justify-content-between">
					<h4 class="mb-0">Главная</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item active">Главная</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="css" scoped>

</style>

<script>
import lib from '@/lib';
import { useMeta } from 'vue-meta';

export default {
	name: 'Main',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Главная | Biblioteka'});
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
};
</script>