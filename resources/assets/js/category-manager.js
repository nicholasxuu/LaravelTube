import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource);

new Vue({
	el: '#category-manager',

	data: {
		categories:[],
		api_token: $('meta[name=api_token]').attr("content"),
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

		addCategory: function(name) {
			this.$http.post('/api/categories', {name: name}).then(function (response) {
				this.getCategories();
			});
		}
	},

	ready: function(){
		this.getCategories();
	},
});


Vue.http.headers.common['X-Authorization'] = $('meta[name=api_token]').attr("content");