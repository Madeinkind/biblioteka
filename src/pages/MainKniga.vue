<template>
	 <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Книги</h4>
              <!-- Basic Bootstrap Table -->
              <div class="card">
				<router-link :to="{path: '/mainadd'}" class="btn btn-primary">
					Добавить
              </router-link>
			  <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->
			</div>
			  </nav>
                <div class="table-responsive text-nowrap"></div>
      <table class="table">
        <thead class="thead">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col">Кол-во</th>
            <th scope="col">Издательство</th>
            <th scope="col">Год выпуска</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr v-for="book in books" :key="book.id">
            <td>{{book.id}}</td>
            <td>{{book.name}}</td>
            <td>{{book.count}}</td>
            <td>{{book.name}}</td>
            <td>{{book.date}}</td>
            <td>
              <input type="button" class="btn btn-danger" @click="onDeleteBook(book.id)" value="✖" />
              <input type="button" class="btn btn-success" @click="onDeleteBook(book.id)" value="↺" />
            </td>
          </tr>
        </tbody>
      </table>
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
		useMeta({title: 'Главная | Biblioteka'});
	},
	data: () => ({
		books: [],
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