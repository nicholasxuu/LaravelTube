import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource);

new Vue({
	el: '#category-editor',

	data: {
		message: '',
		id: $('meta[name=category-id]').attr("content"),
		name: '',
	},
	methods:{
		getCategory: function(id) {
			this.$http.get('/api/categories/' + id).then(function (response) {
				this.name = response.data.data.name;
			});
		},

		editCategory: function(id) {
			this.$http.post('/api/categories/' + id, {name: this.name}).then(function (response) {
				this.message = "updated";
				this.getUser(id);
			});
		},
	},

	ready: function(){
		this.getCategory(this.id);
	},
});


Vue.http.headers.common['X-Authorization'] = $('meta[name=api_token]').attr("content");