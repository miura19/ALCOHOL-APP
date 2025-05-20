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
    const user = ref<User>()
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

    return { user, fetchAuthUserData, fetchAllUserData }
})