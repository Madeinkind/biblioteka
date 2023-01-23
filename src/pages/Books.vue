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
                      <li class="breadcrumb-item active">Книги</li>
                    </ol>
                  </nav>
              <h4 class="fw-bold py-3 mb-4">Книги</h4>
              <!-- Basic Bootstrap Table -->
              <div class="card">
				<router-link :to="{path: '/books/add'}" class="btn btn-primary">
					Добавить
              </router-link>
                <div class="table-responsive text-nowrap"></div>
      <table class="table">
        <thead class="thead">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col">Кол-во</th>
            <th scope="col">Автор</th>
            <th scope="col">Год выпуска</th>
            <th scope="col">Инвентарный номер</th>
            <th scope="col">Издатель</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr v-for="book in books" :key="book.id">
            <td>{{book.id}}</td>
            <td>{{book.name}}</td>
            <td>{{book.count}}</td>
            <td>{{book.author}}</td>
            <td>{{book.year_publishing}}</td>
            <td>{{book.inventory_number}}</td>
            <td>{{book.publishing}}</td>
            <td class="text-end">
				<router-link :to="{path: '/books/'+book.id+'/edit'}" class="btn btn-success">
					<i class='bx bxs-pencil'></i>
				</router-link>
				<input type="button" class="btn btn-danger" @click="onDeleteBook(book.id)" value="✖" />
            </td>
          </tr>
        </tbody>
      </table>
		</div>
		<nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
				<li class="page-item" v-for="p in getPagesCount()">
					<a class="page-link" href="javascript://" @click="page = p; loadBooks();">{{p}}</a>
				</li>
            </ul>
        </nav>
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
		useMeta({title: 'Книги | Biblioteka'});
	},
	data: () => ({
		search: '',
		page: 1,
		limit: 5,
		
		books: [],
		books_count: 0,
	}),
	methods: {
		loadBooks(){
			fetch('/api/books?' + new URLSearchParams({
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
						this.loadBooks();
					}
				}).catch(error => {
					console.log(error);
				});  
     		}
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