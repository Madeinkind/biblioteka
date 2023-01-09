<template>
        <div class="container-xxl flex-grow-1 container-p-y">
    		<h4 class="fw-bold py-3 mb-4">Изменить</h4>
			<!-- Content wrapper -->
		<div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-10">
                  <div class="card mb-4">
                    <!-- Account -->
                    <div class="card-body">
						<div class="row">
							<div class="col text-center">
                        <img
                          src="/assets/images/book.png "
                          alt="user-avatar"
                          class="rounded mb-3"
                          width="300"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Загрузить новое фото</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Сброс</span>
                          </button>
                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
							</div>
							<div class="col">
								<form id="formAccountSettings" method="POST" onsubmit="return false">
							<div class="mb-3">
                            	<label for="firstName" class="form-label">Название</label>
                            	<input class="form-control" type="text" placeholder="Книги" aria-label="default input example">
                          </div>
							<div class="mb-3">
                            	<label for="firstName" class="form-label">Издратель</label>
                            	<input class="form-control" type="text" placeholder="Книги" aria-label="default input example">
                          </div>
							<div class="mb-3">
                            	<label for="firstName" class="form-label">Год выпуска</label>
                            	<input class="form-control" type="text" placeholder="Книги" aria-label="default input example">
                          </div>
                      </form>
							</div>
						</div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
						<div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Сохранить</button>
						  	<router-link :to="{path: '/books-issued'}" class="btn btn-outline-secondary">
								Назад
              				</router-link>
                        </div>
                    </div>
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
	name: 'Main',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Главная | Biblioteka'});
	},
	data: () => ({
		books: [],
		
		book_name: '',
		book_count: 1,
	}),
	methods: {
		loadBooks(){
			fetch('/api/books', {
				method: 'GET',
				/*body: JSON.stringify({
					name: 'TestBook1',
				}),*/
				headers: {
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.books = data.list;
			}).catch(error => {
				console.log(error);
			});
		},
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
				this.loadBooks();
			}).catch(error => {
				console.log(error);
			});
		},
		onDeleteBook(id){
			if(confirm('Вы уверены?')){
        fetch('/api/books/'+id, {
				method: 'DELETE',
				/*body: JSON.stringify({
					name: this.book_name,
					count: this.book_count,
				}),*/
				headers: {
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
        if(data.success){
          let pos = this.books.findIndex((elem) => elem.id == id);
          this.books.splice(pos, 1);
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
		this.loadBooks();
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		this.loadBooks();
	},
	computed: {},
	components: {
		//Navbar,
	},
};


</script>