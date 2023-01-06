<template>
	 <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Книги</h4>

              <!-- Basic Bootstrap Table -->
            <div class="card">
				<router-link :to="{path: '/mainkniga'}" class="btn btn-primary">
					Назад
              </router-link>
        <form @submit.prevent="onBookAdd" class="form-item">
					<input type="text" class="form-control" v-model="book_name" placeholder="Book name" />
					<input type="number" class="form-control" v-model.number="book_count" placeholder="Book count" />
					<input type="submit" class="btn btn-primary" value="Add" />
		</form>
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
		useMeta({title: 'Главная | Biblioteka'});
	},
	data: () => ({
		book_name: '',
		book_count: 1,
	}),
	methods: {
		onBookAdd(){
			fetch('/api/books', {
				method: 'POST',
				body: JSON.stringify({
					name: this.book_name,
					count: this.book_count,
				}),
				headers: {
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.$router.push('/mainkniga');
			}).catch(error => {
				console.log(error);
			});
		},
	},
	mounted(){
		
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