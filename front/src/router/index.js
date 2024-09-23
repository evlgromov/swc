import { createRouter, createWebHistory } from 'vue-router'
import Posts from '../views/Posts.vue'
import Post from '../views/Post.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: Posts
    },
    {
      name: "post",
      path: '/posts/:id',
      component: Post,
      props: true
    },
  ]
})

export default router
