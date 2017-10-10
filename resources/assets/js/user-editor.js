import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource);

new Vue({
	el: '#user-editor',

    data: {
		message: '',
        api_token: $('meta[name=api_token]').attr("content"),
		userId: $('meta[name=user-id]').attr("content"),
		name: '',
		email: '',
		level: '',
	},
    methods:{
        getUser: function(userId) {
            this.$http.get('/api/users/' + userId).then(function (response) {
                this.name = response.data.data.name;
                this.email = response.data.data.email;
                this.level = response.data.data.level;
            });
        },

        editUser: function(userId) {
            this.$http.post('/api/users/' + userId, {name: this.name, email: this.email, level: this.level, password: this.password}).then(function (response) {
                this.message = "updated";
                this.getUser(userId);
            });
        },
    },

    ready: function(){
        this.getUser(this.userId);
    },
});


Vue.http.headers.common['X-Authorization'] = $('meta[name=api_token]').attr("content");