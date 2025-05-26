import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useAlcoholGenreMasterStore = defineStore('fetchAlcoholGenreMaster', () => {
    type Genre = {
        id: number
        name: string
        image: string
        created_at: string
        updated_at: string
    }

    type QuestionChoice = {
        id: number
        question_id: number
        choice_text: string
        question_number: number
        score: number
        created_at: string
        updated_at: string
    }

    type Question = {
        id: number
        question_text: string
        genre_id: number
        created_at: string
        updated_at: string
        question_choices: QuestionChoice[]
    }
    const genres = ref<Genre[]>([])
    const genre = ref<Genre>()
    const questions = ref<Question[]>([])

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

    const fetchAlcoholGenreMasterDetail = async (genreId: number) => {
        try {
            const res = await axios.get(`http://localhost/api/genre/${genreId}`, {
                withCredentials: true,
                withXSRFToken: true,
                headers: {
                    Accept: 'application/json',
                }
            })
            console.log('アルコールジャンル:', res.data.genre)
            console.log('質問:', res.data.questions)
            genre.value = res.data.genre;
            questions.value = res.data.questions;
        } catch (error) {
            console.error('アルコールジャンル取得失敗:', error)
        }
    }

    return { genres, fetchAlcoholGenreMaster, genre, questions, fetchAlcoholGenreMasterDetail }
})