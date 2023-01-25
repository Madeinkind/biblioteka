<template>
	<div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Сдача книги</h4>
		<form @submit.prevent="onBookExtraditionReturn()">
			<div class="card-body">
				<div class="row">
					<div class="col col-md-3">
						<div class="mb-3">
							<label for="firstName" class="form-label">Дата фактического возврата книги</label>
							<input class="form-control" type="date" required v-model="date_end_fact">
						</div>
					</div>
				</div>
			</div>
			<hr class="my-0" />
			<div class="card-body">
				<div class="mt-2">
					<button type="submit" class="btn btn-primary me-2">Сдать</button>
					<router-link :to="{path: '/books-issued'}" class="btn btn-outline-secondary">Назад</router-link>
				</div>
			</div>
		</form>
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
		useMeta({title: 'Возврат книги на склад | Biblioteka'});
	},
	data: () => ({
		book_history_id: 0,
		date_end_fact: '',
	}),
	methods: {
		onBookExtraditionReturn(){
			if(confirm('Вы уверены?')){
				fetch('/api/books-readers/' + this.book_history_id, {
					method: 'POST',
					body: JSON.stringify({
						date_end_fact: this.date_end_fact,
					}),
					headers: {
						'Content-Type': 'application/json',
					},
				}).then(stream => stream.json()).then((data) => {
					//console.log(data);
					if(data.success){
						this.$router.push('/books-issued');
					}
				}).catch(error => {
					console.log(error);
				});
			}
		},
	},
	mounted(){
		//this.loadBooks();
	},
	beforeMount(){
		window.scrollTo(0, 0);
		this.book_history_id = this.$route.params.id;
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		this.book_history_id = this.$route.params.id;
	},
	computed: {},
	components: {
		//Navbar,
	},
};




</script>