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
  // ログインページ or 登録ページならスキップ
	// if (to.name === 'login' || to.name === 'register') {
	// 	return next()
	// }
  try {
    const res = await axios.get('http://localhost/api/user', {
      withCredentials: true,
      withXSRFToken: true,
      headers: {
        Accept: 'application/json',
      }
    })

    // ユーザーが取得できた → ログイン済み
    console.log('認証済みユーザー:', res.data)

    // ✅ ログイン済みなのに login or register にアクセスしようとした場合は /home にリダイレクト
    if (to.name === 'login' || to.name === 'register') {
      return next('/home')
    }
    next()

  } catch (error) {
    // 401 Unauthorized → 未ログイン
    console.warn('未認証 or エラー:', error)
    if (to.path !== '/login') {
      next('/login')
    } else {
      next()
    }
  }
})

export default router
