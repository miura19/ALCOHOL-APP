import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import axios from 'axios'

export const useAlcoholGenreMasterStore = defineStore('fetchAlcoholGenreMaster', () => {
    type Genre = {
        id: number
        name: string
        image: string
        created_at: string
        updated_at: string
    }
    const genres = ref<Genre[]>([])
    const fetchAlcoholGenreMaster = async () => {
        try {
            const res = await axios.get('http://localhost/api/genres', {
                withCredentials: true,
                withXSRFToken: true,
                headers: {
                    Accept: 'application/json',
                }
            })
            console.log('アルコールジャンル:', res.data)
            genres.value = res.data;
        } catch (error) {
            console.error('アルコールジャンル取得失敗:', error)
        }
    }
    return { genres, fetchAlcoholGenreMaster }
})