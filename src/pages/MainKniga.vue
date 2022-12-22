<template>
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
		  <tr>
			<td colspan="3" class="table-item">
        <form @submit.prevent="onBookAdd">
					█ ▆ ▅ ▃ ▂ ▂ ▃ ▅ ▆ █ █ ▆ ▅ ▃ ▂ ▂ ▃ ▅ ▆ █ █ ▆ ▅ ▃ ▂ ▂ ▃ ▅ ▆ █
				</form>
			</td>
		  </tr>
        </tbody>
      </table>
        <form @submit.prevent="onBookAdd" class="form-item">
					<input type="text" class="form-control" v-model="book_name" placeholder="Book name" />
					<input type="number" class="form-control" v-model.number="book_count" placeholder="Book count" />
					<input type="submit" class="btn btn-primary" value="Add" />
				</form>
            <div class="d-flex2">
                <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                <button class="btn btn-outline-success" type="submit">Поиск</button>
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