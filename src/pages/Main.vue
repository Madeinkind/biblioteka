<template>
        <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Layout Demo -->
              <div class="layout-demo-wrapper">
                <div class="layout-demo-placeholder">
              
                </div>
                <div class="layout-demo-info">
                  <h4>Layout container</h4>
                  <p>Container layout sets a <code>max-width</code> at each responsive breakpoint.</p>
                </div>
              </div>
              <!--/ Layout Demo -->
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