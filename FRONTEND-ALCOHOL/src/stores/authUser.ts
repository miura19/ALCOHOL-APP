import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import axios from 'axios'

export const useAuthUserStore = defineStore('useAuthUserStore', () => {

    type User = {
        id: number
        name: string
        email: string
        created_at: string
    }
    const user = ref<User | null>(null)
    const errorMessage = ref('')

    //認証済みならユーザーデータを取得
    const fetchAuthUserData = async () => {
        try {
            const res = await axios.get('http://localhost/api/user', {
                withCredentials: true,
                withXSRFToken: true,
                headers: {
                    Accept: 'application/json',
                }
            })
            console.log('ユーザーデータ:', res.data)
            user.value = res.data;
        } catch (error) {
            console.error('ユーザーデータ取得失敗:', error)
        }
    }

    const fetchAllUserData = async () => {
        try {
            const res = await axios.get('http://localhost/api/users', {
                withCredentials: true,
                withXSRFToken: true,
                headers: {
                    Accept: 'application/json',
                }
            })
            console.log('登録済みユーザーデータ一覧:', res.data)
        } catch (error) {
            console.error('登録済みユーザーデータ一覧取得失敗:', error)
        }
    }

    const login = async (email: string, password: string) => {
        try {
            // CSRF Cookieの取得
            await axios.get('http://localhost/sanctum/csrf-cookie', { withCredentials: true })

            const response = await axios.post('http://localhost/api/login', {
                email: email,
                password: password
            }, {
                withCredentials: true,
                withXSRFToken: true,
                headers: {
                    Accept: 'application/json',
                }
            })

            console.log('ログイン成功:', response.data)
            errorMessage.value = ''
        } catch (error) {
            console.error('ログイン失敗:', error)
            errorMessage.value = 'ログインに失敗しました'
        }
    }

    const logout = async () => {
        try {
            await axios.post('http://localhost/api/logout', null, {
                withCredentials: true,
                withXSRFToken: true,
                headers: {
                    Accept: 'application/json',
                }
            })
            console.log('ログアウト成功')
            user.value = null
        } catch (error) {
            console.error('ログアウト失敗:', error)
        }
    }

    const register = async (name: string, email: string, password: string, password_confirmation: string) => {
        try {
            // CSRF Cookieの取得
            await axios.get('http://localhost/sanctum/csrf-cookie', { withCredentials: true })

            const response = await axios.post('http://localhost/api/register', {
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation
            }, {
                withCredentials: true,
                withXSRFToken: true,
                headers: {
                    Accept: 'application/json',
                }
            })

            console.log('登録成功:', response.data)
            errorMessage.value = ''
        } catch (error) {
            console.error('登録失敗:', error)
            errorMessage.value = '登録に失敗しました'
        }
    }

    return { user, fetchAuthUserData, fetchAllUserData, logout, errorMessage, login, register }
})