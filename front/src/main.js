import './assets/main.css'
import Gallery from './components/Gallery.vue'
import Post from './components/PostItem.vue'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.component('Gallery', Gallery)
app.component('Post', Post)

app.use(router)

app.mount('#app')
