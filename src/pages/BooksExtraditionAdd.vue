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
                        <router-link :to="{path: '/books-extradition'}" class="menu-link">Выдача книг</router-link>
                      </li>
                      <li class="breadcrumb-item active">Выдать</li>
                    </ol>
                  </nav>
    		<h4 class="fw-bold py-3 mb-2">Выдать</h4>
			<!-- Content wrapper -->
		<div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-10">
                  <div class="card mb-4">
                    <!-- Account -->
					<form @submit.prevent="onBookAdd()">
						<div class="card-body">
						<div class="row">
							<div class="col-md-6 col-lg-3 mb-3">
                  				<div class="card h-100">
                  				<img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
                  				  	<div class="card-body">
                  				  	  <h5 class="card-title">Card title</h5>
										  <p class="card-text">Автор</p>
                  				  	</div>
                  				</div>
								
                			</div>
							<div class="col">
								<div class="mb-3">
									<label for="firstName" class="form-label">ФИО</label>
									<input class="form-control" type="text"  v-model="book_name">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">ИНН</label>
									<input class="form-control" type="text"  v-model="book_name">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Группа</label>
									<input class="form-control" type="text"  v-model="book_name">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Дата выдачи</label>
									<input class="form-control" type="text"  v-model="book_name">
								</div>
							</div>
							
							
							
							<!--							<div class="col">
								<div class="mb-3">
									<label for="firstName" class="form-label">Название</label>
									<input class="form-control" type="text"  v-model="book_name">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Издатель</label>
									<input class="form-control" type="text" v-model="book_publishing">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Автор</label>
									<input class="form-control" type="text" v-model="book_author">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Год выпуска</label>
									<input class="form-control" type="number" v-model="book_year_publishing" max="99999">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Кол-во</label>
									<input class="form-control" type="number" v-model="book_count">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Инвентарный номер</label>
									<input class="form-control" type="text" v-model="book_inventory_number">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Описание</label>
									<textarea rows="5" class="form-control" v-model="book_about"></textarea>
								</div>
							
							</div> -->
						</div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
						<div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Выдать</button>
						  	<router-link :to="{path: '/books-extradition'}" class="btn btn-outline-secondary">
								Назад
              				</router-link>
                        </div>
                    </div>
					</form>

                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
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
		book_publishing: '',
		book_about: '',
		book_inventory_number: '',
		book_year_publishing: '',
		book_img: '',
		book_author: '',
	}),
	methods: {
		onBookAdd(){
			fetch('/api/books', {
				method: 'POST',
				body: JSON.stringify({
					name: this.book_name,
					count: this.book_count,
					publishing: this.book_publishing,
					about: this.book_about,
					inventory_number: this.book_inventory_number,
					year_publishing: this.book_year_publishing,
					img: this.book_img,
					author: this.book_author,
				}),
				headers: {
					Authorization: 'Bearer '+this.authModel.token,
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.$router.push('/books');
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