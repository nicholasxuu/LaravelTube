import Vue from 'vue'
import App from './app.vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import videos from './components/main-wrapper/index.vue'
import videoView from './components/main-wrapper/video-view.vue'
import userManager from './components/main-wrapper/user-manager.vue'
import userEditor from './components/main-wrapper/user-editor.vue'
import categoryManager from './components/main-wrapper/category-manager.vue'
import categoryEditor from './components/main-wrapper/category-editor.vue'


Vue.use(VueResource);
Vue.use(VueRouter);

const router = new VueRouter();

router.map({
    '/': {
        component: {
            template: '<router-view></router-view>'
        },
        subRoutes: {
            '/': {
                component: videos
            },
            '/videos/:id': {
                component: videoView,
            },
            '/category/:name': {
                component: videos,
            },
            '/search/:name': {
                component: videos,
            },
	        '/users/manager/': {
                component: userManager,
	        },
	        '/users/editor/:id': {
                component: userEditor,
	        },
	        '/categories/manager/': {
		        component: categoryManager,
	        },
	        '/categories/editor/:id': {
		        component: categoryEditor,
	        },
        }
    }
});


router.redirect({
    '*': '/',
});

router.start(App, 'app');

Vue.http.headers.common['X-Authorization'] = $('meta[name=api_token]').attr("content");