import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import QuestionView from '../views/QuestionView.vue'
import ResultView from '../views/ResultView.vue'
import axios from 'axios'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/home',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
    },
    {
      path: '/questions',
      name: 'questions',
      component: QuestionView,
    },
    {
      path: '/result',
      name: 'result',
      component: ResultView,
    },
  ],
})

router.beforeEach(async (to, from, next) => {
  try {
    const res = await axios.get('http://localhost/api/user', {
      withCredentials: true,
      withXSRFToken: true,
      headers: {
        Accept: 'application/json',
      }
    })
    // ✅ ログイン済み
    console.log('認証済みユーザー:', res.data)

    // login or register にアクセスしようとしたら /home にリダイレクト
    if (to.name === 'login' || to.name === 'register') {
      return next({ name: 'home' })
    }
    next()

  } catch (error: any) {
    if (error.response?.status === 401) {
      // 未ログインは想定内
      console.warn('未ログインユーザーとして処理を続行')

      if (to.name === 'login' || to.name === 'register') {
        return next()
      } else {
        return next({ name: 'login' })
      }
    } else {
      // それ以外のエラーは想定外として出す
      console.error('想定外のエラー:', error)
      return next({ name: 'login' })
    }
  }
})

export default router
