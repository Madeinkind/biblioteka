<template>
	 <div class="container-xxl flex-grow-1 container-p-y">
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
            <th scope="col">Издательство</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr v-for="book in books" :key="book.id">
            <td>{{book.id}}</td>
            <td>{{book.name}}</td>
            <td>{{book.count}}</td>
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
              <li class="page-item prev">
                <a class="page-link" href="javascript:void(0);"
                  ><i class="tf-icon bx bx-chevrons-left"></i
                ></a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">2</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="javascript:void(0);">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">5</a>
              </li>
              <li class="page-item next">
                <a class="page-link" href="javascript:void(0);"
                  ><i class="tf-icon bx bx-chevrons-right"></i
                ></a>
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
			this.loadBooks();
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