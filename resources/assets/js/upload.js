import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource);

new Vue({
	el: '#form-add-video',

	data: {
		categories: [],
	},

	methods: {
		getCategories: function() {
			this.$http.get('/api/categories').then(function(response) {
				this.$set('categories', response.data.data);
			});
		},
	},

	ready: function() {
		this.getCategories();
	}
});