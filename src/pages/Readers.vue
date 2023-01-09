<template>
        <div class="container-xxl flex-grow-1 container-p-y">
    		<h4 class="fw-bold py-3 mb-4">Список читателей</h4>
			<!-- Basic Bootstrap Table -->
			<div class="card">
				<router-link :to="{path: '/readers/add'}" class="btn btn-primary">
					Добавить
              </router-link>
                <div class="table-responsive text-nowrap"></div>
				  <table class="table">
					<thead class="thead">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Имя</th>
						<th scope="col">Фамилия</th>
						<th scope="col">Группа</th>
					</tr>
					</thead>
					<tbody class="table-group-divider">
					<tr v-for="reader in readers" :key="reader.id">
						<td>{{reader.id}}</td>
						<td>{{reader.name}}</td>
						<td>{{reader.username}}</td>
						<td>{{reader.count}}</td>
						<td>{{reader.date}}</td>
						<td class="text-end">
							<router-link :to="{path: '/readers/'+reader.id+'/edit'}" class="btn btn-success">
								<i class='bx bxs-pencil'></i>
							</router-link>
							<input type="button" class="btn btn-danger" @click="onDeleteReader(reader.id)" value="✖" />
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
		useMeta({title: 'Список читателей | Biblioteka'});
	},
	data: () => ({
		readers: [],
	}),
	methods: {
		loadReaders(){
			fetch('/api/readers', {
				method: 'GET',
				/*body: JSON.stringify({
					name: 'TestBook1',
				}),*/
				headers: {
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.readers = data.list;
			}).catch(error => {
				console.log(error);
			});
		},
		onDeleteReader(id){
			if(confirm('Вы уверены?')){
     		   fetch('/api/reads/'+id, {
				method: 'DELETE',
				/*body: JSON.stringify({
					name: this.read_name,
					count: this.read_count,
				}),*/
				headers: {
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
        if(data.success){
          let pos = this.reads.findIndex((elem) => elem.id == id);
          this.reads.splice(pos, 1);
        }
			}).catch(error => {
				console.log(error);
			});  
      }
      
		},
	},
	mounted(){
		//this.loadreads();
	},
	beforeMount(){
		window.scrollTo(0, 0);
		this.loadReaders();
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		this.loadReaders();
	},
	computed: {},
	components: {
		//Navbar,
	},
};


</script>