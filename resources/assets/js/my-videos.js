import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource)

new Vue({
    el: '#listMyVideos',

    data: {
        videos: [],
        user: jQuery.parseJSON($('meta[name=user]').attr("content")),
        api_token: $('meta[name=api_token]').attr("content"),
        categories: [],
    },

    methods: {
        getCategories: function() {
            this.$http.get('/api/categories').then(function(response) {
                this.$set('categories', response.data.data);
            });
        },
        getMyVideos: function(id){
            this.$http.get('/api/videos/user/'+id).then(function (response) {
                this.$set('videos', response.data.data);
            });
        },

        updateVideo: function(id){
            this.$http.put('/api/videos/'+id, {name: $('#name'+id).val(),  category: $('#category'+id).val()}).then(function () {
                this.getMyVideos(this.user.id);
            });
        },

        deleteVideo: function(id){
            this.$http.delete('/api/videos/'+id).then(function () {
                    this.getMyVideos(this.user.id);
                });
        }

    },

    ready: function() {
        this.getMyVideos(this.user.id);
        this.getCategories();
    }
});

Vue.http.headers.common['X-Authorization'] = $('meta[name=api_token]').attr("content");