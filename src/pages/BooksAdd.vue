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
                        <router-link :to="{path: '/books'}" class="menu-link">Список книг</router-link>
                      </li>
                      <li class="breadcrumb-item active">Добавление книги</li>
                    </ol>
                  </nav>
    		<h4 class="fw-bold py-3 mb-2">Добавление книги</h4>
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
							<div class="col text-center">
								<img
									:src="book_img_poster"
									alt="book-poster"
									class="rounded mb-3"
									width="300"
									id="uploadedPoster"
								/>
								<div class="button-wrapper">
									<label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
										<span class="d-none d-sm-block">Загрузить фото</span>
										<i class="bx bx-upload d-block d-sm-none"></i>
										<input type="file" id="upload" ref="book_img" class="account-file-input" hidden @change="handlePosterFileUpload()" accept="image/png, image/jpeg" />
									</label>
									<button type="button" @click="resetPosterFile()" class="btn btn-outline-secondary account-image-reset mb-4">
										<i class="bx bx-reset d-block d-sm-none"></i>
										<span class="d-none d-sm-block">Сброс</span>
									</button>
									<p class="text-muted mb-0">Разрешены форматы файлов JPG, PNG. Максимальный размер файла 1 МБ</p>
								</div>
							</div>
							<div class="col">
								<div class="mb-3">
									<label for="firstName" class="form-label">Название</label>
									<input class="form-control" type="text"  v-model="book_name" required>
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Издатель</label>
									<input class="form-control" type="text" v-model="book_publishing" required>
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Автор</label>
									<input class="form-control" type="text" v-model="book_author" required>
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Год выпуска</label>
									<input class="form-control" type="text" v-model="book_year_publishing" required>
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Специальность</label>
									<input class="form-control" type="text" v-model="book_speciality" required>
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Инвентарный номер</label>
									<input class="form-control" type="text" v-model="book_inventory_number">
								</div>
								<div class="mb-3">
									<label for="firstName" class="form-label">Описание</label>
									<textarea rows="5" class="form-control" v-model="book_about"></textarea>
								</div>
							
							</div>
						</div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
						<div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Добавить</button>
						  	<router-link :to="{path: '/books'}" class="btn btn-outline-secondary">
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
		useMeta({title: 'Добавление книги | Biblioteka'});
	},
	data: () => ({
		book_name: '',
		book_speciality: '',
		book_publishing: '',
		book_about: '',
		book_inventory_number: '',
		book_year_publishing: '',
		book_img: '',
		book_img_poster: '/assets/images/book.png',
		book_author: '',
	}),
	methods: {
		onBookAdd(){
<<<<<<< HEAD
<<<<<<< HEAD
			let formData = new FormData();
			formData.append('name', this.book_name);
			formData.append('speciality', this.book_speciality);
			formData.append('publishing', this.book_publishing);
			formData.append('about', this.book_about);
			formData.append('inventory_number', this.book_inventory_number);
			formData.append('year_publishing', this.book_year_publishing);
			formData.append('author', this.book_author);
			formData.append('img', this.book_img);
=======
			//let formData = new FormData();
			//formData.append('name', this.book_name);
			//formData.append('img', this.book_img);
>>>>>>> parent of fb9befe (release)
=======
			//let formData = new FormData();
			//formData.append('name', this.book_name);
			//formData.append('img', this.book_img);
>>>>>>> parent of fb9befe (release)

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
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.$router.push('/books');
			}).catch(error => {
				console.log(error);
			});
		},

		handlePosterFileUpload(){
			this.book_img = this.$refs.book_img.files[0];
			let reader  = new FileReader();
			reader.addEventListener("load", function(){
				this.book_img_poster = reader.result;
			}.bind(this), false);
			if(this.book_img){
				if(/\.(jpe?g|png)$/i.test(this.book_img.name)){
					reader.readAsDataURL(this.book_img);
				}
			}
		},
		resetPosterFile(){
			this.book_img = '';
			this.book_img_poster = '/assets/images/book.png';
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