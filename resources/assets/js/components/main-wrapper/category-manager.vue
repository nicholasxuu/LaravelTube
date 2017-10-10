<template>
	<table style="width:100%">
		<tr>
			<th>id</th>
			<th>name</th>
			<th></th>
			<th></th>
		</tr>
		<tr v-for="category in categories">
			<td>{{category.id}}</td>
			<td>{{category.name}}</td>
			<td><a v-link="{ path: '/categories/editor/' + category.id}">edit</a></td>
			<td><a @click="deleteCategory(category.id, category.name)">delete</a></td>
		</tr>
	</table>
</template>

<script>
	export default{
		data(){
			return{
				categories:[],
			}
		},
		methods:{
			getCategories: function() {
				this.$http.get('/api/categories/').then(function (response) {
					this.categories = response.data.data;
				});
			},

			deleteCategory: function(id, name) {
				const confirmDelete = confirm(`sure to delete ${name}?`);
				if (confirmDelete) {
					this.$http.delete('/api/categories/' + id).then(function (response) {
						this.getCategories();
					});
				}
			},
		},

		ready: function(){
			this.getCategories();
		},
	}
</script>

<style>
</style>