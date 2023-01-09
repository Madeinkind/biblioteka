<template>
	 <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Книги</h4>

              <!-- Basic Bootstrap Table -->
            <div class="card">
				<router-link :to="{path: '/reader'}" class="btn btn-primary">
					Назад
              </router-link>
        <form @submit.prevent="onReaderAdd" class="form-item">
			<input type="text" class="form-control" v-model="reader_namestudent" placeholder="Имя" />
			<input type="text" class="form-control" v-model="reader_surnamestudent" placeholder="Фамилия" />
			<input type="text" class="form-control" v-model="reader_iin" placeholder="ИИН" />
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
		reader_namestudent: '',
		reader_surnamestudent: '',
		reader_iin: '',
	}),
	methods: {
		onReaderAdd(){
			fetch('/api/readers', {
				method: 'POST',
				body: JSON.stringify({
					namestudent: this.reader_namestudent,
					surnamestudent: this.reader_surnamestudent,
					iin: this.reader_iin,
				}),
				headers: {
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.$router.push('/readers');
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