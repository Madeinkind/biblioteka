<template>
		<!-- Navbar -->

		<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center w-100" >
                <form class="nav-item d-flex align-items-center w-100" @submit.prevent="loadBooks()">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
				          	v-model="search"
				          	@keyup="loadBooks()"
                  />
			      	</form>
              </div>
              <!-- /Search -->
            </div>
          </nav>
          <!-- / Navbar -->
	 <div class="container-xxl flex-grow-1 container-p-y">
				<!-- Basic Breadcrumb -->
                  <!-- Custom style1 Breadcrumb -->
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                      <li class="breadcrumb-item">
                        <router-link :to="{path: '/'}" class="menu-link">Главная</router-link>
                      </li>
                      <li class="breadcrumb-item active">Выдача книг</li>
                    </ol>
                  </nav>
              
              <!-- Examples -->
              <div v-if="page_name == 'select-book'">
                <h4 class="fw-bold py-3 mb-4">Список</h4>
                <!-- Examples -->
                <div class="row mb-5">
                  <div class="col-md-6 col-lg-2 mb-3">
                    <div class="card h-100">
                      <img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Автор</p>
                        <div class="btn btn-outline-primary" @click="page_name = 'select-reader'; book_id = 1;">Выдать</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-2 mb-3">
                    <div class="card h-100">
                      <img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Автор</p>
                        <div class="btn btn-outline-primary" @click="page_name = 'select-reader'; book_id = 1;">Выдать</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-2 mb-3">
                    <div class="card h-100">
                      <img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Автор</p>
                        <div class="btn btn-outline-primary" @click="page_name = 'select-reader'; book_id = 1;">Выдать</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-2 mb-3">
                    <div class="card h-100">
                      <img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Автор</p>
                        <div class="btn btn-outline-primary" @click="page_name = 'select-reader'; book_id = 1;">Выдать</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-2 mb-3">
                    <div class="card h-100">
                      <img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Автор</p>
                        <div class="btn btn-outline-primary" @click="page_name = 'select-reader'; book_id = 1;">Выдать</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-2 mb-3">
                    <div class="card h-100">
                      <img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Автор</p>
                        <div class="btn btn-outline-primary" @click="page_name = 'select-reader'; book_id = 1;">Выдать</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div v-if="page_name == 'select-reader'">
                <!-- Content wrapper -->
		            <div class="content-wrapper">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                          <div class="row">
                            <div class="col-md-10">
                              <div class="card mb-4">
                                <!-- Account -->
		            			<form @submit.prevent="onBookExtradition()">
		            				<div class="card-body">
		            				<div class="row">
		            					<div class="col-md-6 col-lg-3 mb-3">
                            <div class="card h-100">
                            <img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
                              	<div class="card-body">
                              	  <h5 class="card-title">Card title</h5>
		            						      <p for="firstName" class="card-text">Автор</p>
                              	</div>
                            </div>
                          </div>
		            					<div class="col">
		            						<div class="mb-3">
		            							<label for="firstName" class="form-label">ФИО</label>
		            							<input class="form-control" type="text"  v-model=" reader_fio">
		            						</div>
		            						<div class="mb-3">
		            							<label for="firstName" class="form-label">ИНН</label>
		            							<input class="form-control" type="number"  v-model="reader_iin">
		            						</div>
		            						<div class="mb-3">
		            							<label for="firstName" class="form-label">Группа</label>
		            							<input class="form-control" type="text"  v-model="reader_group">
		            						</div>
		            						<div class="mb-3">
		            							<label for="firstName" class="form-label">Дата плановой сдачи</label>
		            							<input class="form-control" type="date"  v-model="date_end_fact">
		            						</div>
		            					</div>
		            				</div>
                      </div>
                        <hr class="my-0" />
                      <div class="card-body">
		            				<div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Выдать</button>
                            <div class="btn btn-outline-primary" @click="page_name = 'select-book'; book_id = 1;">Назад</div>
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
              <div v-if="page_name == 'select-date'">

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
		useMeta({title: 'Выданные книги | Biblioteka'});
	},
	data: () => ({
		search: '',
		page: 1,
		limit: 10,
		
		books: [],
		books_count: 0,

    page_name: 'select-book',
    book_id: '',
    reader_id: '',
    date: '',


    reader_fio:'',
    reader_group:'',
    reader_iin:'',
    date_end_fact:'',
	}),
	methods: {
		loadBooks(){
			fetch('/api/books-issued?' + new URLSearchParams({
				search: this.search,
				start: (this.page - 1) * this.limit,
				limit: this.limit,
			})).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.books = data.list;
				this.books_count = data.count;
			}).catch(error => {
				console.log(error);
			});
		},
    onBookExtradition(){
			fetch('/api/books-extradition', {
				method: 'POST',
				body: JSON.stringify({
					fio: this.reader_fio,
					group: this.reader_group,
					iin: this.reader_iin,
					fact: this.date_end_fact,
				}),
				headers: {
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.$router.push('/books-issued');
			}).catch(error => {
				console.log(error);
			});
		},

	// получение количества страниц для списка новостей
		getPagesCount(){
			return Math.ceil(this.books_count / this.limit);
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