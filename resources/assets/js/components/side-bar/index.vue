<template>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li v-for="category in categories">
                <a v-link="{ path: '/category/' + category.name }"><i class="fa fa-video-camera" aria-hidden="true"></i> {{category.name}}</a>
            </li>
            <hr />
        </ul>
    </div>

</template>

<script>
	export default{
        data(){
            return{
                categories: [],
            }
        },

        ready: function(){
            this.getCategories();
        },

        methods:{
            getCategories: function() {
                this.$http.get('/api/categories').then(function(response) {
                    this.$set('categories', response.data.data);
                });
            },
        }
    }
</script>

<style>
    #wrapper {
        padding-left: 250px;
        padding-top: 50px;
        transition: all 0.4s ease 0s;
    }

    #sidebar-wrapper {
        margin-left: -250px;
        left: 250px;
        width: 250px;
        background: #293038;
        position: fixed;
        height: 100%;
        overflow-y: auto;
        z-index: 1000;
        transition: all 0.4s ease 0s;
    }

    #sidebar-wrapper * {
        color: white;
    }

    .sidebar-nav {
        position: absolute;
        top: 0;
        width: 250px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .sidebar-nav li {
        line-height: 40px;
        text-indent: 20px;
    }

    .sidebar-nav li a {
        color: #FFFFFF;
        display: block;
        text-decoration: none;
    }

    .sidebar-nav li a:hover {
        color: #fff;
        background: rgba(255,255,255,0.2);
        text-decoration: none;
    }

    .sidebar-nav li a:active,
    .sidebar-nav li a:focus {
        text-decoration: none;
    }

    .sidebar-nav > .sidebar-brand a:hover {
        color: #fff;
        background: none;
    }

    @media (max-width:767px) {

        #wrapper {
            padding-left: 0;
        }

        #sidebar-wrapper {
            left: 0;
        }

        #wrapper.active {
            position: relative;
            left: 250px;
        }

        #wrapper.active #sidebar-wrapper {
            left: 250px;
            width: 250px;
            transition: all 0.4s ease 0s;
        }

    }
</style>
