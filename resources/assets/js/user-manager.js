import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource);

new Vue({
	el: '#user-manager',

	data: {
		users:[],
		api_token: $('meta[name=api_token]').attr("content"),
	},
    methods:{
        getUserList: function() {
            this.$http.get('/api/users/').then(function (response) {
                this.users = response.data.data;
            });
        },

        deleteUser: function(id, name, email) {
            const confirmDelete = confirm(`sure to delete ${name} | ${email}?`);
            if (confirmDelete) {
                this.$http.delete('/api/users/' + id).then(function (response) {
                    this.getUserList();
                });
            }
        },
    },

    ready: function(){
        this.getUserList();
    },
});


Vue.http.headers.common['X-Authorization'] = $('meta[name=api_token]').attr("content");