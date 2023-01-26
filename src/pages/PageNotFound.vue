<template>
	<div class="my-5 pt-sm-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<div>
							<div class="row justify-content-center">
								<div class="col-sm-4">
									<div class="error-img">
										<img src="assets/images/404-error.png" alt="" class="img-fluid mx-auto d-block">
									</div>
								</div>
							</div>
						</div>
						<h4 class="text-uppercase mt-4">Ошибка 404</h4>
						<p class="text-muted">Страница не существует</p>
						<div class="mt-5">
							<router-link :to="{path: '/'}" class="btn btn-primary waves-effect waves-light">На главную</router-link>
						</div>
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
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Страница не найдена (404) | Biblioteka'});
	},
	beforeMount(){
		window.scrollTo(0, 0);
	},
	beforeUnmount(){},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
	},
};
</script>