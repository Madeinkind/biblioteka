<template>
	 <div class="container-xxl flex-grow-1 container-p-y">
		        <!-- Basic Breadcrumb -->
                  <!-- Custom style1 Breadcrumb -->
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                      <li class="breadcrumb-item">
                        <router-link :to="{path: '/'}" class="menu-link">Главная</router-link>
                      </li>
                      <li class="breadcrumb-item">
						<router-link :to="{path: '/readers'}" class="menu-link">Список читателей</router-link>
                      </li>
                      <li class="breadcrumb-item active">Книги</li>
                    </ol>
                  </nav>
              <h4 class="fw-bold py-3 mb-4">Книги</h4>

              <!-- Basic Bootstrap Table -->
            <div class="card">
				<router-link :to="{path: '/reader'}" class="btn btn-primary">
					Назад
              </router-link>
        <form @submit.prevent="onReaderAdd" class="form-item">
			<input type="text" class="form-control" v-model="reader_fio" placeholder="Имя" />
			<input type="text" class="form-control" v-model="reader_group" placeholder="Фамилия" />
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
		reader_fio: '',
		reader_group: '',
		reader_iin: '',
	}),
	methods: {
		onReaderAdd(){
			fetch('/api/readers', {
				method: 'POST',
				body: JSON.stringify({
					fio: this.reader_fio,
					group: this.reader_group,
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